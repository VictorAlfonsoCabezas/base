@extends('layouts.app')
@section('title')Clientes @stop
@section('breadcrumbs1')Clientes @stop
@section('breadcrumbs2')Clientes @stop
@section('custom_css') @stop
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
                <a href="#" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Boton</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-customer" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Nombres</th>
                    <th class="text-nowrap">Documento</th>
                    <th class="text-nowrap">Dirección</th>
                    <th data-orderable="false">Convencional</th>
                    <th data-orderable="false">Celular(es)</th>
                    <th data-orderable="false">Email</th>
                    <th data-orderable="false">Fecha Nacimiento</th>
                    <th data-orderable="false">Nacionalidad</th>
                    <th data-orderable="false">Sexo</th>
                    <th data-orderable="false">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr id='{{$cliente->code}}'>
                    <td width="1%">{{$cliente->id}}</td>
                    <td>{{$cliente->name}}</td>
                    <td>{{$cliente->numero_documento}}</td>
                    <td>{{$cliente->direccion}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->celular_1.$cliente->celular_2.$cliente->celular_3}}</td>
                    <td>{{$cliente->correo}}</td>
                    <td>{{$cliente->birth_date}}</td>
                    <td>{{$cliente->nationality}}</td>
                    <td class="text-center">
                        @if($cliente->sex == 'M')
                        <i class="ion ion-md-man fa-2x"></i>
                        @elseif($cliente->sex == 'F')
                        <i class="ion ion-md-woman fa-2x"></i>
                        @endif
                    </td>
                    <td>
                        @if($cliente->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Activo</span>
                        @endif
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
    $(document).ready(function() {
        $("#table-customer").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de MAX registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar MENU registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Busqueda:",
                "searchPlaceholder": "Datos para buscar",
                "zeroRecords": "No se han encontrado coincidencias.",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": "Ordenación ascendente",
                    "sortDescending": "Ordenación descendente"
                }
            }
        });
    });
</script>
@stop