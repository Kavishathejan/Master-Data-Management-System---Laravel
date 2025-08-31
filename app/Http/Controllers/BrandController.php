<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::when(!auth()->user()->isAdmin(), function($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate(5);
            
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'code' => 'required|unique:master_brands|max:255',
        'name' => 'required|max:255',
        'status' => 'required|in:Active,Inactive',
    ]);

    Brand::create([
        'code' => $request->code,
        'name' => $request->name,
        'status' => $request->status,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        $this->authorize('view', $brand);
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $this->authorize('update', $brand);
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
    $this->authorize('update', $brand);
    
    $request->validate([
        'code' => 'required|max:255|unique:master_brands,code,' . $brand->id,
        'name' => 'required|max:255',
        'status' => 'required|in:Active,Inactive',
    ]);

    $brand->update($request->only(['code', 'name', 'status']));

    return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}