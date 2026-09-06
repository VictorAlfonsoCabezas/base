@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="row">
    <section class="col-lg-3">
        <div class="small-box bg-dark shadow-lg">
            <div class="inner">
                <h3>{{$cantidad}}</h3>
                <p>Roles</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tag" style="color: white;"></i>
            </div>
            <a href="rol/create" class="small-box-footer">Crear Rol <i class="fas fa-plus-circle"></i></a>
        </div>
    </section>
    <section class="col-lg-9">
        @include('includes.mensaje')
    </section>
</div>

<div  class="card card-dark shadow-lg bg-white rounded">
    <div class="card-header">
        LISTA DE ROLES
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered" style="width:100%" id="table_roles">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <th scope="row">{{$data->id}}</th>
                    <td>{{$data->nombre}}</td>
                    <td>
                        <form action="{{URL::to('rol/'.$data->id)}}" method="POST">
                            @csrf
                            @method("delete")
                            <a href="{{URL::to('rol/'.$data->id.'/edit')}}" method="GET" class="btn btn-warning btn-xs" style="color: white;"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-dark btn-sm" onclick="javascript:editarRol():"><i class="fas fa-search" style="color: white;"></i></a>
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
        $('#table_roles').DataTable();
    });
</script>
@stop