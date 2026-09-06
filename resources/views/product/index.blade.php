@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="row">
    <section class="col-lg-3">
        <div class="small-box bg-dark shadow-lg">
            <div class="inner">
                <h3>{{$cantidad}}</h3>
                <p>Productos</p>
            </div>
            <div class="icon">
                <i class="fab fa-product-hunt"  style="color: white;"></i>
            </div>
            <a href="product/create" class="small-box-footer">Crear Producto <i class="fas fa-plus-circle"></i></a>
        </div>
    </section>
    <section class="col-lg-9">
        @include('includes.mensaje')
    </section>
</div>

<div  class="card card-dark shadow-lg bg-white rounded">
    <div class="card-header">
        LISTA DE PRODUCTOS.
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered" style="width:100%" id="table_productos">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>                            
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>                    
                    <th scope="col">Precio</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Lotes</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as  $product)
                <tr>
                    <th scope="row">{{ $product->id}}</td>
                    <td>{{ $product->name}}</td>                            
                    <td>{{ $product->description}}</td>
                    <td>{{ $product->precio_a}}</td>
                    <td>{{ $product->tipo}}</td>
                    <td>{{ $product->stock}}</td>
                    <td>{{ $product->lotes}}</td>
                    <td>
                        <form action="{{URL::to('product/'. $product->id)}}" method="POST">
                            @csrf
                            @method("delete")
                            <a href="{{URL::to('product/'. $product->id.'/edit')}}" method="GET" class="btn btn-warning btn-xs" style="color:white;"><i class="fas fa-edit"></i> Editar</a>
                            <button type="submit" class="btn btn-primary btn-xs" style="color: white;"><i class="far fa-trash-alt"></i> Eliminar</button>
                        </form>                        
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#table_productos').DataTable();
    });
</script>
@stop
