@extends('layouts.app')
@section('title')Pagos @stop
@section('breadcrumbs1')Pagos @stop
@section('breadcrumbs2')Pagos @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Pagos</h4>
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <hr class="bg-gray-500" />
        <table id="table-pagos" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Cliente</th>
                    <th class="text-nowrap">Fecha Creacion</th>
                    <th class="text-nowrap">URL</th>
                    <th class="text-nowrap">Código</th>
                    <th data-orderable="false">Estado de Pago</th>
                    <th data-orderable="false">Estado</th>
                    <th data-orderable="false">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $pago)
                <tr id='{{$pago->id}}'>
                    <td width="1%">{{$pago->id}}</td>
                    <td><i class="fa fa-user"></i> {{$pago->nombreCliente}}</td>
                    <td><b>{{$pago->date_created}}</b></td>
                    <td><i class="fab fa-lg fa-fw me-10px fa-internet-explorer"></i> {{$pago->pay_smart_link_url}}</td>
                    <td><b>{{$pago->pay_smart_link}}</b></td>
                    <td> <span class="badge bg-green rounded-pill">{{$pago->pay_status}}</span</td>
                    <td class="text-center">
                        @if($pago->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a onclick="javascript:modalPagos('{!!$pago->id!!}');" class="btn btn-outline-blue btn-circle btn-xs">
                            <i class="ion ion-md-eye "></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('pagos/modal_pagos')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-pagos").DataTable({
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

    function modalPagos(id) {
        $.ajax({
            url: "{{URL::to('pagos')}}/" + id + '/edit',
            type: 'GET',
            success: function(res) {
                if (res) {
                    console.log(res);
                    info = '';
                    $.each(res, function(res, value) {
                        info += '  <tr>';
                        info += '      <td>' + value.id + '</td>';
                        info += '      <td><b>' + value.date_created + '</b></td>';
                        info += '      <td><span class="badge bg-green rounded-pill">' + value.pay_payment_method + '</span></td>';
                        info += '      <td><span class="badge bg-primary rounded-pill">' + value.pay_status + '</span></td>';
                        info += '  </tr>';
                    });
                    $('#tablePagosModal > tbody').html(info);
                    $('#modalPagos').modal('show');
                }
            }
        });
    }
</script>
@stop