<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::with(['user']) // Load user relationship
        ->when(!auth()->user()->isAdmin(), function($query) {
            $query->where('user_id', auth()->id());
        })
        ->when($request->search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        })
        ->when($request->status && $request->status != 'all', function($query, $status) {
            $query->where('status', $status);
        })
        ->paginate(5);
        
    return view('categories.index', compact('categories'));
}
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'code' => 'required|unique:master_categories|max:255',
        'name' => 'required|max:255',
        'status' => 'required|in:Active,Inactive',
    ]);

    Category::create([
        'code' => $request->code,
        'name' => $request->name,
        'status' => $request->status,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
    $this->authorize('update', $category);
    
    $request->validate([
        'code' => 'required|max:255|unique:master_categories,code,' . $category->id,
        'name' => 'required|max:255',
        'status' => 'required|in:Active,Inactive',
    ]);

    $category->update($request->only(['code', 'name', 'status']));

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}