@extends('layouts.index')

@section('title', 'Gerenciador - Lixeira')

@section('content')
<section class="section-trashes">
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
          @forelse ($trashes as $trash)
            <tr>
                <th scope="row">{{$trash->id}}</th>
                <th>{{$trash->product}}</th>
                <th>
                  @foreach ($categories as $category)
                      @if ($category->id == $trash->category_id)
                        {{$category->category}}
                      @endif
                  @endforeach
                </th>
                <th>
                  @if ($trash->description == "")
                    Vazio
                  @else
                    {{$trash->description}}
                  @endif
                </th>
                <th>{{$trash->price}}</th>
                <th>
                  @if ($trash->stock == 0)
                      Esgotado
                  @else
                      {{$trash->stock}}
                  @endif
                </th>
                <th>
                    <a href="/product/edit/{{$trash->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <button class="btn btn-danger" onclick="exibirModal({{$trash->id}}, '#modalDelete', '/product/delete/')"><i class="fa fa-trash"></i> Excluir</button>
                </th>
            </tr>
          @empty
            <tr>
                <th colspan="7" class="text-center">Lista de produtos vazia</th>
            </tr>
          @endforelse
        </tbody>
    </table>
</section>
@include('layouts.modal-delete')
@endsection