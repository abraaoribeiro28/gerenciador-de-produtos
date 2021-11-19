<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Product;


class ArchiveController extends Controller
{
    private $archive;

    public function __construct(Archive $archive){
        $this->archive = $archive;
    }

    public function index()
    {
        $archives = $this->archive->all();

        return response()->json($archives);
    }


    public function store(Request $request)
    {
        $archive = $this->archive;
        if($request->hasFile('archive') && $request->file('archive')->isValid()){
            $name = $request->archive->getClientOriginalName();
            $upload = $request->archive->move(public_path('images/products'), $name);
            $archive->archive =  $name;
            if(!$upload){
                return response()->json(['error' => 'Fail_upload'], 500);
            }
        }
        $archive->save();

        return response()->json($archive, 201);
    }

    public function destroy($id)
    {
        $product = Product::where('archive_id', $id)->get();
        if(count($product) > 0){
            return response()->json(['error' => 'Have products using the image']);
        }

        $archive = $this->archive->find($id);
        if(!$archive){
            return response()->json(['error' => 'Not found'], 404);
        }
        $archive->delete();
        return response()->json([], 204);
    }
}
