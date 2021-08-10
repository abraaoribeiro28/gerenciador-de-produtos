@extends('layouts.index')

@section('title', 'Gerenciar produtos - categorias')

@section('content')
    <section class="section-categories">
      <div class="container px-5">
        <div class="top pt-4">
            <div class="borda" style="background-color: var(--azul);"></div> 
            <h1 class="title">
                @if ($category->category_father != 0)
                    {{$category_father->category}} /
                @endif
                {{$category->category}}
            </h1>
        </div>
        <table class="table table-striped mt-3">
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
                    <th>{{$category->category}}</th>
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
      </div>
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