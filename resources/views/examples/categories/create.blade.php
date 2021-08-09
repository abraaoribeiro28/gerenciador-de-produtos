@extends('layouts.index')

@section('title', 'Gerenciador - Nova categoria exemplo')

@section('content')
    <section class="section-categories-create container">
        <form action="#" style="margin-top: 100px;">
            @csrf
            <div class="form-group">
                <label for="category">Nome da categoria <span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="category" id="category" placeholder="Exemplo: Smartphones" required autofocus>
            </div>
            <div>
                <label for="description">Descrição</label>
                <textarea class="form-control" name="description" id="description" aria-label="With textarea" placeholder="Digite aqui..."></textarea>
            </div>
            <div class="form-group mt-3">
                <label for="category_father">Subcategoria de <i class="fa fa-question-circle" style="color: gray;"></i></label>
                <select class="form-control" name="category_father" id="category_father" required>
                    <option value="0">-- Selecionar categoria--</option>
                    <option value="1">Categoria 1</option>
                    <option value="2">Categoria 2</option>
                    <option value="3">Categoria 3</option>
                    <option value="4">Categoria 4</option>
                </select>
                <span style="font-size: 14px; color: gray;">Por padrão a categoria será uma categoria pai, caso não selecione nenhuma!</span>
            </div>
            <div class="buttons">
                <a href="#" class="btn btn-secondary" style="cursor:not-allowed;">Voltar</a>
                <input type="button" class="btn btn-primary" value="Cadastrar" style="cursor:not-allowed;">
            </div>
        </form>
    </section>
@endsection