<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use App\Services\SiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioItemController extends Controller
{
    use HandlesImageUpload;

    private const SECTION_KEYS = [
        'work_eyebrow',
        'work_heading',
        'work_subheading',
    ];

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

        $query = PortfolioItem::query();

        if ($search !== '') {
            $query->where('title', 'like', '%'.$search.'%');
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

        return view('screens.admin.portfolio-items.index', [
            'items' => $query->paginate(12)->withQueryString(),
            'title' => 'Our Work Gallery',
            'sectionValues' => $this->sectionValues(),
            'filters' => [
                'search' => $search,
                'featured' => $featured,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function updateSection(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'work_eyebrow' => ['nullable', 'string', 'max:120'],
            'work_heading' => ['nullable', 'string', 'max:300'],
            'work_subheading' => ['nullable', 'string', 'max:800'],
        ]);

        foreach (self::SECTION_KEYS as $key) {
            $this->saveSetting($key, $data[$key] ?? '');
        }

        SiteContentService::clearCache();

        return redirect()
            ->route('admin.portfolio-items.index')
            ->with('success', 'Our Work section text updated.');
    }

    private function sectionValues(): array
    {
        $defaults = [
            'work_eyebrow' => 'Our work',
            'work_heading' => 'Fabricated with precision. installed with intention.',
            'work_subheading' => 'A selection of completed spaces, material details, and in between moments each reflecting our approach to stone, design, and execution.',
        ];

        $stored = SiteSetting::query()
            ->whereIn('key', self::SECTION_KEYS)
            ->pluck('value', 'key')
            ->all();

        return array_merge($defaults, $stored);
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'string', 'group' => 'work']
        );
    }

    public function create(): View
    {
        return view('screens.admin.portfolio-items.form', [
            'item' => new PortfolioItem([
                'sort_order' => ((int) PortfolioItem::query()->max('sort_order')) + 1,
                'is_featured' => false,
                'is_active' => true,
            ]),
            'title' => 'Add Our Work Gallery Item',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data);
        PortfolioItem::create($data);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Gallery item created.');
    }

    public function edit(PortfolioItem $portfolioItem): View
    {
        return view('screens.admin.portfolio-items.form', [
            'item' => $portfolioItem,
            'title' => 'Edit Our Work Gallery Item',
        ]);
    }

    public function update(Request $request, PortfolioItem $portfolioItem): RedirectResponse
    {
        $data = $this->validated($request, $portfolioItem);
        $data = $this->mergeImagePath($request, $data);
        $portfolioItem->update($data);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Gallery item deleted.');
    }

    private function validated(Request $request, ?PortfolioItem $item = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => [$item?->image_path ? 'nullable' : 'required', 'image', 'max:10240'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'sort_order' => (int) $request->input('sort_order', 0),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
