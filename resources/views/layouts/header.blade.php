<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-5">
            <h2 class="navbar-brand m-0">Gerenciador</h2>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Páginas
                                <i class="fa fa-chevron-right dropdown-arrow"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/exemple/products">Produtos</a>
                                <a class="dropdown-item" href="/exemple/product/create">Criar produto</a>
                                <a class="dropdown-item" href="/exemple/product/edit">Editar produto</a>
                                <a class="dropdown-item" href="/exemple/categories">Categories</a>
                                <a class="dropdown-item" href="/exemple/category/create">Criar categoria</a>
                                <a class="dropdown-item" href="/exemple/category/create">Editar Categoria</a>
                                <a class="dropdown-item" href="/exemple/archives">Archives</a>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn bg-azul">
                        Sair
                        <i class="fa fa-sign-out ml-1"></i>
                    </button>
                </form>
            @endauth
            @guest
                <a href="/login" class="btn bg-azul">
                    Entrar
                    <i class="fa fa-sign-in ml-1"></i>
                </a>
            @endguest
        </div>
    </nav>
</header>

<section class="landing">
    <div class="container px-5">
        <div class="row">
            <div class="col-6">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div>
                        <h2>Build your next project faster</h2>
                        <p>Welcome to SB UI Kit Pro, a toolkit for building beautiful web interfaces, created by the development team at Start Bootstrap</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <img class="img-fluid" src="/images/home/gerenciamento.jpg" alt="">
            </div>
        </div>
    </div>
</section>