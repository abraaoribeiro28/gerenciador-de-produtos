@extends('layouts.index')

@section('title', 'Gerenciador -Categorias')

@section('content')
<section class="section-categories">
  <div class="container px-5" style="padding-top: 50px;">
    <a href="{{route('category.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nova categoria</a>

    <div class="table mt-3">
      @forelse ($categories as $category)
        @if ($category->category_father == 0)
          <div class="box">
            <div class="category pai mb-2">
              <div class="title">
                <div class="circle"></div>
                <h6 class="m-0">{{$category->category}}</h6>
                  @foreach ($products as $product)
                    @if ($product->category_id == $category->id)
                      <script>{{$quantidade++}}</script>
                    @endif 
                  @endforeach
                  <span class="badge badge-primary">{{$quantidade}}</span>
                  <script>{{$quantidade=0}}</script>
              </div>
              <div class="option">
                <div class="dropdown">
                  <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                  </button>
                  <div class="dropdown-menu actions" aria-labelledby="dropdown-category">
                    <a class="dropdown-item" href="/category/{{$category->id}}">
                      <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                      Visualizar
                    </a>
                    <a class="dropdown-item" href="/category/edit/{{$category->id}}">
                      <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                      Editar
                    </a>
                    <button class="dropdown-item" onclick="exibirModal({{$category->id}})">
                      <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                      Excluir
                    </button>
                  </div>
                </div>
              </div>
            </div>
            @foreach ($categories as $subcategory)
                @if ($subcategory->category_father == $category->id)
                <div class="category filho mb-2">
                  <div class="title">
                    <div class="circle"></div>
                    <h6 class="m-0">{{$subcategory->category}}</h6>
                    @foreach ($products as $product)
                        @if ($product->category_id == $subcategory->id)
                            <script>{{$quantidade++}}</script>
                        @endif 
                    @endforeach
                    <span class="badge badge-primary">{{$quantidade}}</span>
                    <script>{{$quantidade=0}}</script>
                  </div>
                  <div class="option">
                    <div class="dropdown">
                      <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-category">
                        <a class="dropdown-item" href="/category/{{$subcategory->id}}">
                          <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                          Visualizar
                        </a>
                        <a class="dropdown-item" href="/category/edit/{{$subcategory->id}}">
                          <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                          Editar
                        </a>
                        <button class="dropdown-item" onclick="exibirModal({{$subcategory->id}})">
                          <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                          Excluir
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                @endif 
            @endforeach
          </div>
        @endif
      @empty
      <div class="box">
        <h5 class="m-0">Nenhuma categoria cadastrada</h5>
      </div>
      @endforelse
    </div>

    @if (Session('erro'))
      <div class="msg bg-danger">
        <h6 class="m-0">{{Session('erro')}}</h6>
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
        <p>Tem certeza que deseja excluir esta categoria?</p>
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
    formExcluir.setAttribute('action', '/category/delete/'+id);
  }
  function fecharModal(){
    modal.style.display = 'none';
  }

  function fecharMsg(){
    const msg = document.querySelector('.msg').style.display = 'none';
  }
</script>
@endsection