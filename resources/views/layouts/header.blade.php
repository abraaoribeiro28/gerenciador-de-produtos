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
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/archives">Imagens</a>
                    </li>
                    @endauth
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Páginas
                                <i class="fa fa-chevron-right dropdown-arrow"></i>
                            </a>
                            <div class="dropdown-menu" id="menu-paginas" aria-labelledby="navbarDropdown">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="title_pages">Produtos</h6>
                                        <a class="dropdown-item" href="/example/products">Produtos</a>
                                        <a class="dropdown-item" href="/example/product/create">Criar produto</a>
                                        <a class="dropdown-item" href="/example/product/edit">Editar produto</a>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="title_pages">Categorias</h6>
                                        <a class="dropdown-item" href="/example/categories">Categories</a>
                                        <a class="dropdown-item" href="/example/category/create">Criar categoria</a>
                                        <a class="dropdown-item" href="/example/category/edit">Editar Categoria</a>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <h6 class="title_pages">Imagens</h6>
                                        <a class="dropdown-item" href="/example/archives">Archives</a>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <h6 class="title_pages">User</h6>
                                        <a class="dropdown-item" href="/example/login">Login</a>
                                        <a class="dropdown-item" href="/example/register">Register</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/learnmore">Saiba mais</span></a>
                        </li>
                    @endguest 
                </ul>
                @auth
                    <form action="/logout" method="post" class="btn-logout">
                        @csrf
                        <button type="submit" class="btn bg-azul">
                            Sair
                            <i class="fa fa-sign-out ml-1"></i>
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="/login" class="btn bg-azul btn-login">
                        Entrar
                        <i class="fa fa-sign-in ml-1"></i>
                    </a>
                @endguest
            </div>
            
        </div>
    </nav>
</header>