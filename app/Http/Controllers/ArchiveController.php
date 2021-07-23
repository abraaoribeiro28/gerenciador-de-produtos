<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    public function index(){
        $archives = Archive::all();
        return view('archives.index', compact('archives'));
    }

    public function store(Request $request, Archive $archive){
        if($request->hasFile('archive') && $request->file('archive')->isValid()){
            $requestImage = $request->archive;
            $extension = $requestImage->extension();
            $imageName = $requestImage->getClientOriginalName();
            $requestImage->move(public_path('images/products'), $imageName);
            $archive->archive = $imageName;
        }else{
            $archive->archive = 'not-image.png';
        }

        $archive->save();

        return redirect('/archives')->with('msg', 'Imagem adicionada com sucesso!');;
    }

    public function destroy($id){
        $archive = Archive::findOrFail($id);
        $archive->delete();
        return redirect('/archives')->with('msg', 'Imagem deletada com sucesso!');
    }
}
