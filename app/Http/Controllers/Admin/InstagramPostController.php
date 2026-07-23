<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\InstagramPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstagramPostController extends Controller
{
    use HandlesImageUpload;

    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $featured = $request->string('featured')->toString();
        $sort = $request->string('sort')->toString() ?: 'sort_order';
        $direction = strtolower($request->string('direction')->toString()) === 'desc' ? 'desc' : 'asc';

        $allowedSorts = ['sort_order', 'title', 'is_featured', 'created_at', 'id'];
        if (! in_array($sort, $allowedSorts, true)) {
            $sort = 'sort_order';
        }

        $query = InstagramPost::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('alt_text', 'like', '%'.$search.'%');
            });
        }

        if ($featured === '1') {
            $query->where('is_featured', true);
        } elseif ($featured === '0') {
            $query->where('is_featured', false);
        }

        if ($sort === 'sort_order') {
            $query->orderBy('sort_order', $direction)->orderBy('id', $direction);
        } else {
            $query->orderBy($sort, $direction)->orderBy('sort_order')->orderBy('id');
        }

        return view('screens.admin.instagram-posts.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Instagram Feed',
            'featuredCount' => InstagramPost::query()->featured()->active()->count(),
            'filters' => [
                'search' => $search,
                'featured' => $featured,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.instagram-posts.form', [
            'item' => new InstagramPost([
                'sort_order' => ((int) InstagramPost::query()->max('sort_order')) + 1,
                'is_featured' => false,
                'is_active' => true,
            ]),
            'title' => 'Add Instagram Image',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'instagram', 'image');
        InstagramPost::create($data);

        return redirect()->route('admin.instagram-posts.index')->with('success', 'Instagram image created.');
    }

    public function edit(InstagramPost $instagramPost): View
    {
        return view('screens.admin.instagram-posts.form', [
            'item' => $instagramPost,
            'title' => 'Edit Instagram Image',
        ]);
    }

    public function update(Request $request, InstagramPost $instagramPost): RedirectResponse
    {
        $data = $this->validated($request, $instagramPost);
        $data = $this->mergeImagePath($request, $data, 'image_path', 'public', 'instagram', 'image');
        $instagramPost->update($data);

        return redirect()->route('admin.instagram-posts.index')->with('success', 'Instagram image updated.');
    }

    public function destroy(InstagramPost $instagramPost): RedirectResponse
    {
        $this->deleteStoredImage($instagramPost->image_path);
        $instagramPost->delete();

        return redirect()->route('admin.instagram-posts.index')->with('success', 'Instagram image deleted.');
    }

    private function validated(Request $request, ?InstagramPost $item = null): array
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'external_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'image' => [$item?->image_path ? 'nullable' : 'required', 'image', 'max:10240'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($data['is_featured']) {
            $featuredCount = InstagramPost::query()
                ->featured()
                ->when($item, fn ($q) => $q->where('id', '!=', $item->id))
                ->count();

            if ($featuredCount >= 12) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'is_featured' => 'You can feature a maximum of 12 Instagram images for the homepage.',
                ]);
            }
        }

        return $data;
    }
}
