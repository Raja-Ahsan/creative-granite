<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectTypeController extends Controller
{
    public function create(): View
    {
        return view('screens.admin.project-types.form', [
            'item' => new ProjectType(),
            'title' => 'Add Project Type',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        ProjectType::create($this->validated($request));

        return redirect()->route('admin.contact-page.edit')->with('success', 'Project type created.');
    }

    public function edit(ProjectType $projectType): View
    {
        return view('screens.admin.project-types.form', [
            'item' => $projectType,
            'title' => 'Edit Project Type',
        ]);
    }

    public function update(Request $request, ProjectType $projectType): RedirectResponse
    {
        $projectType->update($this->validated($request, $projectType));

        return redirect()->route('admin.contact-page.edit')->with('success', 'Project type updated.');
    }

    public function destroy(ProjectType $projectType): RedirectResponse
    {
        $projectType->delete();

        return redirect()->route('admin.contact-page.edit')->with('success', 'Project type deleted.');
    }

    private function validated(Request $request, ?ProjectType $projectType = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ];
    }
}
