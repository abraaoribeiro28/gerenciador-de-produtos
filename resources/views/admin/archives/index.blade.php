@extends('layouts.index')

@section('title', 'Gerenciador - Imagens')

@section('content')

@include('layouts.header')

<section class="section-products">
  <div class="container px-5" style="padding-top: 50px;">
    <div>
        <button class="btn btn-success" onclick="modalUpload()">
            <i class="fa fa-upload"></i>
            Upload file
        </button>
    </div>
    <div class="images mt-3">
        @foreach ($archives as $archive)
        <div class="card-img mb-4">
          <div class="box-img">
            @php
                $imagePath = $archive->path ?? '/images/products/'.$archive->archive;
            @endphp
            <img src="{{ $imagePath }}" alt="{{ $archive->filename ?? $archive->archive }}">
          </div>
          <span class="name-img pt-3 d-block" style="white-space: nowrap;">{{$archive->filename ?? $archive->archive}}</span>
          <button class="btn btn-danger btn-exlcuir-archive" onclick="exibirModal({{$archive->id}}, '#modalDelete', '/admin/archive/delete/')">Excluir</button>
        </div>
        @endforeach
    </div>
  </div>
</section>

<div class="modal" id="modalUpload" tabindex="-1" style="align-items: center;">
  <div class="modal-dialog" style="width: 100%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('archives.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="archive" id="archive" aria-describedby="customFileInput" required>
                    <label class="custom-file-label" for="archive">Selecionar arquivo</label>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Cancelar</button>
              <button type="submit" class="btn btn-primary">Salvar arquivo</button>
          </div>
      </form>
    </div>
  </div>
</div>

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
@include('layouts.modal-delete')
@endsection
