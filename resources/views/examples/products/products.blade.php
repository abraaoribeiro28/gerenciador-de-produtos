@extends('layouts.index')

@section('title', 'Gerenciador - Exemplo/produtos')

@section('content')
<section class="section-products container" id="section">

    <div class="top">
        <div class="borda"></div> 
        <h1 class="title">Produtos</h1>
    </div>
    <div class="mt-3 d-flex">
      <a href="#" class="btn btn-success"><i class="fa fa-plus"></i> Novo produto</a>
      <div class="dropdown mx-2">
        <button class="btn btn-secondary" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i> Filtrar produtos
        </button>
        <div class="dropdown-menu filter" aria-labelledby="dropdownFilter">
          <a class="dropdown-item" href="#">Todos os produtos</a>
          <a class="dropdown-item" href="#">Categoria 1</a>
          <a class="dropdown-item" href="#">Categoria 2</a>
          <a class="dropdown-item" href="#">Categoria 3</a>
          <a class="dropdown-item" href="#">Categoria 4</a>
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
            <tr>
            <th scope="row">1</th>
            <th>Produto Exemplo 1</th>
            <th>Categria do produto 1</th>
            <th>Aqui é a descrição do produto 1</th>
            <th>R$ 10,00</th>
            <th>Esgotado</th>
            <th>
                <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                <button class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>
            </th>
            <tr>
                <th scope="row">2</th>
                <th>Produto Exemplo 2</th>
                <th>Categria do produto 2</th>
                <th>Aqui é a descrição do produto 2</th>
                <th>R$ 20,00</th>
                <th>200</th>
                <th>
                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>
                </th>
            </tr>
            <tr>
                <th scope="row">3</th>
                <th>Produto Exemplo 3</th>
                <th>Categria do produto 3</th>
                <th>Aqui é a descrição do produto 3</th>
                <th>R$ 30,00</th>
                <th>300</th>
                <th>
                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>
                </th>
            </tr>
        </tbody>
    </table>
</section>
@endsection