<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequestAMY;
use App\Models\CategoryAMY;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryControllerAMY extends Controller
{
    /** GET /categories */
    public function index(): View
    {
        $categories = CategoryAMY::withCount('tasks')->latest()->paginate(15);
        return view('categories.index', compact('categories'));
    }

    /** GET /categories/create */
    public function create(): View
    {
        $this->authorize('create', CategoryAMY::class);
        return view('categories.create');
    }

    /** POST /categories */
    public function store(StoreCategoryRequestAMY $request): RedirectResponse
    {
        $this->authorize('create', CategoryAMY::class);

        CategoryAMY::create(array_merge(
            $request->validated(),
            ['created_by' => Auth::id()]
        ));

        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully.');
    }

    /** GET /categories/{category} */
    public function show(CategoryAMY $category): View
    {
        $category->load(['tasks', 'creator']);
        return view('categories.show', compact('category'));
    }

    /** GET /categories/{category}/edit */
    public function edit(CategoryAMY $category): View
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    /** PUT/PATCH /categories/{category} */
    public function update(Request $request, CategoryAMY $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $request->validate([
            'name'        => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
            'color'       => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $category->update($request->only('name', 'color', 'description'));

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated.');
    }

    /** DELETE /categories/{category} */
    public function destroy(CategoryAMY $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted.');
    }
}
