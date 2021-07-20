@extends('layouts.index')

@section('content')
<section class="section-products edit">
    <div class="top">
        <div class="borda"></div> 
        <h1 class="title">Editar Produto</h1>
    </div>

    <div>
        <form action="/product/edit/{{$product->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4" id="imagem-produto">
                    <h6 class="mb-2">IMAGEM</h6>
                    @if($archive == "not-image.png")
                        <img src="/images/products/not-image.png" id="imagemProduto" alt="imagem default">
                        <div class="file mt-1">
                            <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()">Selecionar</button>
                            <button type="button" class="btn btn-danger remove-img" onclick="removeImage()" style="display: none;">Remover image</button>
                        </div>
                        <input type="text" name="archive_id" id="archive_id" style="display: none;">
                    @else
                        <img src="/images/products/{{$archive->archive}}" id="imagemProduto" alt="Imagem produto">
                        <div class="file mt-1">
                            <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()" style="display: none;">Selecionar</button>
                            <button type="button" class="btn btn-danger remove-img" onclick="removeImage()">Remover image</button>
                        </div>
                        <input type="text" name="archive_id" id="archive_id" style="display: none;" value="{{$archive->id}}">
                    @endif
                    
                    <p class="aviso">
                        Se nenhuma imagem for selecionada, a imagem padrão acima vai ser incluida ao produto!
                    </p>
                </div>
                <div class="col-8" id="formulario">
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
                        {{-- <a href="{{route('products')}}" class="btn btn-secondary">Voltar</a> --}}
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="fecharModalSelectImage()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
          @forelse ($archives as $archive)
              <img src="/images/products/{{$archive->archive}}" width="100px" class="m-1" style="cursor: pointer;" onclick="selectImage({{$archive->id}}, '{{$archive->archive}}')">
          @empty
              <p>nenhum arquivo encontrado</p>
          @endforelse
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="fecharModalSelectImage()">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="confirmImage()">Confirmar</button>
        </div>
      </div>
    </div>
</div>


<script>
    function modalSelectImage(){
        const modalSelectImage = document.querySelector('#modalSelectImage');
        modalSelectImage.style.display = "flex";
    }
    function fecharModalSelectImage(){
        const modalSelectImage = document.querySelector('#modalSelectImage');
        modalSelectImage.style.display = "none";
        const inputArchive = document.querySelector('#archive_id');
        inputArchive.setAttribute('value', '');
        const imagemProduto = document.querySelector('#imagemProduto');
        imagemProduto.setAttribute('src', '/images/products/not-image.png')
    }
    function confirmImage(){
        const modalSelectImage = document.querySelector('#modalSelectImage');
        modalSelectImage.style.display = "none";
        const btnSelect = document.querySelector('.select-img');
        btnSelect.style.display = 'none';
        const btnRemove = document.querySelector('.remove-img');
        btnRemove.style.display = 'block';
    }
    function selectImage(id, image){
        const inputArchive = document.querySelector('#archive_id');
        inputArchive.setAttribute('value', id);
        const imagemProduto = document.querySelector('#imagemProduto');
        imagemProduto.setAttribute('src', '/images/products/'+image)
    }
    function removeImage(){
        const inputArchive = document.querySelector('#archive_id');
        inputArchive.setAttribute('value', '');
        const imagemProduto = document.querySelector('#imagemProduto');
        imagemProduto.setAttribute('src', '/images/products/not-image.png');
        const btnSelect = document.querySelector('.select-img');
        btnSelect.style.display = 'block';
        const btnRemove = document.querySelector('.remove-img');
        btnRemove.style.display = 'none';
    }
</script>
@endsection