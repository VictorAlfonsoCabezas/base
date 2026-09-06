@extends('layouts.app')
@section('title')Doctor @stop
@section('breadcrumbs1')Doctor @stop
@section('breadcrumbs2')Doctor @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Doctores</h4>
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
        <table id="table-doctor" class="table table-striped table-bordered align-middle table-hover">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th width="10%">Empresa</th>
                    <th class="text-nowrap">Fecha Creación</th>
                    <th data-orderable="false">Nombre</th>
                    <th class="text-nowrap">Codigo Intélho</th>
                    <th data-orderable="false">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctor as $doc)
                <tr id='{{$doc->id}}'>
                    <td width="1%">{{$doc->id}}</td>
                    <td>{{$doc->company->company_name}}</td>
                    <td width="10%">{{$doc->date_created}}</td>
                    <td>
                        {{$doc->name}}
                        <a onclick="javascript:showSchedule('{!! $doc->id !!}');" class="btn btn-outline-primary btn-xs px-2" style="float: right;" title="Ver Horarios del Médico"><i class="fas fa-clock"></i></a>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-warning rounded-pill">{{$doc->code_intel}}</span>
                    </td>
                    <td class="text-center">
                        @if($doc->status)
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
@include('doctor/modal_schedule')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-doctor").DataTable({
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

    function showSchedule(doctor) {
        $('#formSchedule').modal('show');
        $.ajax({
            type: "GET",
            url: '{{URL::to("doctor")}}/' + doctor
        }).done(function(res) {
            $('#modal_title').html('Dr.a ' + res[0].doctor_name);
            detail = '';
            detail += '<div class="accordion" id="accordion">';
            detail += '    <div class="accordion-item border-3">';
            $.each(res, function(index, value) {
                detail += '        <div class="accordion-header" id="heading-' + index + '">';
                detail += '            <button class="accordion-button bg-blue text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-' + index + '">';
                detail += '                 <i class="fa fa-circle fa-fw text-yellow me-2 fs-8px"></i>' + value.day_name;
                detail += '            </button>';
                detail += '        </div>';
                detail += '        <div id="collapse-' + index + '" class="accordion-collapse collapse" data-bs-parent="#accordion">';
                detail += '            <div class="accordion-body bg-blue text-white">';
                detail += '                <table class="table table-bordered" style="color: white;">';
                detail += '                     <tbody>';
                detail += '                         <tr>';
                detail += '                             <td><b>Dia: </b></td>';
                detail += '                             <td>' + value.day + '</td>';
                detail += '                         </tr>';
                detail += '                         <tr>';
                detail += '                             <td><b>Hora Inicio: </b></td>';
                detail += '                             <td>' + value.hour_start + '</td>';
                detail += '                         </tr>';
                detail += '                         <tr>';
                detail += '                             <td><b>Hora Fin: </b></td>';
                detail += '                             <td>' + value.hour_end + '</td>';
                detail += '                         </tr>';
                detail += '                         <tr>';
                detail += '                             <td><b>Total Citas: </b></td>';
                detail += '                             <td>' + value.date_total + '</td>';
                detail += '                         </tr>';
                detail += '                         <tr>';
                detail += '                             <td><b>Intervalo: </b></td>';
                detail += '                             <td>' + value.interval + ' <b>min.</b></td>';
                detail += '                         </tr>';
                detail += '                     </tbody>';
                detail += '                </table>';
                detail += '            </div>';
                detail += '        </div>';
            });
            detail += '    </div>';
            detail += '</div>';
            $('#diasTabs').html(detail);
        });
    }
</script>
@stop