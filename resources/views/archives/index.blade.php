@extends('layouts.index')

@section('title', 'Gerenciador - Imagens')

@section('content')
    <section class="section-products">
        <div>
            <div class="top">
                <div class="borda"></div> 
                <h1 class="title">Archives</h1>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-success" onclick="modalUpload()">
                <i class="fa fa-upload"></i>
                Upload file
            </button>
        </div>

        <div class="images mt-3">
            @foreach ($archives as $archive)
            <div class="card-img">
              <div class="box-img">
                <img src="/images/products/{{$archive->archive}}">
              </div>
              <span class="name-img">{{$archive->archive}}</span>
              <button class="btn btn-danger btn-exlcuir-archive" onclick="exibirModal({{$archive->id}}, '#modalDelete', '/achive/delete/')">Excluir</button>
            </div>
            @endforeach
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
          <form action="/archives" method="POST" enctype="multipart/form-data">
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

  @include('layouts.modal-delete')
@endsection