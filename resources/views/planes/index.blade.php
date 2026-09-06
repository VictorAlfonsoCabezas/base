@extends('layouts.app')
@section('title')Planes @stop
@section('breadcrumbs1')Planes @stop
@section('breadcrumbs2')Planes @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Planes</h4>
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
                <a href="planes/create" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Agregar</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-plan" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Nombre</th>
                    <th class="text-nowrap">Precio Mensual</th>
                    <th class="text-nowrap">Precio Anual</th>
                    <th data-orderable="false">Estado</th>
                    <th data-orderable="false">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planes as $value)
                <tr id='{{$value->id}}'>
                    <td>{{$value->id}}</td>
                    <td style="color: {{$value->color_1}};">{{$value->name}}</td>
                    <td><b>${{$value->month_price}}</b></td>
                    <td><b>${{$value->year_price}}</b></td>
                    <td class="text-center">
                        @if($value->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-lime rounded-pill">Deshabilitada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{URL::to('planes/'.$value->id.'/edit')}}" method="GET" class="btn btn-outline-red btn-circle btn-xs"><i class="fas fa-edit"></i></a>
                        <button onclick="javascript:eliminarPlan('{!! $value->id !!}')" class="btn btn-outline-blue btn-circle btn-xs"><i class="far fa-trash-alt"></i></button>
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
        $("#table-plan").DataTable({
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
            },
        });
    });

    function eliminarPlan(id) {
        Swal.fire({
            title: "Seguro de realizar esta transacción?",
            text: "¡Este Plan se desctivará, y no podrá ser visualizado por los Clientes!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar"
        }).then(function(result) {
            if (result.value) {
                loading();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "DELETE",
                    url: "{{URL::to('planes')}}/" + id
                }).done(function(res) {
                    stoploading();
                    if (res) {
                        $('#' + res.id).remove();
                        $('#cantidad').html(res.cantidad);
                    }
                });

            }
        });

    }
</script>
@stop