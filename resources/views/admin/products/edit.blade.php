@extends('layouts.index')

@section('title', 'Gerenciador - Editar produto')

@section('content')

@include('layouts.header')

<section class="section-products edit">
    <div class="container" style="padding-top: 100px;">
        <form action="{{route('product.edit', $product->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-md-4" id="imagem-produto">
                    <h6 class="mb-2">IMAGEM</h6>
                    @if($archive == "not-image.png")
                        <img src="/images/products/not-image.png" id="imagemProdutoEdit" alt="imagem default">
                        <div class="file mt-1">
                            <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()">Selecionar</button>
                            <button type="button" class="btn btn-danger remove-img" onclick="removeImage('2')" style="display: none;">Remover image</button>
                        </div>
                        <input type="text" name="archive" id="archive-edit" style="display: none;">
                    @else
                        <img src="/images/products/{{$archive->archive}}" id="imagemProdutoEdit" alt="Imagem produto">
                        <div class="file mt-1">
                            <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()" style="display: none;">Selecionar</button>
                            <button type="button" class="btn btn-danger remove-img" onclick="removeImage('2')">Remover image</button>
                        </div>
                        <input type="text" name="archive" id="archive-edit" style="display: none;" value="{{$archive->id}}">
                    @endif
                    <p class="aviso">
                        Se nenhuma imagem for selecionada, a imagem padrão acima vai ser incluida ao produto!
                    </p>
                </div>
                <div class="col-12 col-md-8" id="formulario">
                    <div class="form-group">
                        <label for="product">Produto</label>
                        <input type="text" class="form-control" name="product" id="product" placeholder="Nome do produto" value="{{$product->product}}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select class="form-control" name="category_id" id="category_id">
                        <option>-- Selecionar categoria--</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                @if ($product->category_id == $category->id)
                                    selected
                                @endif>
                                {{$category->category}}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="form-group w-50 mr-2">
                            <label for="price">Preço</label>
                            <input type="text" class="form-control" name="price" id="price" data-thousands="." data-decimal="," data-prefix="R$ " placeholder="R$ 00,00" value="{{$product->price}}" required>
                            <script type="text/javascript">$("#price").maskMoney();</script>
                        </div>
                        <div class="form-group w-50 ml-2">
                            <label for="stock">Estoque</label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Quantidade em estoque" value="{{$product->stock}}" required>
                        </div>
                    </div>
                    <div>
                        <label for="description">Descrição</label>
                        <textarea class="form-control" name="description" id="description" aria-label="With textarea"  placeholder="Digite aqui...">{{$product->description}}</textarea>
                    </div>
                    <div class="buttons">
                        <input type="submit" class="btn btn-primary" value="Confirmar">
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<div class="modal" id="modalSelectImage" tabindex="-1" style="align-items: center;">
    <div class="modal-dialog w-100" style="max-width: 612px">
      <div class="modal-content" style="max-height: 450px">
        <div class="modal-header">
          <h5 class="modal-title">Selecione uma imagem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="fecharModalSelectImage('2')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
          @forelse ($archives as $archive)
              <img src="/images/products/{{$archive->archive}}" width="100px" class="m-1" style="cursor: pointer;" onclick="selectImage({{$archive->id}}, '{{$archive->archive}}', {{2}})">
          @empty
              <p>nenhum arquivo encontrado</p>
          @endforelse
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fecharModalSelectImage('2')">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="confirmImage()">Confirmar</button>
        </div>
      </div>
    </div>
</div>
@endsection