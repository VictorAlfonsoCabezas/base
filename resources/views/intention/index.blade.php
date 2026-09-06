@extends('layouts.app')
@section('title')Intenciones @stop
@section('breadcrumbs1')Intenciones @stop
@section('breadcrumbs2')Intenciones @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Intenciones</h4>
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
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <a onclick="javascript:modalRegion(0);" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Crear</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-intention" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Nombres</th>
                    <th class="text-nowrap">Descripcion</th>
                    <th class="text-nowrap">Código</th>
                    <th data-orderable="false">Estado</th>
                    <th data-orderable="false">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($botIntention as $intention)
                <tr id='{{$intention->id}}'>
                    <td width="1%">{{$intention->id}}</td>
                    <td>{{$intention->name}}</td>
                    <td>{{$intention->description}}</td>
                    <td><b>{{$intention->code}}</b></td>
                    <td class="text-center">
                        @if($intention->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Activo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a onclick="javascript:modalIntention('{!!$intention->id!!}');" class="btn btn-outline-blue btn-circle btn-xs">
                            <i class="ion ion-md-create "></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('intention/modal_intention')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-intention").DataTable({
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

    function modalIntention(id) {
        if (id !== 0) {
            $.ajax({
                url: "{{URL::to('intention')}}/" + id + "/edit",
                type: 'GET',
                success: function(res) {
                    $('#name').val(res.name);
                    $('#country_id').val(res.country_id);
                    $('#code').val(res.code);
                    $('#id_region').val(res.id);
                    $('#modalRegion').modal('show');
                }
            });
        } else {
            $('#name').val('');
            $('#country_id').val(59);
            $('#code').val('');
            $('#id_region').val(0);
            $('#modalRegion').modal('show');
        }
    }

    function saveRegion() {
        var name = $('#name').val();
        var country_id = $('#country_id').val();
        var code = $('#code').val();
        if ($('#id_region').val() == 0) {
            var method = 'POST';
            var url = "{{URL::to('region')}}";
        } else {
            var method = 'PUT';
            var url = "{{URL::to('region')}}/" + $('#id_region').val();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                name: name,
                country_id: country_id,
                code: code,
            },
            success: function(res) {
                if (res) {
                    location.reload();
                }
            }
        });
    }
</script>
@stop