@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="row">
    <section class="col-lg-3">
        <div class="small-box bg-dark shadow-lg">
            <div class="inner">
                <h3>{{$cantidad}}</h3>
                <p>Categorias</p>
            </div>
            <div class="icon">
                <i class="fas fa-ad" style="color: white;"></i>
            </div>
            <a href="category/create" class="small-box-footer">Crear Categoria <i class="fas fa-plus-circle"></i></a>
        </div>
    </section>
    <section class="col-lg-9">
        @include('includes.mensaje')
    </section>
</div>

<div class="card card-dark shadow-lg bg-white rounded">
    <div class="card-header">
        LISTA DE CATEGORIAS.
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered" style="width: 100%" id="table_category">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $value)
                <tr id='{{$value->id}}'>
                    <td>{{$value->id}}</td>
                    <td>
                        @if ($value->photo !== '' && $value->photo !== null) 
                        <img alt="{{$value->title}}" src="uploads/categories/{{$value->photo}}"  id="logo" title="{{$value->title}}" class="img-thumbnail img-responsive superbox-img photo" style="width: 55px;"/>
                        @else
                        <img src="{{URL::asset('img/no-disponible.png')}}" alt="{{$value->comercial_name}}" title="{{$value->comercial_name}}" height="50" width="50"/>
                        @endif 
                    </td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->description}}</td>
                    <td style="text-align: center;"><span class="badge badge-primary">{{$value->type_name}}</span></td>
                    @if($value->status)
                    <td><span class="badge badge-warning">Activo</span></td>
                    @else
                    <td><span class="badge badge-danger">Inactiva</span></td>
                    @endif
                    <td>
                        <form action="{{URL::to('category/'.$value->id)}}" method="POST">
                            @csrf
                            @method("delete") 
                            <a href="{{URL::to('category/'.$value->id.'/edit')}}" method="GET" class="btn btn-warning btn-xs" style="color: white;"><i class="fas fa-edit"></i> Editar</a>
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
        $('#table_category').DataTable();
    });
</script>
@stop