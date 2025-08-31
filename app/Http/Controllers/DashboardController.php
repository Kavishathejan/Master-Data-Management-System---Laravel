<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $items = Item::with(['brand', 'category','user'])
            ->when(!auth()->user()->isAdmin(), function($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate(5);
            
        return view('dashboard', compact('items'));
    }
}