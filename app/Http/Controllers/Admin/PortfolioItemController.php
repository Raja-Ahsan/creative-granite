<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUpload;
use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioItemController extends Controller
{
    use HandlesImageUpload;

    public function index(): View
    {
        return view('screens.admin.portfolio-items.index', [
            'items' => PortfolioItem::query()->orderBy('id')->get(),
            'title' => 'Portfolio',
        ]);
    }

    public function create(): View
    {
        return view('screens.admin.portfolio-items.form', [
            'item' => new PortfolioItem(),
            'title' => 'Add Portfolio Item',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data = $this->mergeImagePath($request, $data);
        PortfolioItem::create($data);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item created.');
    }

    public function edit(PortfolioItem $portfolioItem): View
    {
        return view('screens.admin.portfolio-items.form', [
            'item' => $portfolioItem,
            'title' => 'Edit Portfolio Item',
        ]);
    }

    public function update(Request $request, PortfolioItem $portfolioItem): RedirectResponse
    {
        $data = $this->validated($request, $portfolioItem);
        $data = $this->mergeImagePath($request, $data);
        $portfolioItem->update($data);

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item updated.');
    }

    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $portfolioItem->delete();

        return redirect()->route('admin.portfolio-items.index')->with('success', 'Portfolio item deleted.');
    }

    private function validated(Request $request, ?PortfolioItem $item = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => [$item?->image_path ? 'nullable' : 'required', 'image', 'max:10240'],
        ]);
    }
}
