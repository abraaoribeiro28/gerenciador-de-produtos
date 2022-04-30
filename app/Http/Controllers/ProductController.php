<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Archive;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->id == null){
            $products = Product::paginate(10);
        }else{
            $products = Product::where('category_id', $request->id)->paginate(10);
        }
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $archives = Archive::all();
        return view('admin.products.create', compact('categories', 'archives'));
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
        return redirect(route('products'))->with('msg', 'Produto criado com sucesso!');
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

        return view('admin.products.edit', compact('product', 'categories', 'archive', 'archives'));
    }

    public function show($id){
        $product = Product::findOrFail($id);


        if($product->archive_id == null){
            $archive = "not-image.png";
        }else{
            $archive = Archive::find($product->archive_id);
        }

        return view('admin.products.show', compact('product', 'archive'));
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
        return redirect(route('products'))->with('msg', 'Produto modificado com sucesso!');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('products'))->with('msg', 'Produto deletado com sucesso!');
    }
}
