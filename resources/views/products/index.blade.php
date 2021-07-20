@extends('layouts.index')

@section('title', 'Gerenciar produtos - produtos')

@section('content')
<section class="section-products">
    <div class="top">
        <div class="borda"></div> 
        <h1 class="title">Produtos</h1>
    </div>

    <div class="mt-3 d-flex">
      <a href="{{route('products.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Novo produto</a>
      <div class="dropdown mx-2">
        <button class="btn btn-secondary" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i> Filtrar produtos
        </button>
        <div class="dropdown-menu filter" aria-labelledby="dropdownFilter">
          
          <a class="dropdown-item" href="{{route('products')}}">Todos os produtos</a>
          @foreach ($categories as $category)
            <a class="dropdown-item" href="/products/category/{{$category->id}}">{{$category->category}}</a>
          @endforeach

        </div>
      </div>
    </div>
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
                    <button class="btn btn-danger" onclick="exibirModal({{$product->id}})"><i class="fa fa-trash"></i> Excluir</button>
                </th>
            </tr>
          @empty
            <tr>
                <th colspan="7" class="text-center">Lista de produtos vazia</th>
            </tr>
          @endforelse
        </tbody>
    </table>

      @if (Session('msg'))
        <div class="msg bg-success">
          <h6 class="m-0">{{Session('msg')}}</h6>
          <button class="btn" onclick="fecharMsg()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <script>
          const msg = document.querySelector('.msg');
          setTimeout(() => {
            msg.style.display = 'none'
          }, 3000)
        </script>
      @endif
</section>

<div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="fecharModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir este produto?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="fecharModal()">Cancelar</button>
        <form method="post" id="form-excluir">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const modal = document.querySelector('.modal');
  function exibirModal(id){
    modal.style.display = 'block';

    const formExcluir = document.querySelector('#form-excluir');
    formExcluir.setAttribute('action', '/product/delete/'+id);
  }
  function fecharModal(){
    modal.style.display = 'none';
  }

  function fecharMsg(){
    const msg = document.querySelector('.msg').style.display = 'none';
  }
</script>
@endsection