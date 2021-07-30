@extends('layouts.index')

@section('title', 'Gerenciador - Lixeira')

@section('content')
<section class="section-trashes">
    {{-- @foreach ($trashes as $trash)
        <h1>{{$trash->name_product}} - {{$trash->id_category_product}} - {{$trash->price_product}} - {{$trash->name_product}}</h1>
        
        <table class="table table-striped mt-4">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Produto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço</th>
                <th scope="col">Estoque</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <th>{{$product->product}}</th>
                    <th>
                      @foreach ($categories as $category)
                          @if ($category->id == $product->category_id)
                            {{$category->category}}
                          @endif
                      @endforeach
                    </th>
                    <th>
                      @if ($product->description == "")
                        Vazio
                      @else
                        {{$product->description}}
                      @endif
                    </th>
                    <th>{{$product->price}}</th>
                    <th>
                      @if ($product->stock == 0)
                          Esgotado
                      @else
                          {{$product->stock}}
                      @endif
                    </th>
                    <th>
                        <a href="/product/edit/{{$product->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                        <button class="btn btn-danger" onclick="exibirModal({{$product->id}}, '#modalDelete', '/product/delete/')"><i class="fa fa-trash"></i> Excluir</button>
                    </th>
                </tr>
              @empty
                <tr>
                    <th colspan="7" class="text-center">Lista de produtos vazia</th>
                </tr>
              @endforelse
            </tbody>
        </table>
    @endforeach --}}
</section>
@endsection