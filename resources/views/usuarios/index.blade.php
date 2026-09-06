@extends('layouts.app')
@section('title')Menus @stop
@section('breadcrumbs1')Usuarios @stop
@section('breadcrumbs2')Usuarios @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Clientes</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body">
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <a href="{{ URL::to('usuarios/create') }}" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Agregar</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table_user" class="table table-striped table-bordered align-middle">
            <thead>
                <tr id="busqueda">
                    <th class="filtre">#</th>
                    <th class="text-nowrap">Nombre</th>
                    <th class="text-nowrap filtre">Username</th>
                    <th class="text-nowrap filtre">Email</th>
                    <th data-orderable="false"></th>
                    <th data-orderable="false"></th>
                    <th data-orderable="false"></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@include('menu/modal_menus')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        listarTabla();
    });
    function listarTabla() {
        console.log('usuarios');
        var oTable = $('#table_user').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[2, "DESC"]],
            "ajax": {
                url: "{{URL::to('usuarios/verDatos')}}",
                "dataType": "json",
                "type": "GET",
                "async": false
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'username'},
                {data: 'email'},
                {data: 'rol_name', orderable: false},
                {data: 'status', orderable: false},
                {data: 'acciones', orderable: false},
            ]
        });

        $('#table_user thead #busqueda .filtre').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" class="form-control"/>');
        });
        var table = $('#table_user').DataTable({
            bRetrieve: true,
            scrollX: true,
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json'
            }
        });

        $("#table_user thead th  input[type=text]").on('change', function () {
            table.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
        });

        setInterval(function () {
            oTable.ajax.reload(null, false);
        }, 5000);
    }
    function cambioEstado(id) {
        console.log(id);
        $.ajax({
            method: "GET",
            url: "usuarios/cambioEstado/" + id,
        }).done(function (res) {
            console.log(res);
        });
    }
</script>
@endsection

