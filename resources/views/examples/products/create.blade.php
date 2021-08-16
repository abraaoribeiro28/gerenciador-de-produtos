@extends('layouts.index')

@section('title', 'Gerenciador - Novo produto exemplo')

@section('content')
<section class="section-products create">
    <div class="container px-5" style="padding-top: 100px;">
        <form action="#">
            @csrf
            <div class="row">
                <div class="col-4" id="imagem-produto">
                    <h6 class="mb-2">IMAGEM</h6>
                    <img src="/images/products/not-image.png" id="imagemProdutoCreate" alt="imagem">
                    <div class="file mt-1">
                        <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()">Selecionar</button>
                        <button type="button" class="btn btn-danger remove-img" onclick="removeImage('1')" style="display: none;">Remover image</button>
                    </div>
                    <input type="text" name="archive" id="archive-create" style="display: none;">
                    <p class="aviso">
                        Se nenhuma imagem for selecionada, a imagem padrão acima vai ser incluida ao produto!
                    </p>
                </div>
                <div class="col-8" id="formulario">
                    <div class="form-group">
                        <label for="product">Produto <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="product" id="product" placeholder="Nome do produto" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoria <span style="color: red;">*</span></label>
                        <select class="form-control" name="category_id" id="category_id" required>
                        <option value="">-- Selecionar categoria--</option>
                        <option value="1">Categoria 1</option>
                        <option value="2">Categoria 2</option>
                        <option value="3">Categoria 3</option>
                        <option value="4">Categoria 4</option>
                        </select>
                    </div>
                    <div class="d-flex" style="justify-content: space-between">
                        <div class="form-group w-50 mr-2">
                            <label for="price">Preço <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="price" id="price" data-thousands="." data-decimal="," data-prefix="R$ " placeholder="R$ 0,00" required>
                            <script type="text/javascript">$("#price").maskMoney();</script>
                        </div>
                        <div class="form-group w-50 ml-2">
                            <label for="stock">Estoque <span style="color: red;">*</span></label>
                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Quantidade em estoque" required>
                        </div>
                    </div>
                    <div>
                        <label for="description">Descrição</label>
                        <textarea class="form-control" name="description" id="description" aria-label="With textarea" placeholder="Digite aqui..."></textarea>
                    </div>
                    <div class="buttons">
                        <input type="button" class="btn btn-primary" value="Cadastrar" style="cursor:not-allowed;">
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="fecharModalSelectImage('1')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
            <img src="/images/products/product-example1.jpg" width="100px" class="m-1" style="cursor: pointer;" onclick="selectImage({{1}}, 'product-example1.jpg', {{1}})">
            <img src="/images/products/product-example2.jpg" width="100px" class="m-1" style="cursor: pointer;" onclick="selectImage({{2}}, 'product-example2.jpg', {{1}})">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fecharModalSelectImage('1')">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="confirmImage()">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
@endsection