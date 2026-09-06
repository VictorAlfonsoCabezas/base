@extends('layouts.app')
@section('title')Bots @stop
@section('breadcrumbs1')Bots @stop
@section('breadcrumbs2')Bots @stop
@section('custom_css')
<link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
@stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-3 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Empresas</h4>
            </div>
            <div class="panel-body bg-light">
                <table id="table-company-bot" class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Compania</th>
                            <th class="text-nowrap" data-orderable="false">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company as $compa)
                        <tr id="fil-{{$compa->id}}" class="table-company" onclick="javascript:selectCompany('{!! $compa->id !!}')">
                            <td>
                                {{$compa->ruc}}<br>
                                <b>{{$compa->company_name}}</b>
                            </td>
                            <td class="text-center">
                                @if($compa->status)
                                <label class="badge bg-blue">Activo</label>
                                @else
                                <label class="badge bg-danger">Inactivo</label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-9 ui-sortable">
        <div class="row">
            <div class="col-xl-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Bots</h4>
                        <input type="hidden" id="company-api">
                        <div class="btn-group my-n1" id="add-apiheader">

                        </div>
                    </div>
                    <div class="panel-body bg-light">
                        <div class="row">
                            <div id="div-header">
                                <p class="text-center"><i class="icon-direction h3 d-block"></i>Seleccione un Empresa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 ui-sortable">
                <div class="row">
                    <div class="col-xl-12 ui-sortable">
                        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                            <div class="panel-heading ui-sortable-handle">
                                <i class="fas fa-lg fa-fw me-10px fa-robot"></i><span>Detalle</span>&nbsp;
                                <input type="hidden" id="header-id">
                            </div>
                            <div class="panel-body bg-light">
                                <div id="div-detalle">
                                    <p class="text-center"><i class="icon-direction h3 d-block"></i>Seleccione un Empresa.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('bot/modal_header')
@include('bot/modal_intenciones')
@include('bot/modal_editar_mensaje')
@include('bot/modal_editar_mensaje_emoji')
@include('bot/modal_proximo_mensaje')
@include('bot/modal_editar_intencion')
@include('bot/modal_file')
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-company-bot").DataTable({
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
                "search": "Buscar:",
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

        $("#mensajeIntencionEmoji").emojioneArea({
            pickerPosition: "bottom",
            filtersPosition: "bottom",
            tonesStyle: "bullet"
        });
    });

    function selectCompany(company) {
        pintarFilas(company);
        $.ajax({
            url: "{{URL::to('bot')}}/" + company,
            type: 'GET',
            success: function(res) {
                $('#company-api').val(company);
                var botonaddapi = '';
                var botonaddapi = '<a onclick="javascript:agregarHeader();" class="btn btn-primary btn-xs"><i class=" fas fa-cloud"></i> Agregar</a>';
                $('#add-apiheader').html(botonaddapi);
                if (res.length === 0) {
                    limpiarCampos();
                } else {
                    var detalle = '';
                    detalle += '<p class="text-center"><i class="icon-direction h3 d-block"></i>Seleccione el Bot.</p>';
                    $('#div-detalle').html(detalle);
                    var historial = '';
                    historial += '<p class="text-center"><i class="icon-direction h3 d-block"></i>Seleccione el Bot.</p>';
                    $('#div-historial').html(historial);
                    addBots(res);
                }
            }
        });
    }

    function pintarFilas(id) {
        $('.table-company').removeClass('table-primary');
        $('#fil-' + id).addClass('table-primary');
    }

    function limpiarCampos() {
        // $('#company-api').val('');
        var header = '';
        header += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Información.</p>';
        $('#div-header').html(header);
        var detalle = '';
        detalle += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Información.</p>';
        $('#div-detalle').html(detalle);
        var historial = '';
        historial += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Información.</p>';
        $('#div-historial').html(historial);
    }

    function limpiarDetalles() {
        var detalle = '';
        detalle += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
        detalle += '    <li class="nav-item">';
        detalle += '        <a onclick="javascript:newDetalle();" class="nav-link active d-flex align-items-center">';
        detalle += '            <i class="ion-md-add-circle-outline fa-lg"></i>';
        detalle += '            <span class="d-none d-lg-inline ms-2">Nueva Pregunta</span>&nbsp;';
        detalle += '        </a>';
        detalle += '    </li>';
        detalle += '</ul>';
        detalle += '<hr class="bg-gray-500" />';
        detalle += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Informacion.</p>';
        $('#div-detalle').html(detalle);
        var historial = '';
        historial += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Información.</p>';
        $('#div-historial').html(historial);
    }

    function addBots(res) {
        var table = '';
        table += '<div style="height: 19vh; overflow: auto;">'
        table += '<table class="table table-sm mb-0 text-dark">';
        table += '  <tbody>';
        $.each(res, function(index, value) {
            table += '  <tr id="fila-' + value.id + '" class="table-bots">';
            table += '      <td>' + value.id + '</td>';
            table += '      <td><b>Nombre: </b><i>' + value.name + '</i><br>';
            table += '          <b>Descriopcion: </b><i>' + value.description + '</i>';
            table += '      </td>';
            table += '      <td>';
            if (value.status) {
                table += '  <label onclick="javascript:descativarHeader(' + value.id + ');" class="badge bg-blue">Activo</label>';
            } else {
                table += '  <label onclick="javascript:descativarHeader(' + value.id + ');" class="badge bg-danger">Inactivo</label>';
            }
            table += '      </td>';
            table += '      <td class="text-center">';
            table += '          <a onclick="javascript:selectBot(' + value.id + ');" class="btn btn-xs btn-default" title="Ver Detalle de Bots"><i class="fas fa-comment"></i></a>';
            table += '          <a onclick="javascript:editarHeader(' + value.id + ');" class="btn btn-xs btn-default" title="Editar Información de Bot"><i class="fas fa-pen"></i></a>';
            table += '      </td>';
            table += '  </tr>';
        });
        table += '  </tbody>';
        table += '</table>';
        table += '</div>';
        $('#div-header').html(table);
    }

    function descativarHeader(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('bot/desactivarBot')}}/" + id
        }).done(function(res) {
            if (res) {
                alerta.toast('Notificación', 'Cambio de estado', 'warning');
                addBots(res);
            }
        });
    }

    function selectBot(id) {
        pintarBots(id);
        $('#header-id').val(id);
        $.ajax({
            url: "{{URL::to('bot')}}/" + id + "/edit",
            type: 'GET',
            success: function(res) {
                if (res.detalle.length === 0) {
                    limpiarDetalles();
                } else {
                    addDetalle(res.header);
                }
            }
        });
    }

    function pintarBots(id) {
        $('.table-bots').removeClass('table-primary');
        $('#fila-' + id).addClass('table-primary');
    }

    function addDetalle(header) {
        var URLdomain = window.location.host;
        if (location.protocol === 'https:') {
            ssl = "https://";
        }else{
            ssl = "http://";
        }
        $.ajax({
            url: "{{URL::to('bot/addDetalles')}}/" + header,
            type: 'GET',
            success: function(res) {
                console.log(res);
                if (res === 0) {
                    var detalle = '';
                    detalle += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
                    detalle += '    <li class="nav-item">';
                    detalle += '        <a onclick="javascript:newDetalle();" class="nav-link active d-flex align-items-center">';
                    detalle += '            <i class="ion-md-add-circle-outline fa-lg"></i>';
                    detalle += '            <span class="d-none d-lg-inline ms-2">Nueva Pregunta</span>&nbsp;';
                    detalle += '        </a>';
                    detalle += '    </li>';
                    detalle += '</ul>';
                    detalle += '<hr class="bg-gray-500" />';
                    detalle += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No hay Informacion.</p>';
                    $('#div-detalle').html(detalle);
                } else {
                    var linea = '';
                    linea += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
                    linea += '    <li class="nav-item">';
                    linea += '        <a onclick="javascript:newDetalle();" class="nav-link active d-flex align-items-center">';
                    linea += '            <i class="ion-md-add-circle-outline fa-lg"></i>';
                    linea += '            <span class="d-none d-lg-inline ms-2">Nueva Pregunta</span>&nbsp;';
                    linea += '        </a>';
                    linea += '    </li>';
                    linea += '</ul>';
                    linea += '<hr class="bg-gray-500" />';
                    linea += '<div class="card-body">';
                    linea += '    <ul class="todo-list" data-widget="todo-list">';
                    $.each(res, function(index, value) {
                        var pregunta = index + 1;
                        linea += '        <li>';
                        linea += '            <span class="handle tooltip-test" style="margin: 6px" data-bs-toggle="tooltip" data-bs-placement="top" title="Arrastra para cambiar de Posiciones">';
                        linea += '                <i class="fas fa-ellipsis-v"></i>';
                        linea += '                <i class="fas fa-ellipsis-v"></i>';
                        linea += '            </span>';
                        linea += '            <div class="row">';
                        linea += '                <div class="col-xl-7 col-lg-7">';
                        linea += '                    <div class="widget-chat rounded mb-4" data-id="widget">';
                        linea += '                        <div class="widget-chat-body" data-scrollbar="true" style="overflow-y: scroll;height: 194px;">';


                        if (value.home_principal) {
                            linea += '<div class="text-center text-gray-500 m-2 fw-bold"><i class="fas fa-home fa-fw"></i> Menu Principal</div>';
                        }

                        linea += '  <div class="widget-chat-item with-media start">';
                        linea += '      <div class="widget-chat-media">';
                        linea += '          <img alt="" src="../intelho/logo_mini.png">';
                        linea += '      </div>';
                        linea += '      <div class="widget-chat-info">';
                        linea += '          <div class="widget-chat-info-container">';
                        linea += '              <div class="widget-chat-name text-indigo" onclick="javascript:modalEditarMensajeEmoji(' + value.id + ');">Sigcenter</div>';
                        linea += '                  <div class="widget-chat-message">';
                        linea += '                      <div class="row gx-1 mt-5px">';
                        if (value.path_file !== null && value.name_file !== null) {
                            if (value.file_extention == 'mp3') {
                                linea += '                          <div class="col-md-12">';
                                linea += '                              <a onclick="javascript:modalFile(' + value.id + ');" >';
                                linea += '                                  <audio controls>';
                                linea += '                                      <source src="'+ ssl + URLdomain + value.path_file + value.name_file +'" preload="auto" >';
                                linea += '                                  </audio>';
                                linea += '                              </a>';
                                linea += '                          </div>';
                                
                            }
                            
                            if (value.file_extention == 'mp4') {
                                linea += '                          <div class="col-md-12">';
                                linea += '                              <a onclick="javascript:modalFile(' + value.id + ');" >';
                                linea += '                              <video width="600" height="240" controls>';
                                linea += '                                  <source src="'+ ssl + URLdomain + value.path_file + value.name_file +'" type="video/mp4" />';
                                linea += '                              </video>';
                                linea += '                              </a>';
                                linea += '                          </div>';

                            }

                            if (value.file_extention == 'jpg' || value.file_extention == 'png' || value.file_extention == 'jpeg') {
                                linea += '                          <div class="col-md-12">';
                                linea += '                              <a onclick="javascript:modalFile(' + value.id + ');" class="widget-card widget-card-sm square mb-1">';
                                linea += '                                  <div class="widget-card-cover" style="background-image: url(' + value.path_file + value.name_file + ')"></div>';
                                linea += '                              </a>';
                                linea += '                          </div>';
                            }





                        }

                        linea += '                      ' + value.description + '</div>';
                        linea += '                  </div>';
                        linea += '              <div class="widget-chat-time">Mensaje</div>';
                        linea += '</div>';
                        linea += '      </div>';
                        linea += '</div>';

                        if (value.home) {
                            linea += '                            <div class="widget-chat-item with-media start">';
                            linea += '                                <div class="widget-chat-media" onclick="javascript:modalEditarMensajeEmoji(' + value.id + ');">';
                            linea += '                                    <img alt="" src="../intelho/logo_mini.png">';
                            linea += '                                </div>';
                            linea += '                                <div class="widget-chat-info">';
                            linea += '                                    <div class="widget-chat-info-container">';
                            linea += '                                        <div class="widget-chat-name text-indigo" onclick="javascript:modalEditarMensajeEmoji(' + value.id + ');">Menú</div>';
                            linea += '                                        <div class="widget-chat-message">' + value.home_texto;
                            linea += '                                        </div>';
                            linea += '                                        <div class="widget-chat-time">Menu</div>';
                            linea += '                                    </div>';
                            linea += '                                </div>';
                            linea += '                            </div>';
                        }

                        if (value.back) {
                            linea += '                            <div class="widget-chat-item with-media start">';
                            linea += '                                <div class="widget-chat-media" onclick="javascript:modalEditarMensajeEmoji(' + value.id + ');">';
                            linea += '                                    <img alt="" src="../intelho/logo_mini.png">';
                            linea += '                                </div>';
                            linea += '                                <div class="widget-chat-info">';
                            linea += '                                    <div class="widget-chat-info-container">';
                            linea += '                                        <div class="widget-chat-name text-indigo" onclick="javascript:modalEditarMensajeEmoji(' + value.id + ');">Volver</div>';
                            linea += '                                        <div class="widget-chat-message">' + value.back_texto;
                            linea += '                                        </div>';
                            linea += '                                        <div class="widget-chat-time">Volver</div>';
                            linea += '                                    </div>';
                            linea += '                                </div>';
                            linea += '                            </div>';
                        }

                        if (value.close_chat) {
                            linea += '<div class="text-center text-gray-500 m-2 fw-bold"><i class="fa fa-truck"></i> Mensaje Cierre Chat</div>';
                        }

                        if (value.send_inmediately) {
                            linea += '<div class="text-center text-gray-500 m-2 fw-bold"><i class="fa fa-bolt"></i> Envio Inmediato</div>';
                        }

                        linea += '                        </div>';
                        linea += '                    </div>';
                        linea += '                </div>';
                        linea += '                <div class="col-xl-5 col-lg-5">';
                        linea += '                    <div class="row">';
                        linea += '                        <div class="col-xl-12 col-lg-12">';
                        // linea += '                            <div class="tools">';
                        linea += '                            <div style="float: right;">';
                        // linea += '                                <a class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar la opcion de regresar al menu Principal"><i class="fa fa-hashtag"></i></a>';
                        linea += '                                <a onclick="javascript:modalIntenciones(' + value.id + ');" class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Intenciones del Mensaje"><i class="fas fa-hand-pointer"></i></a>';
                        linea += '                                <a onclick="javascript:modalEditarIntencion(' + value.id + ');" class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Configurar las intenciones del Mensaje"><i class="fas fa-wrench"></i></a>';
                        linea += '                                <a onclick="javascript:modalProximoMensaje(' + value.id + ');" class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Seleccionar el mensaje siguiente"><i class="fa fa-share"></i></a>';
                        linea += '                                <a onclick="javascript:modalFile(' + value.id + ');" class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Adjuntar archivos al mensaje: Imágenes, Audios y Videos"><i class="fa fa-file"></i></a>';
                        linea += '                                <a onclick="javascript:modalEditarMensaje(' + value.id + ');" class="btn btn-default btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="fa fa-pen"></i></a>';
                        linea += '                                <a onclick="deleteDetalle(' + value.id + ');" class="btn btn-danger btn-sm tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar Mensaje"><i class="fa fa-times"></i></a>';
                        linea += '                                <div class="btn-group">';
                        linea += '                                    <a href="#" class="btn btn-default dropdown-toggle btn-sm" data-bs-toggle="dropdown">';
                        linea += '                                        <i class="fas fa-ellipsis-v"></i>';
                        linea += '                                    </a>';
                        linea += '                                    <ul class="dropdown-menu dropdown-menu-end">';
                        linea += '                                        <a href="javascript:;" class="dropdown-item">Action 1</a>';
                        linea += '                                        <a href="javascript:;" class="dropdown-item">Action 1</a>';
                        linea += '                                        <a href="javascript:;" class="dropdown-item">Action 1</a>';
                        linea += '                                    </ul>';
                        linea += '                                </div>';
                        linea += '                            </div>';
                        linea += '                        </div>';
                        linea += '                        <div class="col-xl-12 col-lg-12">';
                        linea += '                            <div style="margin: 4px">';
                        linea += '                                <b class="text-dark">Opciones</b><br>';
                        if (value.close_chat) {
                            linea += '                                <a onclick="javascript:mensajeCierre(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar el fin chat con este mensaje"><i class="fa fa-truck"></i></a>';
                        } else {
                            linea += '                                <a onclick="javascript:mensajeCierre(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar el fin chat con este mensaje"><i class="fa fa-truck"></i></a>';
                        }

                        if (value.send_inmediately) {
                            linea += '                                <a onclick="javascript:envioInmediato(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Envio Inmediato"><i class="fa fa-bolt"></i></a>';
                        } else {
                            linea += '                                <a onclick="javascript:envioInmediato(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Envio Inmediato"><i class="fa fa-bolt"></i></a>';
                        }

                        if (value.home) {
                            linea += '                                <a onclick="javascript:envioHome(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Quitar ir al menu principal"><i class="fa fa-hashtag"></i></a>';
                        } else {
                            linea += '                                <a onclick="javascript:envioHome(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar ir menu principal"><i class="fa fa-hashtag"></i></a>';
                        }

                        if (value.home_principal) {
                            linea += '                                <a onclick="javascript:envioHomePrincipal(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Quitar ser Menu principal"><i class="fa fa-hashtag"></i>P</a>';
                        } else {
                            linea += '                                <a onclick="javascript:envioHomePrincipal(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar ser Menu principal"><i class="fa fa-hashtag"></i>P</a>';
                        }

                        if (value.back) {
                            linea += '                                <a onclick="javascript:envioBack(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Quitar regresar"><i class="fa fa-reply"></i></a>';
                        } else {
                            linea += '                                <a onclick="javascript:envioBack(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar regresar"><i class="fa fa-reply"></i></a>';
                        }

                        if (value.agent_start) {
                            linea += '                                <a onclick="javascript:envioAgent(' + value.id + ');" class="btn btn-warning btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Quitar regresar"><i class="fas fa-user-secret"></i></a>';
                        } else {
                            linea += '                                <a onclick="javascript:envioAgent(' + value.id + ');" class="btn btn-default btn-xs tooltip-test" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar regresar"><i class="fas fa-user-secret"></i></a>';
                        }
                        
                        linea += '                            </div>';
                        linea += '                        </div>';
                        linea += '                        <div class="widget-chat-name text-indigo"><i class="fa fa-share"></i> Siguiente Intención</div>';
                        linea += '                        <div class="col-xl-12 col-lg-12">';
                        linea += '                            <div class="widget-chat rounded mb-4" data-id="widget">';
                        linea += '                                <div class="widget-chat-body" data-scrollbar="true" style="overflow-y: scroll;height: 99px;">';
                        linea += '                                    <div class="widget-chat-item with-media start">';
                        linea += '                                        <div class="widget-chat-media">';
                        linea += '                                           <img alt="" src="../intelho/logo_mini.png">';
                        linea += '                                        </div>';
                        linea += '                                       <div class="widget-chat-info">';
                        linea += '                                            <div class="widget-chat-info-container">';
                        linea += '                                                <div class="widget-chat-name text-indigo">Sigcenter</div>';
                        linea += '                                                <div class="widget-chat-message">' + value.proximoMensaje;

                        linea += '                                                </div>';
                        linea += '                                                <div class="widget-chat-time">Siguiente</div>';
                        linea += '                                            </div>';
                        linea += '                                        </div>';
                        linea += '                                    </div>';
                        linea += '                                </div>';
                        linea += '                            </div>';
                        linea += '                        </div>';
                        linea += '                    </div>';
                        linea += '                </div>';
                        linea += '           </div>';
                        linea += '        </li>';
                    });
                    linea += '    </ul>';
                    linea += '</div>';

                    $('#div-detalle').html(linea);
                    $('.tooltip-test').tooltip();
                    $('.todo-list').sortable({
                        placeholder: 'sort-highlight',
                        handle: '.handle',
                        forcePlaceholderSize: true,
                        zIndex: 999999
                    });


                }
            }
        });
    }


    function deleteDetalle(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('bot')}}/" + id
        }).done(function(header) {
            if (header) {
                alerta.toast('Notificación', 'Pregunta Eliminada', 'error');
                addDetalle(header);
            }
        });
    }

    function mensajeCierre(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/mensajeCierre')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Cierre de chat de este detalle cambiado', 'success');
                    addDetalle(header);
                }
            }
        });
    }

    function envioInmediato(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/envioInmediato')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Este mensaje se enviara inmediatamente', 'warning');
                    addDetalle(header);
                }
            }
        });
    }

    function envioHome(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/envioHome')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Se agregará la opcion de ir a menu principal', 'warning');
                    addDetalle(header);
                }
            }
        });
    }

    function envioHomePrincipal(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/envioHomePrincipal')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Se agregará la opcion de ir a menu principal', 'warning');
                    addDetalle(header);
                }
            }
        });
    }

    function envioBack(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/envioBack')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Se agregará la opcion de regresar', 'warning');
                    addDetalle(header);
                }
            }
        });
    }

    function envioAgent(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/envioAgent')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: id
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Modificación', 'Se Activo el modo agente', 'warning');
                    addDetalle(header);
                }
            }
        });
    }


























    // function mostrarVistas(detail, historial, opciones, id) {
    //     if (detail.option) {
    //         $('#select-option-' + id).val(1);
    //     } else if (detail.api) {
    //         $('#select-option-' + id).val(2);
    //     } else if (detail.disabled) {
    //         $('#select-option-' + id).val(3);
    //     } else if (detail.location) {
    //         $('#select-option-' + id).val(4);
    //     } else if (detail.refresh) {
    //         $('#select-option-' + id).val(5);
    //     } else if (detail.location_description) {
    //         $('#select-option-' + id).val(6);
    //     } else if (detail.personalized_response) {
    //         $('#select-option-' + id).val(7);
    //     } else if (detail.api_response) {
    //         $('#select-option-' + id).val(8);
    //     } else if (detail.guardado) {
    //         $('#select-option-' + id).val(9);
    //     } else if (detail.guardar_api) {
    //         $('#select-option-' + id).val(10);
    //     } else if (detail.smart_link_pay) {
    //         $('#select-option-' + id).val(11);
    //     } else if (detail.fecha_agenda) {
    //         $('#select-option-' + id).val(12);
    //     } else if (detail.send_inmediately) {
    //         $('#select-option-' + id).val(13);
    //     } else if (detail.pago_kushki) {
    //         $('#select-option-' + id).val(14);
    //     }


    //     valor = $('#select-option-' + id).val();
    //     if (valor == 14) {
    //         addPagoKushki(detail.company_id, (historial.length !== 0) ? historial[0].bot_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 13) {
    //         addEnvioInmediato(detail.company_id, (historial.length !== 0) ? historial[0].bot_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 12) {
    //         addFechaAgenda(detail.company_id, (historial.length !== 0) ? historial[0].bot_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 11) {
    //         addSmartLinkPay(detail.company_id, (historial.length !== 0) ? historial[0].bot_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 10) {
    //         addGuardarApi(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 9) {
    //         addGuardado(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, (historial.length !== 0) ? historial[0].api_parameters_id : 0, id);
    //     } else if (valor == 8) {
    //         addApiResponseMSP(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, historial, opciones, id);
    //     } else if (valor == 7) {
    //         addPersonalizedResponse(historial, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 6) {
    //         addLocationDescription(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 5) {
    //         addRefresh(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 4) {
    //         addLocation(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 3) {
    //         addDisabled(detail.company_id, (historial.length !== 0) ? historial[0].bot_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 2) {
    //         addApis(detail.company_id, (historial.length !== 0) ? historial[0].api_header_id : 0, opciones, (historial.length !== 0) ? historial[0].main_answer_id : 0, id);
    //     } else if (valor == 1) {
    //         addOptions(historial, opciones, id);
    //     }
    // }

    // function addPagoKushki(company_id, api_id, opciones, api_id_response, id) {
    //     pagokushki = '';
    //     pagokushki += '<div class="row">';
    //     pagokushki += ' <div class="col-md-9">';
    //     pagokushki += ' <select class="form-select select2-pago-kushki" id="select-pago-kushki-rediretion-' + id + '">';
    //     pagokushki += ' <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         pagokushki += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     pagokushki += ' </select>';
    //     pagokushki += ' </div>';
    //     pagokushki += ' <div class="col-md-3">';
    //     pagokushki += ' <a onclick="javascript:selectPagoKushki(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     pagokushki += ' </div>';
    //     pagokushki += '</div>';
    //     $('#div-selection-' + id).html(pagokushki);
    //     $('#select-pago-kushki-rediretion-' + id).val(api_id_response);
    //     $(".select2-pago-kushki").select2();
    // }

    // function selectPagoKushki(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createPagoKushki')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             main_answer_id: $('#select-pago-kushki-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addEnvioInmediato(company_id, api_id, opciones, api_id_response, id) {
    //     envioinmediato = '';
    //     envioinmediato += '<div class="row">';
    //     envioinmediato += ' <div class="col-md-9">';
    //     envioinmediato += ' <select class="form-select select2-envio-inmediato" id="select-envio-inmediato-rediretion-' + id + '">';
    //     envioinmediato += ' <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         envioinmediato += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     envioinmediato += ' </select>';
    //     envioinmediato += ' </div>';
    //     envioinmediato += ' <div class="col-md-3">';
    //     envioinmediato += ' <a onclick="javascript:selectEnvioInmediato(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     envioinmediato += ' </div>';
    //     envioinmediato += '</div>';
    //     $('#div-selection-' + id).html(envioinmediato);
    //     $('#select-envio-inmediato-rediretion-' + id).val(api_id_response);
    //     $(".select2-envio-inmediato").select2();
    // }

    // function selectEnvioInmediato(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createEnvioInmediato')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             main_answer_id: $('#select-envio-inmediato-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addFechaAgenda(company_id, api_id, opciones, api_id_response, id) {
    //     fechaagenda = '';
    //     fechaagenda += '<div class="row">';
    //     fechaagenda += ' <div class="col-md-9">';
    //     fechaagenda += ' <select class="form-select select2-fecha-agenda" id="select-fecha-agenda-rediretion-' + id + '">';
    //     fechaagenda += ' <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         fechaagenda += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     fechaagenda += ' </select>';
    //     fechaagenda += ' </div>';
    //     fechaagenda += ' <div class="col-md-3">';
    //     fechaagenda += ' <a onclick="javascript:selectFechaAgenda(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     fechaagenda += ' </div>';
    //     fechaagenda += '</div>';
    //     $('#div-selection-' + id).html(fechaagenda);
    //     $('#select-fecha-agenda-rediretion-' + id).val(api_id_response);
    //     $(".select2-fecha-agenda").select2();
    // }

    // function selectFechaAgenda(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createFechaAgenda')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             main_answer_id: $('#select-fecha-agenda-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addSmartLinkPay(company_id, api_id, opciones, api_id_response, id) {
    //     smartlink = '';
    //     smartlink += '<div class="row">';
    //     smartlink += ' <div class="col-md-9">';
    //     smartlink += ' <select class="form-select select2-smart-link" id="select-smart-link-rediretion-' + id + '">';
    //     smartlink += ' <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         smartlink += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     smartlink += ' </select>';
    //     smartlink += ' </div>';
    //     smartlink += ' <div class="col-md-3">';
    //     smartlink += ' <a onclick="javascript:selectSmartLink(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     smartlink += ' </div>';
    //     smartlink += '</div>';
    //     $('#div-selection-' + id).html(smartlink);
    //     $('#select-smart-link-rediretion-' + id).val(api_id_response);
    //     $(".select2-smart-link").select2();
    // }

    // function selectSmartLink(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createSmartLinkHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             main_answer_id: $('#select-smart-link-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addGuardarApi(company_id, api_id, opciones, api_id_response, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 locat = '';
    //                 locat += '<div class="row">';
    //                 locat += ' <div class="col-md-5">';
    //                 locat += ' <select class="form-select select2-guardar-api" id="select-guardar-api-' + id + '">';
    //                 locat += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     locat += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 locat += ' </select>';
    //                 locat += ' </div>';
    //                 locat += ' <div class="col-md-5">';
    //                 locat += ' <select class="form-select select2-guardar-api-redirect" id="select-guardar-api-rediretion-' + id + '">';
    //                 locat += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     locat += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 locat += ' </select>';
    //                 locat += ' </div>';
    //                 locat += ' <div class="col-md-2">';
    //                 locat += ' <a onclick="javascript:selectGuardarApi(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 locat += ' </div>';
    //                 locat += '</div>';
    //                 $('#div-selection-' + id).html(locat);
    //                 $('#select-guardar-api-' + id).val(api_id);
    //                 $('#select-guardar-api-rediretion-' + id).val(api_id_response);
    //                 $(".select2-guardar-api").select2();
    //                 $(".select2-guardar-api-redirect").select2();
    //             }
    //         }
    //     });
    // }

    // function selectGuardarApi(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             api: $('#select-guardar-api-' + id).val(),
    //             main_answer_id: $('#select-guardar-api-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {

    //             }
    //         }
    //     });
    // }

    // function addGuardado(company_id, api_id, opciones, api_id_response, api_parameters_id, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 guardado = '';
    //                 guardado += '<div class="row">';


    //                 guardado += ' <div class="col-md-4">';
    //                 guardado += ' <select onchange="javascript:changeGuardadoCambio(' + id + ');" class="form-select select2-guardado" id="select-guardado-' + id + '">';
    //                 guardado += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     guardado += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 guardado += ' </select>';
    //                 guardado += ' </div>';
    //                 guardado += ' <div class="col-md-2">';
    //                 guardado += ' <select class="form-select select2-guardado-parametros" id="select-guardado-parametros-' + id + '">';
    //                 guardado += ' <option selected="" disabled="">Seleccione Uno</option>';
    //                 $.each(res.api_parameters, function(index, val) {
    //                     guardado += ' <option value="' + val.id + '">' + val.name + '</option>';
    //                 });
    //                 guardado += ' </select>';
    //                 guardado += ' </div>';
    //                 guardado += ' <div class="col-md-4">';
    //                 guardado += ' <select class="form-select select2-guardado-redirect" id="select-guardado-rediretion-' + id + '">';
    //                 guardado += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     guardado += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 guardado += ' </select>';
    //                 guardado += ' </div>';




    //                 guardado += ' <div class="col-md-2">';
    //                 guardado += ' <a onclick="javascript:selectGuardado(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 guardado += ' </div>';
    //                 guardado += '</div>';
    //                 $('#div-selection-' + id).html(guardado);
    //                 $('#select-guardado-' + id).val(api_id);
    //                 $('#select-guardado-parametros-' + id).val(api_parameters_id);
    //                 $('#select-guardado-rediretion-' + id).val(api_id_response);
    //                 $(".select2-guardado").select2();
    //                 $(".select2-guardado-redirect").select2();
    //                 $(".select2-guardado-parametros").select2();
    //             }
    //         }
    //     });
    // }

    // function changeGuardadoCambio(id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showParametersApi')}}/" + $('#select-guardado-' + id).val(),
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 var option = '';
    //                 option += '<option selected="" disabled="">Seleccione uno</option>';
    //                 $.each(res.api_parameters, function(index, val) {
    //                     option += ' <option value="' + val.id + '">' + val.id + ' ' + val.name + '</option>';
    //                 });
    //                 $('#select-guardado-parametros-' + id).html(option);
    //                 $(".select2-guardado-parametros").select2();
    //             }
    //         }
    //     });
    // }

    // function selectGuardado(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             api: $('#select-guardado-' + id).val(),
    //             main_answer_id: $('#select-guardado-rediretion-' + id).val(),
    //             api_parameters_id: $('#select-guardado-parametros-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addPersonalizedResponse(historial, opciones, api_id_response, id) {
    //     var description = (historial.length !== 0) ? historial[0].description : '';
    //     respopersonal = '';

    //     respopersonal += '<div class="row">';
    //     respopersonal += ' <div class="col-md-4">';
    //     respopersonal += ' <select class="form-select select2-variable-personalized" id="select-variable-personalized-' + id + '">';
    //     respopersonal += ' <option selected="" disabled>--Elije una variable--</option>';
    //     respopersonal += ' <option value="customer.name">Nombre Conocido</option>';
    //     respopersonal += ' <option value="customer.nombres">Nombres</option>';
    //     respopersonal += ' <option value="customer.apellidos">Apellidos</option>';
    //     respopersonal += ' <option value="customer.numero_documento">Numero de Documento</option>';
    //     respopersonal += ' <option value="customer.direccion">Nombre del Cliente</option>';
    //     respopersonal += ' <option value="customer.telefono">Telñefono FIjo</option>';
    //     respopersonal += ' <option value="customer.celular_1">Celular 1</option>';
    //     respopersonal += ' <option value="customer.celular_2">Celular 2</option>';
    //     respopersonal += ' <option value="customer.celular_3">Celular 3</option>';
    //     respopersonal += ' <option value="customer.correo">Correo</option>';
    //     respopersonal += ' <option value="customer.birth_date">Fecha de Nacimiento</option>';
    //     respopersonal += ' <option value="customer.nationality">Nacionalidad</option>';
    //     respopersonal += ' <option value="customer.sex">Sexo</option>';
    //     respopersonal += ' </select>';
    //     respopersonal += ' </div>';
    //     respopersonal += ' <div class="col-md-6">';
    //     respopersonal += ' <a onclick="javascript:agregarVariable(' + id + ');" class="btn btn-success"><i class="fas fa-plus"></i></a>';
    //     respopersonal += ' </div>';
    //     respopersonal += '</div>';
    //     respopersonal += '<hr>';
    //     respopersonal += '<div class="row">';
    //     respopersonal += ' <div class="col-md-12">';
    //     respopersonal += ' <textarea id="respopersonal-text-' + id + '" class="form-control" rows="4">' + description + '</textarea>';
    //     respopersonal += ' </div>';
    //     respopersonal += '</div>';
    //     respopersonal += ' <hr>';
    //     respopersonal += '<div class="row">';
    //     respopersonal += ' <div class="col-md-9">';
    //     respopersonal += ' <select class="form-select select2-respopersonal" id="select-respopersonal-rediretion-' + id + '">';
    //     respopersonal += ' <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         respopersonal += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     respopersonal += ' </select>';
    //     respopersonal += ' </div>';
    //     respopersonal += ' <div class="col-md-3">';
    //     respopersonal += ' <a onclick="javascript:selectResponsePersonal(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     respopersonal += ' </div>';
    //     respopersonal += '</div>';
    //     $('#div-selection-' + id).html(respopersonal);
    //     $('#select-respopersonal-rediretion-' + id).val(api_id_response);
    //     $(".select2-respopersonal").select2();
    //     $(".select2-variable-personalized").select2();
    // }


    // function selectResponsePersonal(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialResponsePersonal')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             text: $('#respopersonal-text-' + id).val(),
    //             api: $('#select-apis').val(),
    //             main_answer_id: $('#select-respopersonal-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }


    // function addLocationDescription(company_id, api_id, opciones, api_id_response, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 locadescrip = '';
    //                 locadescrip += '<div class="row">';
    //                 locadescrip += ' <div class="col-md-5">';
    //                 locadescrip += ' <select class="form-select select2-location" id="select-location-description-' + id + '">';
    //                 locadescrip += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     locadescrip += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 locadescrip += ' </select>';
    //                 locadescrip += ' </div>';
    //                 locadescrip += ' <div class="col-md-5">';
    //                 locadescrip += ' <select class="form-select select2-location-description" id="select-location-description-rediretion-' + id + '">';
    //                 locadescrip += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     locadescrip += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 locadescrip += ' </select>';
    //                 locadescrip += ' </div>';
    //                 locadescrip += ' <div class="col-md-2">';
    //                 locadescrip += ' <a onclick="javascript:selectLocationDescription(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 locadescrip += ' </div>';
    //                 locadescrip += '</div>';
    //                 $('#div-selection-' + id).html(locadescrip);
    //                 $('#select-location-description-' + id).val(api_id);
    //                 $('#select-location-description-rediretion-' + id).val(api_id_response);
    //                 $(".select2-location").select2();
    //                 $(".select2-location-description").select2();
    //             }
    //         }
    //     });
    // }

    // function selectLocationDescription(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             api: $('#select-location-description-' + id).val(),
    //             main_answer_id: $('#select-location-description-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addRefresh(company_id, api_id, opciones, api_id_response, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 refresh = '';
    //                 refresh += '<div class="row">';
    //                 refresh += ' <div class="col-md-5">';
    //                 refresh += ' <select class="form-select select2-refresh" id="select-refresh-' + id + '">';
    //                 refresh += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     refresh += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 refresh += ' </select>';
    //                 refresh += ' </div>';
    //                 refresh += ' <div class="col-md-5">';
    //                 refresh += ' <select class="form-select select2-refresh-redirect" id="select-refresh-rediretion-' + id + '">';
    //                 refresh += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     refresh += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 refresh += ' </select>';
    //                 refresh += ' </div>';
    //                 refresh += ' <div class="col-md-2">';
    //                 refresh += ' <a onclick="javascript:selectRefresh(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 refresh += ' </div>';
    //                 refresh += '</div>';
    //                 $('#div-selection-' + id).html(refresh);
    //                 $('#select-refresh-' + id).val(api_id);
    //                 $('#select-refresh-rediretion-' + id).val(api_id_response);
    //                 $(".select2-refresh").select2();
    //                 $(".select2-refresh-redirect").select2();
    //             }
    //         }
    //     });
    // }

    // function selectRefresh(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             api: $('#select-refresh-' + id).val(),
    //             main_answer_id: $('#select-refresh-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addLocation(company_id, api_id, opciones, api_id_response, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 locat = '';
    //                 locat += '<div class="row">';
    //                 locat += ' <div class="col-md-5">';
    //                 locat += ' <select class="form-select select2-location" id="select-location-' + id + '">';
    //                 locat += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     locat += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 locat += ' </select>';
    //                 locat += ' </div>';
    //                 locat += ' <div class="col-md-5">';
    //                 locat += ' <select class="form-select select2-location-redirect" id="select-location-rediretion-' + id + '">';
    //                 locat += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     locat += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 locat += ' </select>';
    //                 locat += ' </div>';
    //                 locat += ' <div class="col-md-2">';
    //                 locat += ' <a onclick="javascript:selectLocation(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 locat += ' </div>';
    //                 locat += '</div>';
    //                 $('#div-selection-' + id).html(locat);
    //                 $('#select-location-' + id).val(api_id);
    //                 $('#select-location-rediretion-' + id).val(api_id_response);
    //                 $(".select2-location").select2();
    //                 $(".select2-location-redirect").select2();
    //             }
    //         }
    //     });
    // }

    // function selectLocation(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             api: $('#select-location-' + id).val(),
    //             main_answer_id: $('#select-location-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se guardó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addApis(company_id, api_id, opciones, api_id_response, id) {
    //     $.ajax({
    //         url: "{{URL::to('bot/showApis')}}/" + company_id + '/' + api_id,
    //         type: 'GET',
    //         success: function(res) {
    //             if (res) {
    //                 api = '';
    //                 api += '<div class="row">';
    //                 api += ' <div class="col-md-5">';
    //                 api += ' <select class="form-select select2-api" id="select-apis-' + id + '">';
    //                 api += ' <option selected="" disabled>Seleccione una API</option>';
    //                 $.each(res.apis, function(index, value) {
    //                     api += ' <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
    //                 });
    //                 api += ' </select>';
    //                 api += ' </div>';
    //                 api += ' <div class="col-md-5">';
    //                 api += ' <select class="form-select select2-api-redirect" id="select-apis-rediretion-' + id + '">';
    //                 api += ' <option selected="" disabled>Redirección</option>';
    //                 $.each(opciones, function(index, val) {
    //                     api += ' <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //                 });
    //                 api += ' </select>';
    //                 api += ' </div>';
    //                 api += ' <div class="col-md-2">';
    //                 api += ' <a onclick="javascript:selectApi(' + id + ');" class="btn btn-primary">Guardar</a>';
    //                 api += ' </div>';
    //                 api += '</div>';
    //                 $('#div-selection-' + id).html(api);
    //                 $('#select-apis-' + id).val(api_id);
    //                 $('#select-apis-rediretion-' + id).val(api_id_response);
    //                 $(".select2-api").select2();
    //                 $(".select2-api-redirect").select2();
    //             }
    //         }
    //     });

    // }


    // function selectDisabled(id) {
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: "{{URL::to('bot/createDisabledHistorialApi')}}",
    //         type: 'POST',
    //         data: {
    //             header: $('#header-id').val(),
    //             detail: $('#question_id-' + id).val(),
    //             main_answer_id: $('#select-disabled-rediretion-' + id).val()
    //         },
    //         success: function(res) {
    //             if (res) {
    //                 alerta.toast('Notificación', 'Se actualizó la información', 'success');
    //             }
    //         }
    //     });
    // }

    // function addOptions(historiales, opciones, id) {
    //     var historial = '';
    //     historial += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
    //     historial += ' <li class="nav-item">';
    //     historial += ' <a onclick="javascript:createHistorial(' + id + ');" class="nav-link active d-flex align-items-center">';
    //     historial += ' <i class="ion-md-add-circle-outline fa-lg"></i>';
    //     historial += ' <span class="d-none d-lg-inline ms-2">Crear</span>&nbsp;';
    //     historial += ' </a>';
    //     historial += ' </li>';
    //     historial += '</ul>';
    //     historial += '<hr class = "bg-gray-500"/>';
    //     historial += '<table class="table table-panel align-middle mb-0" id="table-div-option-' + id + '">';
    //     historial += ' <thead>';
    //     historial += ' <tr>';
    //     historial += ' <th>#</th>';
    //     historial += ' <th>Descripción</th>';
    //     historial += ' <th>Orden</th>';
    //     historial += ' <th>Redirección</th>';
    //     historial += ' <th>Acción</th>';
    //     historial += ' </tr>';
    //     historial += ' </thead>';
    //     historial += ' <tbody>';
    //     historial += ' </tbody>';
    //     historial += '</table>';
    //     $('#div-selection-' + id).html(historial);
    //     var detail = '';
    //     $.each(historiales, function(index, value) {
    //         opcion = (value.opcion !== null) ? value.opcion : '';
    //         description = (value.description !== null) ? value.description : '';
    //         detail += '<tr>';
    //         detail += ' <td><input id="historial-opcion-' + value.id + '" type="text" class="form-control mb-5px" value="' + opcion + '" style="width: 41px;"></td>';
    //         detail += ' <td><input id="historial-text-' + value.id + '" type="text" class="form-control mb-5px" placeholder="Texto" value="' + description + '" style="width: 178px;"></td>';
    //         detail += ' <td>';
    //         detail += ' <select class="form-select" id="historial-order-' + value.id + '" style="width: 65px;">';
    //         i = 1;
    //         while (i <= 10) {
    //             if (i == value.order) {
    //                 detail += '             <option selected="">' + i + '</option>';
    //             } else {
    //                 detail += '             <option>' + i + '</option>';
    //             }
    //             i = i + 1;
    //         }
    //         detail += '         </select>';
    //         detail += '     </td>';
    //         detail += '     <td>';
    //         detail += '          <select class="form-select select2-option" id="historial-redireccion-' + value.id + '" style="width: 128px;">';
    //         detail += '             <option selected="" disabled="">Redirección</option>';
    //         $.each(opciones, function(index, val) {
    //             if (value.main_answer_id == val.id) {
    //                 detail += '             <option selected="" value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //             } else {
    //                 detail += '             <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //             }
    //         });
    //         detail += '         </select>';
    //         detail += '     </td>';
    //         detail += '      <td>';
    //         detail += '          <a onclick="editHistorial(' + value.id + ', ' + id + ');" class="btn btn-outline-blue btn-circle btn-xs">';
    //         detail += '              <i class="icon-reload"></i>';
    //         detail += '          </a>';
    //         detail += '          <a onclick="deleteHistorial(' + value.id + ', ' + id + ');" class="btn btn-outline-red btn-circle btn-xs">';
    //         detail += '              <i class="icon-trash"></i>';
    //         detail += '          </a>';
    //         detail += '      </td>';
    //         detail += '</tr>';
    //     });
    //     $('#table-div-option-' + id + ' > tbody').html(detail);
    //     $(".select2-option").select2();
    // }

    // function addDisabled(company_id, api_id, opciones, api_id_response, id) {
    //     disabled = '';
    //     disabled += '<div class="row">';
    //     disabled += '    <div class="col-md-9">';
    //     disabled += '        <select class="form-select select2-disabled" id="select-disabled-rediretion-' + id + '">';
    //     disabled += '            <option selected="" disabled>Redirección</option>';
    //     $.each(opciones, function(index, val) {
    //         disabled += '            <option value="' + val.id + '">' + val.id + ' ' + val.description + '</option>';
    //     });
    //     disabled += '        </select>';
    //     disabled += '     </div>';
    //     disabled += '     <div class="col-md-3">';
    //     disabled += '        <a onclick="javascript:selectDisabled(' + id + ');" class="btn btn-primary">Guardar</a>';
    //     disabled += '     </div>';
    //     disabled += '</div>';
    //     $('#div-selection-' + id).html(disabled);
    //     $('#select-disabled-rediretion-' + id).val(api_id_response);
    //     $(".select2-disabled").select2();
    // }





































    function newDetalle() {
        var method = 'POST';
        var company = $('#company-api').val();
        var url = "{{URL::to('bot')}}";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            url: url,
            type: method,
            data: {
                header: $('#header-id').val(),
                company: company,
            },
            success: function(header) {
                if (header) {
                    alerta.toast('Notificación', 'Pregunta añadida', 'info');
                    addDetalle(header);
                }
            }
        });
    }

    function agregarHeader() {
        limpiarModalHeader();
        var company = $('#company-api').val();
        $('#bot-header').val('NEW');
        $('#modalHeader').modal('show');
    }

    function editarHeader(id) {
        limpiarModalHeader();
        $.ajax({
            url: "{{URL::to('bot/showHeader')}}/" + id,
            type: 'GET',
            success: function(res) {
                if (res) {
                    $('#bot-header').val(res.id);
                    $('#name').val(res.name);
                    $('#description').val(res.description);
                    $('#start_code').val(res.start_code);
                    $('#home_codigo').val(res.home_codigo);
                    $('#home_texto').val(res.home_texto);
                    $('#back_codigo').val(res.back_codigo);
                    $('#back_texto').val(res.back_texto);
                    $('#modalHeader').modal('show');
                }
            }
        });
    }

    function saveHeader() {
        var header = $('#bot-header').val();
        var url = '';
        var method = '';
        if (header == 'NEW') {
            url = "{{URL::to('bot/createHeader')}}";
            method = 'POST';
        } else {
            url = "{{URL::to('bot/updateHeader')}}";
            method = 'PUT';
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            url: url,
            type: method,
            data: {
                header: $('#bot-header').val(),
                company: $('#company-api').val(),
                name: $('#name').val(),
                description: $('#description').val(),
                start_code: $('#start_code').val(),
                home_codigo: $('#home_codigo').val(),
                home_texto: $('#home_texto').val(),
                back_codigo: $('#back_codigo').val(),
                back_texto: $('#back_texto').val()
            },
            success: function(res) {
                if (res) {
                    addBots(res);
                    limpiarModalHeader();
                    $('#modalHeader').modal('hide');
                }
            }
        });
    }

    function limpiarModalHeader() {
        $('#bot-header').val('');
        $('#name').val('');
        $('#description').val('');
        $('#start_code').val('');
    }

    function modalIntenciones(detalle) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/verIntencionSeleccionada')}}",
            type: 'POST',
            data: {
                detalle: detalle
            },
            success: function(res) {
                if (res) {
                    var historial = '';
                    historial += '<input id="intencion" type="hidden" value="' + detalle + '">';
                    historial += ' <label class="form-label col-form-label col-md-3">Opciones</label>';
                    historial += ' <select class="form-select select2-intenciones" id="select-intencion" onchange="javascript:objetivoIntencion();">';
                    historial += '  <option selected="" disabled="">Seleccione una Opción</option>';
                    $.each(res.intention, function(index, value) {
                        historial += '  <option value="' + value.id + '">' + value.name + '</option>';
                    });
                    historial += ' </select>';
                    $('#select-option-modal').html(historial);
                    $(".select2-intenciones").select2({
                        dropdownParent: $('#modalIntenciones')
                    });
                    $('#select-intencion').val(res.respuesta).trigger('change');
                    objetivoIntencion();
                    $('#modalIntenciones').modal('show');
                }
            }
        });
    }

    function objetivoIntencion() {
        var intencion = $('#select-intencion').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/verDetalleIntencion')}}",
            type: 'POST',
            data: {
                intencion: intencion
            },
            success: function(res) {
                if (res) {
                    $('#objetivoIntencionTexto').html(res.description);
                }
            }
        });
    }

    function cambioOption(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/updateOption')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: $('#intencion').val(),
                option: $('#select-intencion').val()
            },
            success: function(header) {
                if (header) {
                    addDetalle(header);
                    $('#modalIntenciones').modal('hide');
                }
            }
        });
    }

    function modalEditarMensaje(detalle) {
        $.ajax({
            url: "{{URL::to('bot/showDetail')}}/" + detalle,
            type: 'GET',
            success: function(res) {
                if (res) {
                    $('#editarMensajeDetalle').val(detalle);
                    $('#mensajeIntencion').val(res.description);
                    $('#modalEditarMensaje').modal('show');
                }
            }
        });
    }

    function modalEditarMensajeEmoji(detalle) {
        $.ajax({
            url: "{{URL::to('bot/showDetail')}}/" + detalle,
            type: 'GET',
            success: function(res) {
                if (res) {
                    $('#editarMensajeDetalle').val(detalle);
                    $('#mensajeIntencionEmoji').val(res.description);
                    $('.emojionearea-editor').html(res.description);
                    $('#modalEditarMensajeEmoji').modal('show');
                }
            }
        });
    }

    function editarModalMensaje() {
        var id = $('#editarMensajeDetalle').val();
        var method = 'PUT';
        var url = "{{URL::to('bot')}}/" + id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                text: $('#mensajeIntencion').val(),
            },
            success: function(header) {
                if (header) {
                    $('#modalEditarMensaje').modal('hide');
                    alerta.toast('Notificación', 'Se actualizó la información', 'success');
                    addDetalle(header);
                }
            }
        });
    }

    function editarModalMensajeEmoji() {
        var id = $('#editarMensajeDetalle').val();
        var method = 'PUT';
        var url = "{{URL::to('bot')}}/" + id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                text: $('#mensajeIntencionEmoji').val(),
            },
            success: function(header) {
                if (header) {
                    $('#modalEditarMensajeEmoji').modal('hide');
                    alerta.toast('Notificación', 'Se actualizó la información', 'success');
                    addDetalle(header);
                }
            }
        });
    }

    function modalProximoMensaje(id) {
        $.ajax({
            url: "{{URL::to('bot/showOption')}}/" + id,
            type: 'GET',
            success: function(res) {
                if (res) {
                    var col = '';
                    $('#modalListaMensajes').html(col);
                    $.each(res.historiales, function(index, valHistoria) {
                        col += '<div class="widget-chat rounded mb-4" data-id="widget">';
                        col += '    <div class="widget-chat-header">';
                        col += '        <div class="widget-chat-header-icon">';
                        col += '            <i class="fab fa-earlybirds w-30px h-30px fs-20px bg-yellow text-gray-900 d-flex align-items-center justify-content-center rounded"></i>';
                        col += '        </div>';
                        col += '        <div class="widget-chat-header-content">';
                        col += '            <h4 class="widget-chat-header-title">[' + valHistoria.opcion + '] ' + valHistoria.description + '</h4>';
                        col += '            <p class="widget-chat-header-desc">Elije el mensaje con el que va a continuar</p>';
                        col += '        </div>';
                        col += '    </div>';
                        col += '    <div class="widget-chat-body" style="overflow-y: scroll;height: 200px;">';
                        $.each(res.opciones, function(index, value) {
                            col += '        <div class="widget-chat-item with-media start">';
                            col += '            <div class="widget-chat-media">';
                            col += '                <div class="form-check mb-2">';
                            if (valHistoria.main_answer_id == value.id) {
                                col += '                   <input checked onclick="javascript:guardarProximoMensaje(' + valHistoria.id + ', ' + value.id + ');" class="form-check-input" type="radio" name="proximoMensaje-' + valHistoria.id + '" id="proximoMensaje' + value.id + '" value="' + value.id + '">';
                            } else {
                                col += '                   <input onclick="javascript:guardarProximoMensaje(' + valHistoria.id + ', ' + value.id + ');" class="form-check-input" type="radio" name="proximoMensaje-' + valHistoria.id + '" id="proximoMensaje' + value.id + '" value="' + value.id + '">';
                            }
                            col += '                </div>';
                            col += '            </div>';
                            col += '            <div class="widget-chat-info">';
                            col += '                <div class="widget-chat-info-container">';
                            col += '                    <div class="widget-chat-name text-indigo">Sigcenter</div>';
                            col += '                    <div class="widget-chat-message">' + value.description + '</div>';
                            col += '                    <div class="widget-chat-time">6:00PM</div>';
                            col += '                </div>';
                            col += '            </div>';
                            col += '        </div>';
                        });
                        col += '    </div>';
                        col += '</div>';
                        $('#idProximoMensaje').val(id);
                        $('#modalListaMensajes').html(col);
                    });
                    $('#modalProximoMensaje').modal('show');
                }
            }
        });
    }

    function guardarProximoMensaje(historial, detalle) {
        var radioButon = $('input[name="proximoMensaje-' + historial + '"]').filter(':checked').val();
        if (radioButon !== undefined) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{URL::to('bot/crearProximoMensaje')}}",
                type: 'POST',
                data: {
                    header: $('#header-id').val(),
                    detail: detalle,
                    historial: historial,
                    main_answer_id: radioButon
                },
                success: function(header) {
                    if (header) {
                        addDetalle(header);
                        alerta.toast('Notificación', 'Se guardó la información', 'success');
                    }
                }
            });
        } else {
            alerta.toast('Notificación', 'Es necesario seleccionar un mensaje', 'info');
        }
    }

    function modalEditarIntencion(detalle) {
        $.ajax({
            url: "{{URL::to('bot/showIntenciones')}}/" + detalle,
            type: 'GET',
            success: function(res) {
                switch (res.code) {
                    case 'OP':
                        cargarHistorial(detalle);
                        break;

                    case 'APR':
                        cargarHistorial2(detalle);
                        break;

                    case 'AP':
                    case 'LO':
                    case 'RE':
                    case 'LOD':
                    case 'GU':
                        cargarHistorial3(detalle);
                        break;

                    case 'DE':
                    case 'SM':
                    case 'FA':
                    case 'IM':
                    case 'PAKU':
                        cargarHistorial4(detalle);
                        break;

                    default:
                        cargarHistorial4(detalle);
                        break;
                }
                $('#modalEditarIntencion').modal('show');
            }
        });
    }

    function cargarHistorial(detalle) {
        $.ajax({
            url: "{{URL::to('bot/showHistorial')}}/" + detalle,
            type: 'GET',
            success: function(res) {
                if (res) {
                    var historial = '';
                    $('#modalConfiguracion').html(historial);
                    historial += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
                    historial += ' <li class="nav-item">';
                    historial += ' <a onclick="javascript:createHistorial(' + detalle + ');" class="nav-link active d-flex align-items-center">';
                    historial += ' <i class="ion-md-add-circle-outline fa-lg"></i>';
                    historial += ' <span class="d-none d-lg-inline ms-2">Crear</span>&nbsp;';
                    historial += ' </a>';
                    historial += ' </li>';
                    historial += '</ul>';
                    historial += '<hr class = "bg-gray-500"/>';
                    historial += '<table class="table table-panel align-middle mb-0" id="table-div-option">';
                    historial += '  <thead>';
                    historial += '      <tr>';
                    historial += '          <th>#</th>';
                    historial += '          <th>Descripción</th>';
                    historial += '          <th>Orden</th>';
                    historial += '          <th>Acción</th>';
                    historial += '      </tr>';
                    historial += '  </thead>';
                    historial += '  <tbody>';
                    $.each(res, function(index, value) {
                        historial += '<tr id="histo-lin-' + value.id + '">';
                        historial += ' <td><input id="historial-opcion-' + value.id + '" type="text" class="form-control mb-5px" value="' + value.opcion + '" style="width: 55px;"></td>';
                        historial += ' <td><input id="historial-text-' + value.id + '" type="text" class="form-control mb-5px" placeholder="Texto" value="' + value.description + '" style="width: 490px;"></td>';
                        historial += ' <td>';
                        historial += ' <select class="form-select" id="historial-order-' + value.id + '" style="width: 80px;">';
                        i = 1;
                        while (i <= 10) {
                            if (i == value.order) {
                                historial += '             <option selected="">' + i + '</option>';
                            } else {
                                historial += '             <option>' + i + '</option>';
                            }
                            i = i + 1;
                        }
                        historial += '         </select>';
                        historial += '     </td>';
                        historial += '      <td>';
                        historial += '          <a onclick="editHistorial(' + value.id + ');" class="btn btn-outline-blue btn-circle btn-xs">';
                        historial += '              <i class="icon-reload"></i>';
                        historial += '          </a>';
                        historial += '          <a onclick="deleteHistorial(' + value.id + ');" class="btn btn-outline-red btn-circle btn-xs">';
                        historial += '              <i class="icon-trash"></i>';
                        historial += '          </a>';
                        historial += '      </td>';
                        historial += '</tr>';
                    });
                    historial += '  </tbody>';
                    historial += '</table>';
                    $('#modalConfiguracion').html(historial);
                }
            }
        });
    }

    function editHistorial(historial) {
        var method = 'PUT';
        var url = "{{URL::to('bot/editHistorial')}}/" + historial;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            url: url,
            type: method,
            data: {
                opcion: $('#historial-opcion-' + historial).val(),
                text: $('#historial-text-' + historial).val(),
                order: $('#historial-order-' + historial).val()
            },
            success: function(res) {
                if (res) {
                    cargarHistorial(res.bot_detail_id);
                    alerta.toast('Notificación', 'Se guardó la información', 'success');
                }
            }
        });
    }

    function deleteHistorial(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('bot/deleteHistorial')}}/" + id
        }).done(function(res) {
            if (res) {
                cargarHistorial(res);
                alerta.toast('Notificación', 'Se eliminó la opcíon', 'error');
            }
        });
    }

    function createHistorial(detalle) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            url: "{{URL::to('bot/createHistorial')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: detalle
            },
            success: function(res) {
                if (res) {
                    cargarHistorial(detalle);
                    alerta.toast('Notificación', 'Se guardó la información', 'success');
                }
            }
        });
    }

    function cargarHistorial2(detalle) {
        $.ajax({
            url: "{{URL::to('bot/showHistorial')}}/" + detalle,
            type: 'GET',
            success: function(res) {
                var apiMSP = '';
                $('#modalConfiguracion').html(apiMSP);
                apiMSP += '<ul id="ioniconsTab" class="nav nav-pills mb-3">';
                apiMSP += '     <li class="nav-item">';
                apiMSP += '         <a onclick="javascript:createHistorialMSP(' + detalle + ');" class="nav-link active d-flex align-items-center">';
                apiMSP += '             <i class="ion-md-add-circle-outline fa-lg"></i>';
                apiMSP += '             <span class="d-none d-lg-inline ms-2">Crear</span>&nbsp;';
                apiMSP += '         </a>';
                apiMSP += '     </li>';
                apiMSP += '</ul>';
                apiMSP += ' <hr class = "bg-gray-500"/>';
                apiMSP += '<table class="table table-panel align-middle mb-0" id="table-div-api-msp">';
                apiMSP += ' <thead>';
                apiMSP += '     <tr>';
                apiMSP += '         <th>Code</th>';
                apiMSP += '         <th>Descripción</th>';
                apiMSP += '         <th>Acción</th>';
                apiMSP += '     </tr>';
                apiMSP += ' </thead>';
                apiMSP += ' <tbody>';
                $.each(res, function(index, value) {
                    apiMSP += '<tr">';
                    apiMSP += ' <td nowrap=""><input id="historial-code-' + value.id + '" type="text" class="form-control mb-5px" value="' + value.api_header_code + '" style="width: 80px;"></td>';
                    apiMSP += ' <td><input id="historial-text-' + value.id + '" type="text" class="form-control mb-5px" placeholder="Texto" value="' + value.description + '" style="width: 520px;"></td>';
                    apiMSP += ' <td>';
                    apiMSP += ' <a onclick="editHistorialMSP(' + value.id + ');" class="btn btn-outline-blue btn-circle btn-xs">';
                    apiMSP += ' <i class="icon-reload"></i>';
                    apiMSP += ' </a>';
                    apiMSP += ' <a onclick="deleteHistorialMSP(' + value.id + ');" class="btn btn-outline-red btn-circle btn-xs">';
                    apiMSP += ' <i class="icon-trash"></i>';
                    apiMSP += ' </a>';
                    apiMSP += ' </td>';
                    apiMSP += '</tr>';
                });
                apiMSP += ' </tbody>';
                apiMSP += '</table>';
                $('#modalConfiguracion').html(apiMSP);
            }
        });
    }

    function editHistorialMSP(id) {
        var method = 'PUT';
        var url = "{{URL::to('bot/editHistorialMSP')}}/" + id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                api_header_code: $('#historial-code-' + id).val(),
                text: $('#historial-text-' + id).val()
            },
            success: function(res) {
                if (res) {
                    cargarHistorial2(res);
                    alerta.toast('Notificación', 'Se guardó la información', 'success');
                }
            }
        });
    }

    function deleteHistorialMSP(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('bot/deleteHistorialMSP')}}/" + id
        }).done(function(res) {
            if (res) {
                cargarHistorial2(res);
                alerta.toast('Notificación', 'Se eliminó la opcíon', 'error');
            }
        });
    }

    function createHistorialMSP(detalle) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token" ]').attr('content')
            },
            url: "{{URL::to('bot/createHistorialMSP')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: detalle
            },
            success: function(res) {
                if (res) {
                    cargarHistorial2(res.bot_detail_id);
                    alerta.toast('Notificación', 'Se guardó la información', 'success');
                }
            }
        });
    }

    function cargarHistorial3(id) {
        $.ajax({
            url: "{{URL::to('bot/showHistorialApi')}}/" + id,
            type: 'GET',
            success: function(res) {
                if (res) {
                    api = '';
                    $('#modalConfiguracion').html(api);
                    $.each(res.historial, function(index, val) {
                        api += '<div class="row">';
                        api += '    <div class="col-md-10">';
                        api += '        <select class="form-select select2-api" id="select-apis">';
                        api += '            <option selected="" disabled>Seleccione una API</option>';
                        $.each(res.apis, function(index, value) {
                            if (val.api_header_id == value.id) {
                                api += '        <option selected="" value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
                            } else {
                                api += '        <option value="' + value.id + '">' + value.description + ' (' + value.table_name + ')</option>';
                            }
                        });
                        api += '        </select>';
                        api += '    </div>';
                        api += '    <div class="col-md-2">';
                        api += '        <a onclick="javascript:selectApi(' + id + ',' + val.id + ');" class="btn btn-primary">Guardar</a>';
                        api += '    </div>';
                        api += '</div>';
                    });
                    $(".select2-api").select2();
                    $('#modalConfiguracion').html(api);
                }
            }
        });
    }

    function selectApi(detalle, historial) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('bot/createHistorialApi')}}",
            type: 'POST',
            data: {
                header: $('#header-id').val(),
                detail: detalle,
                api: $('#select-apis').val()
            },
            success: function(res) {
                if (res) {
                    alerta.toast('Notificación', 'Se guardó la información', 'success');
                }
            }
        });
    }

    function cargarHistorial4(id) {
        col = '';
        col += '<h1>Caso sin configuraciones</h1>'
        $('#modalConfiguracion').html(col);

    }

    function agregarVariable(id) {
        var texto = $('#mensajeIntencion').val();
        var campo = '[CRM]' + $('#select-variable-personalized').val() + '[/CRM]';
        var parrafo = texto + campo;
        $('#mensajeIntencion').val('');
        $('#mensajeIntencion').val(parrafo);
    }

    function modalFile(id) {
        $('#detalleModalId').val(id);
        $('#modalFile').modal('show');
    }

    function guardarArchivo() {
        var id = $('#detalleModalId').val();
        var formData = new FormData(document.getElementById("formFile"));
        console.log(formData);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "{{URL::to('bot/saveFileModal')}}/" + id,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            data: formData
        }).done(function(header) {
            if (header) {
                addDetalle(header);
                $('#modalFile').modal('hide');
                alerta.toast('Notificación', 'Archivo agregado correctamente...', 'success');
            }
        });

    }
</script>
@stop