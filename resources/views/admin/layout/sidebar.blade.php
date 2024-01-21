<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>

    <div class="p-4">
        <h1><a href="{{route('admin')}}" class="logo">Gerenciador <span>Por: Abraão Ribeiro</span></a></h1>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{route('admin')}}"><span class="fa fa-home mr-3"></span> Dashboard</a>
            </li>
            <li>
                <a href="{{route('products')}}"><i class="fa fa-shopping-cart  mr-3"></i> Produtos</a>
            </li>
            <li>
                <a href="{{route('categories')}}"><span class="fa fa-sticky-note mr-3"></span> Categorias de Produtos</a>
            </li>
            <li>
                <a href="{{route('archives.index')}}"><span class="fa fa-suitcase mr-3"></span> Galeria de Imagens</a>
            </li>
        </ul>
    </div>
</nav>
