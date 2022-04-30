@extends('admin.layout.index')

@section('title', 'Gerenciador - produtos')

@section('content')
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg w-100">
        <div class="row border-bottom"></div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>E-commerce product list</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>E-commerce</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Product list</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label" for="product_name">Product Name</label>
                            <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="price">Price</label>
                            <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="quantity">Quantity</label>
                            <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label" for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" selected>Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Categoria</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                        <th>Estoque</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>
                                                <a href="{{route('product.show', $product->id)}}" style="color: #212529; display: block; width: max-content;">
                                                {{$product->product}}
                                                </a>
                                            </td>
                                            <td>
                                                @foreach ($categories as $category)
                                                    @if ($category->id == $product->category_id)
                                                        {{$category->category}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($product->description == "")
                                                    Vazio
                                                @else
                                                    {{$product->description}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$product->price}}
                                            </td>
                                            <td>
                                                @if ($product->stock == 0)
                                                    Esgotado
                                                @else
                                                    {{$product->stock}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger" onclick="exibirModal({{$product->id}}, '#modalDelete', '/admin/product/delete/')"><i class="fa fa-trash"></i> Excluir</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Lista de produtos vazia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <ul class="pagination float-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="float-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2018
            </div>
        </div>
    </div>
</div>

{{-- @include('layouts.modal-delete') --}}

<!-- Mainly scripts -->
<script src="/js/inspinia/jquery-3.1.1.min.js"></script>
<script src="/js/inspinia/popper.min.js"></script>
<script src="/js/inspinia/bootstrap.js"></script>
<script src="/js/inspinia/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/inspinia/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/inspinia/inspinia.js"></script>
<script src="/js/inspinia/plugins/pace/pace.min.js"></script>

<!-- FooTable -->
<script src="/js/inspinia/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();

    });

</script>
@endsection
