@extends('layouts.index')

@section('title', 'Gerenciador - Home')

@section('content')
<section class="landing">
    <div class="container px-5">
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div>
                        <h2 class="main_title">Gerenciamento de Produtos</h2>
                        <p class="main_description">O gerenciamento de produtos é um dos fatores que envolve todo o processo de administração competente de uma empresa.</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <img class="img-fluid" src="/images/home/gerenciamento.svg" alt="">
            </div>
        </div>
    </div>
</section>
@endsection