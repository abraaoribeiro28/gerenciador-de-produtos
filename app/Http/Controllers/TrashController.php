<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class TrashController extends Controller
{
    public function product(){
        $trashes = Product::where('deleted', true)->get();
        $categories = Category::all();
        return view('trash.product', compact('trashes', 'categories'));
    }

    public function category(){
        $trashes = category::where('deleted', true)->get();
        return view('trash.category', compact('trashes'));
    }
}
