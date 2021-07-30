<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class TrashController extends Controller
{
    public function show(){
        
        return view('trash.show');
    }
}
