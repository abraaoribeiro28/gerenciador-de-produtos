@extends('layouts.index')

@section('title', 'Gerenciador - Categorias Exemplo')

@section('content')
<section class="section-categories">
    <div class="container px-5" style="padding-top: 50px;">
        <a href="#" class="btn btn-success mt-3"><i class="fa fa-plus"></i> Nova categoria</a>

        <div class="table mt-3">
            <div class="box">
            <div class="category pai mb-2">
                <div class="title">
                <div class="circle"></div>
                <h6 class="m-0">Categoria Pai 1</h6>
                    <span class="badge badge-primary">33</span>
                </div>
                <div class="option">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                    <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu actions" aria-labelledby="dropdown-category">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                        Visualizar
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                        Editar
                    </a>
                    <button class="dropdown-item">
                        <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                        Excluir
                    </button>
                    </div>
                </div>
                </div>
            </div>
                <div class="category filho mb-2">
                    <div class="title">
                    <div class="circle"></div>
                    <h6 class="m-0">Categoria filha 1</h6>
                    <span class="badge badge-primary">12</span>
                    </div>
                    <div class="option">
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-category">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                            Editar
                        </a>
                        <button class="dropdown-item">
                            <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                            Excluir
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="category filho mb-2">
                    <div class="title">
                        <div class="circle"></div>
                        <h6 class="m-0">Categoria filha 2</h6>
                        <span class="badge badge-primary">4</span>
                    </div>
                    <div class="option">
                        <div class="dropdown">
                        <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-category">
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                            Visualizar
                            </a>
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                            Editar
                            </a>
                            <button class="dropdown-item">
                            <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                            Excluir
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="category pai mb-2">
                <div class="title">
                    <div class="circle"></div>
                    <h6 class="m-0">Categoria Pai 2</h6>
                        <span class="badge badge-primary">0</span>
                    </div>
                    <div class="option">
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu actions" aria-labelledby="dropdown-category">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                            Editar
                        </a>
                        <button class="dropdown-item">
                            <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                            Excluir
                        </button>
                        </div>
                    </div>
                </div>
            </div>
                <div class="category filho mb-2">
                    <div class="title">
                        <div class="circle"></div>
                        <h6 class="m-0">Categoria filha 1</h6>
                        <span class="badge badge-primary">24</span>
                    </div>
                    <div class="option">
                        <div class="dropdown">
                        <button class="btn" type="button" id="dropdown-category" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-category">
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-eye" style="color: rgb(40, 167, 69, 0.9);"></i>
                            Visualizar
                            </a>
                            <a class="dropdown-item" href="#">
                            <i class="fa fa-pencil" style="color: rgb(248, 192, 51, 0.9);"></i>
                            Editar
                            </a>
                            <button class="dropdown-item">
                            <i class="fa fa-times" style="color: rgb(221, 61, 49, 0.9);"></i>
                            Excluir
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection