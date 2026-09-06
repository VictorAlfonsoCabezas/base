@extends('layouts.app')
@section('title')Categorias Chat @stop
@section('breadcrumbs1')Categorias @stop
@section('breadcrumbs2')Categorias @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Categorias</h4>
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
                <a onclick="javascript:modalCategory(0);" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Crear Categoria</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-category" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Nombres</th>
                    <th class="text-nowrap">Descripción</th>
                    <th data-orderable="false">Estado</th>
                    <th data-orderable="false">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $cat)
                <tr id='{{$cat->id}}'>
                    <td width="1%">{{$cat->id}}</td>
                    <td>{{$cat->name}}</td>
                    <td>{{$cat->description}}</td>
                    <td class="text-center">
                        @if($cat->status)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a onclick="javascript:modalCategory('{!!$cat->id!!}');" class="btn btn-outline-blue btn-circle btn-xs">
                            <i class="ion ion-md-create "></i>
                        </a>
<!--                         <a class="btn btn-outline-red btn-circle btn-xs">
                            <i class="ion ion-md-trash "></i>
                        </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('categorychat/modal_category')
@endsection
@section('scripts')


<script type="text/javascript">
    $(document).ready(function() {
        $("#table-category").DataTable({
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

    function modalCategory(id) {
        if (id !== 0) {
            $.ajax({
                url: "{{URL::to('categorychat')}}/" + id + "/edit",
                type: 'GET',
                success: function(res) {
                    $('#name').val(res.name);
                    $('#description').val(res.description);
                    $('#id_category').val(res.id);
                    $('#modalCategory').modal('show');
                }
            });
        } else {
            $('#name').val('');
            $('#description').val('');
            $('#id_category').val(0);
            $('#modalCategory').modal('show');
        }
    }

    function saveCategory() {
        var name = $('#name').val();
        var description = $('#description').val();
        
        if ($('#id_category').val() == 0) {
            var method = 'POST';
            var url = "{{URL::to('categorychat')}}";
        } else {
            var method = 'PUT';
            var url = "{{URL::to('categorychat')}}/" + $('#id_category').val();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                name: name,
                description: description,
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