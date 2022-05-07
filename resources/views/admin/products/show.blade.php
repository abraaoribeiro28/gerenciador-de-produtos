@extends('layouts.index')

@section('title', 'Gerenciador - Produto')

@section('content')

@include('layouts.header')

<section class="section-products" id="section">
  <div class="container px-5" style="padding-top: 100px;">
    <div class="card mx-auto" style="width: 25rem;">
        @if($archive == "not-image.png")
            <img src="/images/products/not-image.png" alt="imagem default">
        @else
            <img src="/images/products/{{$archive->archive}}" alt="Imagem produto">
        @endif
        <div class="card-body">
            <h5 class="card-title h3">{{$product->product}}</h5>
            <p class="card-text">{{$product->description}}</p>
            <a href="/product/edit/{{$product->id}}" class="btn btn-primary" style="width: 49%;">
                <i class="fa fa-edit"></i>
                Editar
            </a>
            <button class="btn btn-danger" onclick="exibirModal({{$product->id}}, '#modalDelete', '/admin/product/delete/')" style="width: 49%;">
                <i class="fa fa-trash"></i>
                Excluir
            </button>
        </div>
      </div>
  </div>
</section>

@include('layouts.modal-delete')

@endsection