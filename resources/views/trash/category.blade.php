@extends('layouts.index')

@section('title', 'Gerenciador - Lixeira')

@section('content')
<section class="section-categories">
  <div class="table">
    @forelse ($trashes as $trash)
      @if ($trash->category_father == 0)
        <div class="box">
          <div class="category pai mb-2">
            <div class="title">
              <div class="circle"></div>
              <h6 class="m-0">{{$trash->category}}</h6>
            </div>
            <div class="option">
              <div class="dropdown">
                <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                  <i class="fa fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu actions" aria-labelledby="dropdown-category">
                  <a class="dropdown-item" href="/category/{{$trash->id}}">
                    <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                    Visualizar
                  </a>
                  <a class="dropdown-item" href="/category/edit/{{$trash->id}}">
                    <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                    Editar
                  </a>
                  <button class="dropdown-item" onclick="exibirModal({{$trash->id}})">
                    <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                    Excluir
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @empty
    <div class="box">
      <h5 class="m-0">Nenhuma categoria cadastrada</h5>
    </div>
    @endforelse
  </div>
</section>
@include('layouts.modal-delete')
@endsection