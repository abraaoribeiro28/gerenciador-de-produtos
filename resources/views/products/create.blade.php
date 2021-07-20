@extends('layouts.index')

@section('content')
<section class="section-products create">
    <div>
        <div class="top">
            <div class="borda"></div> 
            <h1 class="title">Novo Produto</h1>
        </div>
    </div>
    <div>
        <form action="{{route('products.create')}}" method="post" >
            @csrf
            <div class="row">
                <div class="col-4" id="imagem-produto">
                    <h6 class="mb-2">IMAGEM</h6>
                    <img src="/images/products/not-image.png" id="imagemProduto" alt="imagem">
                    <div class="file mt-1">
                        <button type="button" class="btn btn-success select-img" onclick="modalSelectImage()">Selecionar</button>
                        <button type="button" class="btn btn-danger remove-img" onclick="removeImage()" style="display: none;">Remover image</button>
                    </div>
                    <input type="text" name="archive" id="archive" style="display: none;">
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
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->category}}
                            </option>
                        @endforeach
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
                        {{-- <a href="{{route('products')}}" class="btn btn-secondary">Voltar</a> --}}
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if (count($categories) == 0)
        <div class="modal" style="display: block;" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Alerta</h5>
                </div>
                <div class="modal-body">
                    <p>Nenhuma categoria encontrada, para poder cadastrar seus produtos, primeiro você precisa criar uma categoria!</p>
                </div>
                <div class="modal-footer">
                <a href="{{route('products')}}" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
                <a href="{{route('category.create')}}" class="btn btn-primary">Criar categoria</a>
                </div>
            </div>
            </div>
        </div>
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
        const inputArchive = document.querySelector('#archive');
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
        const inputArchive = document.querySelector('#archive');
        inputArchive.setAttribute('value', id);
        const imagemProduto = document.querySelector('#imagemProduto');
        imagemProduto.setAttribute('src', '/images/products/'+image)
    }
    function removeImage(){
        const inputArchive = document.querySelector('#archive');
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