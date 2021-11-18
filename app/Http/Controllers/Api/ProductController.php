<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreUpdateProductFormRequest;

class ProductController extends Controller
{

    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->paginate(10);
    
        return response()->json($products);
    }

    public function store(StoreUpdateProductFormRequest $request)
    {
        $data = $request->all();
        $product = $this->product->create($data);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        if(!$product){
            return response()->json(['error' => 'Not found'], 404);
        }
        
        return response()->json($product);
    }

    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = $this->product->find($id);
        if(!$product){
            return response()->json(['error' => 'Not found'], 404);
        }
        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = $this->product->find($id);
        if(!$product){
            return response()->json(['error' => 'Not found'], 404);
        }
        $product->delete();

        return response()->json([], 204);
    }
}
