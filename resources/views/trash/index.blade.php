@extends('layouts.index')

@section('title', 'Gerenciador - Lixeira')

@section('content')
<section class="section-trash">
    <div class="card text-center" style="width: 12rem;">  
        <div class="card-body">
            <img src="{{asset('images/home/box.png')}}" width="60">
            <h5 class="card-title mt-2">Products</h5>
            <a href="/trashes/product" target="_self" class="btn btn-primary w-100">Exibir</a>
        </div>
    </div>

    <div class="card text-center mx-5" style="width: 12rem;">  
        <div class="card-body">
            <img src="{{asset('images/home/subfolder.png')}}" width="60">
            <h5 class="card-title mt-2">Categorias</h5>
            <a href="/trashes/category" class="btn btn-primary w-100">Exibir</a>
        </div>
    </div>

    <div class="card text-center" style="width: 12rem;">  
        <div class="card-body">
            <img src="{{asset('images/home/galeria.png')}}" width="60">
            <h5 class="card-title mt-2">Imagens</h5>
            <a href="/trashes/archive" class="btn btn-primary w-100">Exibir</a>
        </div>
    </div>
</section>
@endsection