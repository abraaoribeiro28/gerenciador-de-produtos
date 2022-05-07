<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $quantidade = 0;
        return view('admin.categories.index', compact('categories', 'products', 'quantidade'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $category->category = $request->category;
        $category->description = $request->description;
        $category->category_father = $request->category_father;
        $category->save();
        return redirect(route('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        if($category->category_father != 0){
            $category_father = Category::findOrFail($category->category_father);
            return view('admin.categories.show', compact('category', 'products', 'category_father'));
        }else{
            return view('admin.categories.show', compact('category', 'products'));
        }
    }

    public function edit($id)
    {
        $category_edit = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.categories.edit', compact('category_edit', 'categories'));
    }

    public function update(Request $request)
    {
        Category::findOrFail($request->id)->update($request->all());
        return redirect(route('categories'))->with('msg', 'Categoria editada com sucesso!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = Category::where('category_father', $id)->get();
        $products = Product::where('category_id', $id)->get();
        if(count($products) == 0){
            if(count($subcategories) == 0){
                $category->delete();
                return redirect(route('categories'))->with('msg', 'Categoria excluida com sucesso');
            }else{
                return redirect(route('categories'))->with('erro', 'Existem subcategorias cadastrados nesta categroia!');;
            }
        }else{
            return redirect(route('categories'))->with('erro', 'Existem produtos cadastrados nesta categroia!');;
        }
    }
}
