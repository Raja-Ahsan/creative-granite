<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryAlbumImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GalleryAlbumController extends Controller
{
    use HandlesImageUpload;

    public const MAX_COLLAGE_IMAGES = 12;

    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $kind = $request->string('kind')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'title', 'kind', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = GalleryAlbum::query()->withCount('images');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
            });
        }

        if (in_array($kind, [GalleryAlbum::KIND_CATEGORY, GalleryAlbum::KIND_PROJECT], true)) {
            $query->where('kind', $kind);
        }

        if ($sort === 'sort_order') {
            $query->orderBy('kind')->orderBy('sort_order', $direction)->orderBy('id', $direction);
        } else {
            $query->orderBy($sort, $direction)->orderBy('sort_order')->orderBy('id');
        }

        return view('screens.admin.gallery-albums.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Gallery Albums',
            'filters' => [
                'search' => $search,
                'kind' => $kind,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function create(): View
    {
        $item = new GalleryAlbum([
            'kind' => GalleryAlbum::KIND_CATEGORY,
            'sort_order' => ((int) GalleryAlbum::query()->max('sort_order')) + 1,
            'is_active' => true,
        ]);
        $item->setRelation('images', collect());

        return view('screens.admin.gallery-albums.form', [
            'item' => $item,
            'title' => 'Add Gallery Album',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'cover_path', 'public', 'gallery', 'cover');
        unset($data['gallery_path']);

        $album = GalleryAlbum::create($data);
        $this->storeCollageImages($request, $album);

        $first = $album->images()->orderBy('sort_order')->orderBy('id')->value('image_path');
        if ($first) {
            $album->update(['gallery_path' => $first]);
        }

        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album created.');
    }

    public function edit(GalleryAlbum $galleryAlbum): View
    {
        return view('screens.admin.gallery-albums.form', [
            'item' => $galleryAlbum->load('images'),
            'title' => 'Edit Gallery Album',
        ]);
    }

    public function update(Request $request, GalleryAlbum $galleryAlbum): RedirectResponse
    {
        $data = $this->validated($request, $galleryAlbum);
        $data = $this->mergeImagePath($request, $data, 'cover_path', 'public', 'gallery', 'cover');
        unset($data['gallery_path']);

        $galleryAlbum->update($data);
        $this->removeCollageImages($request);
        $this->storeCollageImages($request, $galleryAlbum);

        $first = $galleryAlbum->images()->orderBy('sort_order')->orderBy('id')->value('image_path');
        $galleryAlbum->update(['gallery_path' => $first]);

        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album updated.');
    }

    public function destroy(GalleryAlbum $galleryAlbum): RedirectResponse
    {
        $this->deleteStoredImage($galleryAlbum->cover_path);

        foreach ($galleryAlbum->images()->get() as $image) {
            $this->deleteStoredImage($image->image_path);
        }

        $galleryAlbum->delete();

        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album deleted.');
    }

    private function validated(Request $request, ?GalleryAlbum $item = null): array
    {
        $max = self::MAX_COLLAGE_IMAGES;
        $existingCount = $item ? $item->images()->count() : 0;
        $removeIds = collect($request->input('remove_collage_images', []))
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();
        $removeCount = $item
            ? $item->images()->whereIn('id', $removeIds)->count()
            : 0;
        $remainingSlots = max(0, $max - ($existingCount - $removeCount));
        $uploadCount = $request->hasFile('collage_images')
            ? count(array_filter(
                $request->file('collage_images', []),
                fn ($file) => $file instanceof UploadedFile && $file->isValid()
            ))
            : 0;
        $finalCount = $existingCount - $removeCount + $uploadCount;

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('gallery_albums', 'slug')->ignore($item?->id),
            ],
            'kind' => ['required', Rule::in([GalleryAlbum::KIND_CATEGORY, GalleryAlbum::KIND_PROJECT])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'cover' => [$item?->cover_path ? 'nullable' : 'required', 'image', 'max:12288'],
            'collage_images' => ['nullable', 'array', 'max:'.$remainingSlots],
            'collage_images.*' => ['image', 'max:12288'],
            'remove_collage_images' => ['nullable', 'array'],
            'remove_collage_images.*' => ['integer', 'exists:gallery_album_images,id'],
        ]);

        if ($finalCount > $max) {
            throw ValidationException::withMessages([
                'collage_images' => "Each collage can have a maximum of {$max} images. You would have {$finalCount}.",
            ]);
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if (empty($data['slug'])) {
            unset($data['slug']);
        }

        unset($data['collage_images'], $data['remove_collage_images'], $data['cover']);

        return $data;
    }

    private function storeCollageImages(Request $request, GalleryAlbum $album): void
    {
        if (! $request->hasFile('collage_images')) {
            return;
        }

        $startOrder = (int) $album->images()->max('sort_order');

        foreach ($request->file('collage_images') as $index => $file) {
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                continue;
            }

            $path = $file->store('gallery/collage', 'public');

            GalleryAlbumImage::create([
                'gallery_album_id' => $album->id,
                'image_path' => '/storage/'.$path,
                'alt_text' => $album->title,
                'sort_order' => $startOrder + $index + 1,
            ]);
        }
    }

    private function removeCollageImages(Request $request): void
    {
        $ids = $request->input('remove_collage_images', []);
        if (! is_array($ids) || $ids === []) {
            return;
        }

        $images = GalleryAlbumImage::query()->whereIn('id', $ids)->get();
        foreach ($images as $image) {
            $this->deleteStoredImage($image->image_path);
            $image->delete();
        }
    }
}
