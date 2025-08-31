<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
{
    // Get brands and categories for filter dropdowns
    $brands = Brand::where('status', 'Active')->get();
    $categories = Category::where('status', 'Active')->get();
    
    $items = Item::with(['brand', 'category', 'user'])
        ->when(!auth()->user()->isAdmin(), function($query) {
            $query->where('user_id', auth()->id());
        })
        ->when($request->search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        })
        ->when($request->brand, function($query, $brandId) {
            $query->where('brand_id', $brandId);
        })
        ->when($request->category, function($query, $categoryId) {
            $query->where('category_id', $categoryId);
        })
        ->when($request->status && $request->status != 'all', function($query, $status) {
            $query->where('status', $status);
        })
        ->paginate(5);
        
    return view('items.index', compact('items', 'brands', 'categories'));
}

    public function create()
    {
        $brands = Brand::where('status', 'Active')->get();
        $categories = Category::where('status', 'Active')->get();
        
        return view('items.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:master_brands,id',
            'category_id' => 'required|exists:master_categories,id',
            'code' => 'required|unique:master_items|max:255',
            'name' => 'required|max:255',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only(['brand_id', 'category_id', 'code', 'name']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        Item::create($data);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        $this->authorize('view', $item);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        
        $brands = Brand::where('status', 'Active')->get();
        $categories = Category::where('status', 'Active')->get();
        
        return view('items.edit', compact('item', 'brands', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);
        
        $request->validate([
            'brand_id' => 'required|exists:master_brands,id',
            'category_id' => 'required|exists:master_categories,id',
            'code' => 'required|max:255|unique:master_items,code,' . $item->id,
            'name' => 'required|max:255',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only(['brand_id', 'category_id', 'code', 'name']);

        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($item->attachment) {
                Storage::disk('public')->delete($item->attachment);
            }
            
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        
        // Delete attachment if exists
        if ($item->attachment) {
            Storage::disk('public')->delete($item->attachment);
        }
        
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}