@extends('layouts.index')

@section('title', 'Gerenciador - Home')

@section('content')
<section class="landing">
    <div class="container px-5">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div>
                        <h2 class="main_title">Gerenciamento de Produtos</h2>
                        <p class="main_description">O gerenciamento de produtos é um dos fatores que envolve todo o processo de administração competente de uma empresa.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-8 offset-2 offset-md-0">
                <img class="img-fluid" src="/images/home/gerenciamento.svg" alt="">
            </div>
        </div>
    </div>
</section>
<section class="design-responsivo container">
    <div class="row">
        <div class="col-md-6 col-8 offset-2 offset-md-0">
            <img  src="/images/home/designer-animate.svg" class="img-fluid" id="imagem-resposive">
        </div>
        <div class="col-md-6 col-12 d-flex align-items-center">
            <div>
                <h2 class="main_title">Design responsivo</h2>
                <p class="main_description">
                    Além do design moderno, o layout é totalmente resposivo, se adaptando
                    em diferentes tamanhos de telas.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection