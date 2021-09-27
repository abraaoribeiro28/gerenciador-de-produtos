@extends('layouts.index')

@section('title', 'Gerenciador - Editar categoria')

@section('content')

@include('layouts.header')

<section class="section-categories-create">
    <div class="container px-5" style="padding-top: 100px;">
        <form action="/category/edit/{{$category_edit->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category">Nome da categoria <span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="category" id="category" placeholder="Exemplo: Smartphones" required value="{{$category_edit->category}}">
            </div>
            <div>
                <label for="description">Descrição</label>
                <textarea class="form-control" name="description" id="description" aria-label="With textarea" placeholder="Digite aqui...">{{$category_edit->description}}</textarea>
            </div>

            <div class="form-group mt-3">
                <label for="category_father">Subcategoria de <i class="fa fa-question-circle" style="color: gray;"></i></label>
                <select disabled class="form-control" name="category_father" id="category_father" required>
                <option value="0">-- Selecionar categoria--</option>
                @foreach ($categories as $category)
                    @if ($category->category_father == 0)
                        <option value="{{$category->id}}">
                            {{$category->category}}
                        </option>
                    @endif
                @endforeach
                </select>
                @if (count($categories) == 0)
                    <span style="font-size: 14px; color: gray;">Primeira categoria sempre será uma categoria pai!</span>
                @else
                    <span style="font-size: 14px; color: gray;">Por padrão a categoria será uma categoria pai, caso não selecione nenhuma!</span>
                @endif
            </div>


            <div class="buttons">
                <a href="{{route('categories')}}" class="btn btn-secondary">Voltar</a>
                <input type="submit" class="btn btn-primary" value="Confirmar">
            </div>
        </form>
    </div>
</section>
@endsection