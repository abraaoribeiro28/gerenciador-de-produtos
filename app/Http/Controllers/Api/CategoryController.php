<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();

        return response()->json($categories);
    }

    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = $this->category->find($id);
        if(!$category){
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($category);
    }

    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        $category = $this->category->find($id);
        if(!$category){
            return response()->json(['error' => 'Not found'], 404);
        }
        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);
        if(!$category){
            return response()->json(['error' => 'Not found'], 404);
        }

        $subcategories = $this->category->where('category_father', $id)->get();
        $products = Product::where('category_id', $id)->get();
        if(count($products) == 0){
            if(count($subcategories) == 0){
                $category->delete();
                return response()->json([], 204);
            }else{
                return response()->json(['error' => 'Existem subcategorias cadastrados nesta categroia!']);
            }
        }else{
            return response()->json(['error' => 'Existem produtos cadastrados nesta categroia!']);
        }
    }
}
