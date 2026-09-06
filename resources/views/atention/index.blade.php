@extends('layouts.app')
@section('title')Atención @stop
@section('breadcrumbs1')Atención @stop
@section('breadcrumbs2')Atención @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Atenciónes</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="table-atention2" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Empresa</th>
                    <th class="text-nowrap">Cliente</th>
                    <th class="text-nowrap">Sede</th>
                    <th class="text-nowrap">Departamento</th>
                    <th class="text-nowrap">Doctor</th>
                    <th class="text-nowrap">Fecha Creación</th>
                    <th class="text-nowrap">Fecha Apertura</th>
                    <th class="text-nowrap">Fecha Atención Inicio</th>
                    <th class="text-nowrap">Fecha Atención Fin</th>
                    <th class="text-nowrap">Oda</th>
                    <th class="text-nowrap">Área Genera</th>
                    <th class="text-nowrap">Observación</th>
                    <th class="text-nowrap">Estado de Atención</th>
                    <th class="text-nowrap">Estado de Pago</th>
                    <th class="text-nowrap">Externa</th>
                    <th class="text-nowrap">Fecha Pedido</th>
                    <th class="text-nowrap">Codigo Intélho</th>
                    <th data-orderable="false">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atention as $aten)
                <tr id='{{$aten->id}}'>
                    <td width="1%">{{$aten->id}}</td>
                    <td>{{$aten->company->company_name}}</td>
                    <td><a href="javascript:openProcedures('{!! $aten->id !!}')">{{$aten->customer->name}}</a></td>
                    <td>{{$aten->sede->name}}</td>
                    <td>{{$aten->departament->name}}</td>
                    <td>{{(isset($aten->doctor_id)) ? $aten->doctor->name : ''}}</td>
                    <td>{{$aten->date_created}}</td>
                    <td>{{$aten->date_opening}}</td>
                    <td>{{$aten->date_atention}}</td>
                    <td>{{$aten->date_atention_end}}</td>
                    <td><b>{{$aten->oda}}</b></td>
                    <td>{{$aten->departamentGenera->name}}</td>
                    <td>{{$aten->observation}}</td>
                    <td class="text-center">
                        @if($aten->status_atention == 1)
                        <span class="badge bg-primary rounded-0">Generados</span>
                        @elseif($aten->status_atention == 2)
                        <span class="badge bg-warning rounded-0">Atendidos</span>
                        @elseif($aten->status_atention == 3)
                        <span class="badge bg-yellow rounded-0">Revisadas</span>
                        @elseif($aten->status_atention == 4)
                        <span class="badge bg-lime rounded-0">Enviadas</span>
                        @elseif($aten->status_atention == 5)
                        <span class="badge bg-green rounded-0">Rechazadas</span>
                        @elseif($aten->status_atention == 6)
                        <span class="badge bg-success rounded-0">Generar Factura</span>
                        @else
                        <span class="badge bg-danger rounded-0">Ninguno</span>
                        @endif
                    </td>
                    <td>{{$aten->status_pay}}</td>
                    <td class="text-center">
                        @if($aten->generation_area_externa)
                        <span class="badge bg-primary rounded-0">Externa</span>
                        @else
                        <span class="badge bg-yellow rounded-0">Hospitalizaación</span>
                        @endif
                    </td>
                    <td class="text-center">{{$aten->date_order}}</td>
                    <td class="text-center">
                        <span class="badge bg-warning rounded-pill">{{$aten->code_intel}}</span>
                    </td>
                    <td class="text-center">
                        @if($aten->status)
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
@include('atention/modal_procedures')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-atention2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "order": [
                [0, "desc"]
            ],
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

    function openProcedures(id) {
        $.ajax({
            type: "GET",
            url: '{{URL::to("atention/showProcedures")}}/' + id
        }).done(function(res) {
            var det = '';
            $.each(res.detalle, function(index, value) {
                det += '<tr>';
                det += '    <td>' + value.id + '</td>';
                det += '    <td><b>' + value.procedures_name + '</b></td>';
                det += '    <td class="text-center">';
                if (value.status) {
                    det += '    <span class="badge bg-blue rounded-pill">Activo</span>';
                } else {
                    det += '    <span class="badge bg-red rounded-pill">Inactivo</span>';
                }
                det += '    </td>';
                det += '</tr>';
            });
            $('#detalle_procedures > tbody').html(det);

            var detail = '';
            $.each(res.recetas, function(index, value) {
                detail += '<tr>';
                detail += '    <td>' + value.id + '</td>';
                detail += '    <td><b>' + value.medicine_name + '</b></td>';
                detail += '    <td><b>' + value.dosis + '</b></td>';
                detail += '    <td><b>' + value.observation + '</b></td>';
                detail += '    <td class="text-center">';
                if (value.status_dispatched) {
                    detail += '    <span class="badge bg-blue rounded-pill">Activo</span>';
                } else {
                    detail += '    <span class="badge bg-red rounded-pill">Inactivo</span>';
                }
                detail += '    </td>';
                detail += '</tr>';
            });
            $('#detalle_recetas > tbody').html(detail);
            $('#formProcedures').modal('show');
        });
    }
</script>
@stop