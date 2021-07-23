<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Archive;
use App\Models\Trash;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->id == null){
            $products = Product::all();
        }else{
            $products = Product::where('category_id', $request->id)->get();
        }
        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $archives = Archive::all();
        return view('products.create', compact('categories', 'archives'));
    }

    public function store(Request $request, Product $product){
        $product->product = $request->product;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if($request->archive == null){
            $product->archive_id = null;
        }else{
            $product->archive_id = $request->archive;
        }
        $product->save();
        return redirect('/products')->with('msg', 'Produto criado com sucesso!');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $archives = Archive::all();
        if($product->archive_id == null){
            $archive = "not-image.png";
        }else{
            $archive = Archive::findOrFail($product->archive_id);
        }
        
        return view('products.edit', compact('product', 'categories', 'archive', 'archives'));
    }

    public function update(Request $request){
        $product = Product::findOrFail($request->id);
        $product->product = $request->product;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        if($request->archive == null){
            $product->archive_id = null;
        }else{
            $product->archive_id = $request->archive;
        }
        $product->update();
        return redirect('/products')->with('msg', 'Produto modificado com sucesso!');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $trash = new Trash;
        $trash->type = 'product';
        $trash->id_product = $product->id;
        $trash->id_category_product = $product->category_id;
        $trash->name_product = $product->product;
        $trash->description_product = $product->description;
        $trash->price_product = $product->price;
        $trash->stock_product = $product->stock;
        $trash->archive_id_product = $product->archive_id;
        $trash->save();
        $product->delete();
        return redirect('/products')->with('msg', 'Produto deletado com sucesso!');
    }
}
