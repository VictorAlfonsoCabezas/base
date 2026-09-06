@extends('layouts.app')
@section('title')Roles @stop
@section('breadcrumbs1')Roles @stop
@section('breadcrumbs2')Roles @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Arbol de Roles</h4>
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
        <div class="row">
            <section class="col-lg-5">

                <div class="panel panel-inverse" data-sortable-id="ui-widget-3" data-init="true">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Roles disponible</h4>
                    </div>
                    <div class="panel-body">
                        <form class="smart-form" id="invoice_form" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <form class="form-inline" role="form">
                                        <section class="col col-lg-4">
                                            <div class="form-group">
                                                <label>NOMBRE ROL</label>
                                                <input type="text" class="form-control text-uppercase" id="descripcion" name="descripcion" placeholder="Nombre" required="">
                                            </div>
                                        </section>
                                        <section class="col col-lg-4">
                                            <div class="form-group">
                                                <label>DESCRIPCIÓN</label>
                                                <input type="text" class="form-control text-uppercase" id="observacion" name="observacion" placeholder="Observaciones" size="15" required="">
                                            </div>
                                        </section>
                                        <section class="col col-lg-3">
                                            <div class="form-group">
                                                <label>MENU</label>
                                                <select class="form-select form-select-xs" id="menu_type" name="menu_type">
                                                    <option value="DEFAULT">DEFECTO</option>
                                                </select>
                                            </div>
                                        </section>
                                        <section class="col col-lg-1">
                                            <a type="button" onclick="javascript:agregarRol()" class="btn btn-primary btn-sm" style="color: white; position: absolute; top: 261px;"><i class="fa fa-plus"></i></a>
                                        </section>
                                    </form>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table class="table table-bordered table-hover" id="tabla_roles">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-archive"></i> Nombre</th>
                                    <th><i class="fas fa-chart-pie"></i> Dashboard</th>
                                    <th><i class="fa fa-eye"></i> Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                <tr>
                                    <td scope="row">
                                        <b>{{$rol->nombre}}</b>
                                        <br>{{$rol->observation}}
                                    </td>
                                    <td>
                                        <select class="form-select form-select-lg" onchange="javascript:cambioMenu('{!! $rol->id !!}');" id="menu_type-{{$rol->id}}">
                                            <option value="DEFAULT" {{($rol->menu_type == 'DEFAULT')?'selected=""':''}}>DEFECTO</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:obtenerArbol('{!! $rol->id !!}', '{!! $rol->nombre !!}');" class="btn btn-primary" title="Ver"><i class="fa fa-eye"></i></a>
                                        <a onclick="javascript:eliminarRol('{!! $rol->id !!}');" title="Eliminar" class="btn btn-warning"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section class="col-lg-7">
                <div class="panel panel-inverse" data-sortable-id="ui-widget-3" data-init="true">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Opciones del Rol</h4>
                    </div>
                    <div class="panel-body">
                        <div class="widget-body-toolbar bg-color-white">
                            <form class="form-inline" role="form">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-10">
                                        <p id="nombre_rol">NINGUN ROL SELECCIONADO</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="arbol">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.sidebar-mini').addClass('sidebar-collapse');
        $('.metisFolder').metisMenu({
            toggle: false
        });
    });

    function agregarRol() {
        var descripcion = $('#descripcion').val();
        var observacion = $('#observacion').val();
        var menu_type = $('#menu_type').val();
        if (descripcion != "" && observacion != "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{URL::to('arbolrole')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nombre: descripcion,
                    observation: observacion,
                    menu_type: menu_type,
                },
            }).done(function(data) {
                location.reload();
            });
        }
    }

    function obtenerArbol(rol, nombre) {
        $('#nombre_rol').html('OPCIONES DEL ROL: ' + nombre);
        $.ajax({
            method: "GET",
            url: "arbolrole/tree/" + rol,
        }).done(function(res) {
            var detalle = '';
            detalle += '<div class="container mt-2">';
            detalle += '    <div class="row">';
            detalle += '        <div class="md-3">';
            detalle += '            <nav class="nav">';
            detalle += '                <ul class="metisFolder metismenu">';
            detalle += '                    <li class="mm-active">';
            detalle += '                        <a href="#"><span class="fas fa-fw fa-folder-open"></span> ' + nombre + '</a>';
            $.each(res, function(data, value) {
                detalle += '                        <ul>';
                detalle += '                            <li>';
                detalle += '                                <a><span class="' + value.icono + '"></span> ' + value.nombre + '</a>';
                if (value.activo == true) {
                    detalle += '                                 <input checked="" class="menu_rol" value="' + rol + '" data-menuid=' + value.id + ' type="checkbox" style="position: absolute; top: 7px; right: -63px; height: 20px; width: 20px;">';
                } else {
                    detalle += '                                 <input class="menu_rol" value="' + rol + '" data-menuid=' + value.id + ' type="checkbox" style="position: absolute; top: 7px; right: -63px; height: 20px; width: 20px;">';
                }
                $.each(value.submenu, function(data2, value2) {
                    detalle += '                                <ul>';
                    detalle += '                                    <li><a href="#" ><span class="' + value2.icono + '"></span> ' + value2.nombre + '</a>';
                    if (value2.activo == true) {
                        detalle += '                                        <input checked="" class="menu_rol" value="' + rol + '" data-menuid=' + value2.id + ' type="checkbox" style="position: absolute; top: 7px; right: -63px; height: 20px; width: 20px;">';
                    } else {
                        detalle += '                                        <input class="menu_rol" value="' + rol + '" data-menuid=' + value2.id + ' type="checkbox" style="position: absolute; top: 7px; right: -63px; height: 20px; width: 20px;">';
                    }
                    detalle += '                                    </li>';
                    detalle += '                                </ul>';
                });
                detalle += '                            </li>';
                detalle += '                        </ul>';
            });
            detalle += '                    </li>';
            detalle += '                </ul>';
            detalle += '            </nav>';
            detalle += '        </div>';
            detalle += '    </div>';
            detalle += '</div>';
            $('#arbol').html(detalle);
            $('.metisFolder').metisMenu({
                toggle: false
            });
            $('.menu_rol').on('change', function() {
                var data = {
                    menu_id: $(this).data('menuid'),
                    rol_id: $(this).val(),
                    _token: $('input[name=_token]').val()
                };
                if ($(this).is(':checked')) {
                    data.estado = 1
                } else {
                    data.estado = 0
                }
                ajaxRequest('menu-rol', data);
            });
        });
    }

    function ajaxRequest(url, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(respuesta) {
                MensajeVerde.notificaciones(respuesta.respuesta, 'Notificación', 'success');
            }
        });
    }

    function eliminarRol(id) {
        Swal.fire({
            title: "Seguro de Eliminar",
            text: "¡Tu no podras revertir esta operacion!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Eliminar Definitivamente..."
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "DELETE",
                    url: "{{URL::to('arbolrole')}}/" + id,
                }).done(function(res) {
                    if (res) {
                        location.reload(true);
                    }
                });
            }
        });
    }

    function cambioMenu(id) {
        var menu_type = $('#menu_type-' + id).val();
        $.ajax({
            method: "PUT",
            url: "{{URL::to('arbolrole/cambioMenu')}}/" + id,
            data: {
                "_token": "{{ csrf_token() }}",
                menu_type: menu_type,
                id: id
            },
        }).done(function(res) {
            if (res) {
                console.log('cambio exitoso');
            }
        });
    }
</script>
@stop