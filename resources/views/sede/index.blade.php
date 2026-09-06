@extends('layouts.app')
@section('title')Sedes @stop
@section('breadcrumbs1')Sedes @stop
@section('breadcrumbs2')Sedes @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Sedes</h4>
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
        <table id="table-sede" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Empresa</th>
                    <th class="text-nowrap">Fecha Creación</th>
                    <th data-orderable="false">Nombre</th>
                    <th class="text-nowrap" width="1%">Codigo Intélho</th>
                    <th data-orderable="false">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sede as $sed)
                <tr id='{{$sed->id}}'>
                    <td width="1%">{{$sed->id}}</td>
                    <td>{{$sed->company->company_name}}</td>
                    <td>{{$sed->date_created}}</td>
                    <td>
                        <b>{{$sed->name}}</b>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-warning rounded-pill">{{$sed->code_intel}}</span>
                    </td>
                    <td class="text-center">
                        @if($sed->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Inactivo</span>
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
        $("#table-sede").DataTable({
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