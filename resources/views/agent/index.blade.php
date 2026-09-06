@extends('layouts.app')
@section('title')Agente @stop
@section('breadcrumbs1')Agentes @stop
@section('breadcrumbs2')Agentes @stop
@section('custom_css') @stop
@section('content')
<div class="row">
    <div class="col-xl-5 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-5">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Chat</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="accordion" id="accordion">
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-blue text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fa fa-circle fa-fw text-yellow me-2 fs-8px"></i> Filtros Busqueda
                                </button>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                <div class="accordion-body bg-white text-white">
                                    <div class="table-responsive">
                                        <table class="table mb-0 align-middle">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 5%;">
                                                        Estado Final
                                                    </td>
                                                    <td colspan="3">
                                                        <div class="form-group">
                                                            <!--<label for="name">Estado</label>-->
                                                            <select class="col col-sm-3 estado-header" id="estado-header" style="width: 100%;">
                                                                <option value="1">Abierto</option>
                                                                <option value="0">Cerrado</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td style="width: 5%;">
                                                        Estado Venta
                                                    </td>
                                                    <td colspan="3">
                                                        <div class="form-group">
                                                            <!--<label for="name">Estado</label>-->
                                                            <select class="col col-sm-3 estado-header" id="estado-general" style="width: 100%;">
                                                                <option value=""> - SELECCIONE UNO - </option>
                                                                <option value="PENDIENTE">PENDIENTE</option>
                                                                <option value="ACEPTADO">ACEPTADO</option>
                                                                <option value="RESUELTO">RESUELTO</option>
                                                                <option value="VENDIDO">VENDIDO</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="8">
                                                        <div class="form-group">
                                                            <label for="name">Categorias Filtrar</label>
                                                            <select class="col col-sm-3 categorias-filtro" name="category[]" id="category-filtro" multiple="multiple" style="width: 100%;" placeholder="ELIJE">
                                                                @foreach($category as $cat)
                                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="8">
                                                        <a onclick="javascript:cargarTabla();" class="btn btn-sm btn-primary w-60px me-1"><i class="fas fa-filter"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <div class="input-group-text"><i class="fa fa-search"></i></div>
                        <input type="text" class="form-control" id="search-chats" placeholder="Buscar Cliente">
                    </div>
                </div>
                <hr>

                <div class="table-responsive" style="overflow-y: scroll;height: 600px;" id="div_chats">

                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-xl-7 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-5">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Conversacion</h4>
            </div>
            <div class="panel-body">
                <div id="div_limpiar">
                    <input type="hidden" id="bot-header" />
                    <input type="hidden" id="cant-msg" />
                    <div id="div-conversation">
                        <p class="text-center"><i class="icon-drawer h3 d-block"></i>Seleccione un Chats.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.categorias-filtro').select2();
        $('.estado-header').select2();
        $('.estado-general').select2();
        cargarTabla();
        setInterval('refreshChat()', 2000);

        $("#search-chats").keyup(function() {
            _this = this;
            $.each($("#table_chats tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });

    function vaciarConversaciones() {
        var limpiar = '';
        limpiar += '<input type="hidden" id="bot-header" />';
        limpiar += '<input type="hidden" id="cant-msg" />';
        limpiar += '<div id="div-conversation">';
        limpiar += '    <p class="text-center"><i class="icon-drawer h3 d-block"></i>Seleccione un Chats.</p>';
        limpiar += '</div>';
        $('#div_limpiar').html(limpiar);
    }

    function horaUltimoMensaje(fechaHora) {
        var d = new Date();
        var hoy = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
        var fecha = fechaHora.substring(0, 10);
        if (fecha == hoy) {
            var fechaHoraMsg = fechaHora.substring(10, 16);
        } else {
            var fechaHoraMsg = fechaHora.substring(5, 10);
        }
        return fechaHoraMsg
    }

    function cargarTabla() {
        vaciarConversaciones();
        var tabla = '';
        $.ajax({
            url: "{{URL::to('agent/cargarTabla')}}",
            type: 'GET',
            data: {
                categorias: $('#category-filtro').val(),
                estado: $('#estado-header').val(),
                estadoGeneral: $('#estado-general').val(),
            },
            success: function(res) {
                if (res) {
                    console.log(res);
                    tabla += '<table class="table table-striped mb-0 align-middle table-hover" id="table_chats">';
                    tabla += '  <tbody>';
                    $.each(res, function(index, val) {
                        fechaHoraMsg = horaUltimoMensaje(val.updated_at);
                        tabla += '<tr>';
                        tabla += '    <td style="width: 5%;" onclick="javascript:selectChatBot(' + val.id + ')">';
                        tabla += '        <img src="../assets/img/user/sinfoto.jpg" class="rounded h-30px">';
                        tabla += '    </td>';
                        tabla += '    <td style="width: 45%;" onclick="javascript:selectChatBot(' + val.id + ')">';
                        tabla += '        ' + val.nombres + ' ' + val.apellidos + '<small style="float: right;"><b>' + fechaHoraMsg + '</b></small>';
                        // tabla += '        ' + val.id + val.nombres + ' ' + val.apellidos + val.updated_at;
                        tabla += '        <br><i>' + val.ultimoMensaje + '</i>';
                        tabla += '    </td>';
                        tabla += '    <td nowrap="">';
                        if (val.status_venta == 'PENDIENTE') {
                            tabla += '        <a onclick="javascript:aceptarPedido(' + val.id + ');" class="btn btn-sm btn-primary w-72px me-1">Aceptar</a>';
                        } else {
                            tabla += '          <span class="badge bg-dark rounded-pill">' + val.status_venta + '</span>';
                        }
                        tabla += '    </td>';
                        tabla += '    <td onclick="javascript:selectChatBot(' + val.id + ')">';
                        if (parseInt(val.status)) {
                            tabla += '        <span class="badge bg-warning">Abierto</span>';
                        } else {
                            tabla += '        <span class="badge bg-danger">Cerrado</span>';
                        }
                        tabla += '    </td>';
                        tabla += '     <td>';
                        tabla += '        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fa fa-robot fs-15px"></i></a>&nbsp;&nbsp;';
                        tabla += '        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fab fa-whatsapp fs-15px"></i></a>&nbsp;&nbsp;';
                        tabla += '        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fas fa-eye fs-15px"></i></a>';
                        tabla += '    </td>';
                        tabla += '</tr>';
                    });
                    tabla += '    </tbody>';
                    tabla += '</table>';
                    $('#div_chats').html(tabla);
                }
            }
        });

    }

    function aceptarPedido(id) {
        $.ajax({
            url: "{{URL::to('agent/aceptarPedido')}}/" + id,
            type: 'PUT',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(res) {
                if (res) {
                    location.reload();
                }
            }
        });
    }

    function selectChatBot(id) {
        var detail = '';
        var bot = 'bot';
        var cierre = 'cierre';
        var hand = 'hand';
        detail += '     <div class="form-check form-switch mb-2">';
        detail += '         <input onclick="javascript:changeEstado(1, ' + id + ',\'' + bot + '\');" class="form-check-input" id="change-bot" type="checkbox">';
        detail += '         <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fas fa-user-secret"></i> Modo Agente</label>';
        detail += '     </div>';
        detail += '     <div class="form-check form-switch mb-2">';
        detail += '         <input onclick="javascript:changeEstado(2, ' + id + ',\'' + cierre + '\');"class="form-check-input" id="change-cierre" type="checkbox">';
        detail += '         <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fas fa-door-closed"></i> Estado Conversación</label>';
        detail += '     </div>';
        detail += '     <select onchange="javascript:changeEstado(3, ' + id + ',\'' + hand + '\');" id="change-hand" class="form-select form-select-sm">';
        detail += '         <option>PENDIENTE</option>';
        detail += '         <option>ACEPTADO</option>';
        detail += '         <option>VENDIDO</option>';
        detail += '         <option>RESUELTO</option>';
        detail += '     </select>';
        detail += '     <hr>';


        detail += '    <section class="col col-sm-12">';
        detail += '        <div class="form-group">';
        detail += '            <label for="name">Categorias Chat</label>';
        detail += '            <select onchange="javascript:selectCategory(' + id + ');" class="col col-sm-3 categorias" name="empresa[]" id="category-message" multiple="multiple" style="width: 100%;" placeholder="ELIJE">';

        detail += '            </select>';
        detail += '        </div>';
        detail += '    </section>';
        detail += '    <hr>';




        detail += '<div class="widget-chat rounded mb-4" data-id="widget">';
        detail += '    <div class="widget-chat-header">';
        detail += '        <div class="widget-chat-header-icon">';
        detail += '            <i class="fab fa-whatsapp w-30px h-30px fs-20px bg-green text-white d-flex align-items-center justify-content-center rounded"></i>';
        detail += '        </div>';
        detail += '        <div class="widget-chat-header-content">';
        detail += '            <h4 class="widget-chat-header-title">Discusión</h4>';
        detail += '            <p class="widget-chat-header-desc">1 miembro, 1 online</p>';
        detail += '        </div>';
        detail += '    </div>';
        detail += '    <div class="widget-chat-body" data-scrollbar="true" data-height="225px" data-init="true" style="overflow-y: scroll;height: 425px;" id="conversation">';


        detail += '    </div>';
        detail += '    <div class="widget-input">';
        detail += '            <div class="widget-input-container">';
        detail += '                <div class="widget-input-icon"><a onclick="javascript:enviarMensaje(' + id + ');" class="text-gray-500"><i class="fa fa-paper-plane"></i></a></div>';
        detail += '                <div class="widget-input-box">';
        detail += '                    <input type="text" class="form-control" placeholder="Escribe un mensaje..." id="whatsapp">';
        detail += '                </div>';
        // detail += '                <div class="widget-input-icon"><a href="#" class="text-gray-500"><i class="fa fa-smile"></i></a></div>';
        // detail += '                <div class="widget-input-divider"></div>';
        // detail += '                <div class="widget-input-icon"><a href="#" class="text-gray-500"><i class="fa fa-microphone"></i></a></div>';
        detail += '            </div>';
        detail += '    </div>';
        detail += '</div>';
        $('#div-conversation').html(detail);
        $('.categorias').select2();
        cargarConversacion(id);
        $("#whatsapp").keypress(function(e) {
            if (e.which == 13) {
                enviarMensaje(id);
            }
        });
    }

    function refreshChat() {
        if ($('#bot-header').val() !== '' && $('#cant-msg').val() !== '') {
            var id = $('#bot-header').val();
            var cantMsg = $('#cant-msg').val();
            $.ajax({
                url: "{{URL::to('agent/countMenssage')}}/" + id,
                type: 'GET',
                success: function(res) {
                    var cantidadActual = parseInt(cantMsg);
                    var cantidadNueva = parseInt(res);
                    if (cantidadActual !== cantidadNueva) {
                        console.log(cantidadActual, cantidadNueva, cantidadActual !== cantidadNueva);
                        cargarConversacion(id);
                        sonidoAlerta();
                    }
                }
            });
        }
    }

    function sonidoAlerta() {
        var audio = new Audio('/media/audio/pedido.mp3');
        audio.play();
    }

    function cargarConversacion(id) {
        $.ajax({
            url: "{{URL::to('agent/showConversation')}}/" + id,
            type: 'GET',
            success: function(res) {
                console.log(res);
                if (res.header.agente) {
                    $("#change-bot").prop("checked", true);
                } else {
                    $("#change-bot").prop("checked", false);
                }
                if (parseInt(res.header.status)) {
                    $("#change-cierre").prop("checked", true);
                } else {
                    $("#change-cierre").prop("checked", false);
                }
                $('#change-hand').val(res.header.status_venta);
                //contador de mensajes
                $('#cant-msg').val(res.conversation.length);
                $('#bot-header').val(id);
                //agegar categorias
                var option = '';
                option += '<option disabled> Elija una Categoria</option>';
                $.each(res.category, function(index, val) {
                    if (val.statusChecked) {
                        option += '<option value="' + val.id + '"  selected="">' + val.name + '</option>';
                    } else {
                        option += '<option value="' + val.id + '">' + val.name + '</option>';
                    }
                });
                $('#category-message').html(option);

                var detail = '';
                $.each(res.conversation, function(index, value) {
                    if (value.date_created == value.fechaActual) {
                        detail += '    <div class="text-center text-gray-500 m-2 fw-bold">Hoy</div>';
                    } else {
                        detail += '    <div class="text-center text-gray-500 m-2 fw-bold">' + value.date_created + '</div>';
                    }
                    if (!value.bot) {
                        detail += '    <div class="widget-chat-item with-media start">';
                        detail += '        <div class="widget-chat-media">';
                        detail += '            <img alt="" src="../intelho/sin_perfil.jpg"">';
                        detail += '        </div>';
                        detail += '        <div class="widget-chat-info">';
                        detail += '            <div class="widget-chat-info-container">';
                        detail += '                <div class="widget-chat-name text-primary">' + res.customer.name + '</div>';
                        detail += '                <div class="widget-chat-message">' + value.customer_answer + '</div>';
                        detail += '                <div class="widget-chat-time">' + value.horaFormato + '</div>';
                        detail += '            </div>';
                        detail += '        </div>';
                        detail += '    </div>';
                    } else if (value.bot && !value.action) {
                        detail += '    <div class="widget-chat-item end">';
                        detail += '        <div class="widget-chat-info">';
                        detail += '            <div class="widget-chat-info-container">';
                        detail += '                <div class="widget-chat-message">' + value.bot_question + '</div>';
                        detail += '                <div class="widget-chat-time">' + value.horaFormato + '</div>';
                        detail += '            </div>';
                        detail += '        </div>';
                        detail += '    </div>';
                    } else if (value.action) {
                        detail += '    <div class="widget-chat-item end">';
                        detail += '        <div class="widget-chat-info">';
                        detail += '            <div class="widget-chat-info-container">';
                        detail += '                <div class="widget-chat-message"><small><i class="far fa-lg fa-fw me-10px fa-bell"></i>' + value.description + '</small></div>';
                        detail += '                <div class="widget-chat-time">' + value.horaFormato + '</div>';
                        detail += '            </div>';
                        detail += '        </div>';
                        detail += '    </div>';
                    }
                });
                detail += '     <div class="ps__rail-x" style="left: 0px; bottom: -225px;">';
                detail += '        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>';
                detail += '    </div>';
                detail += '    <div class="ps__rail-y" style="top: 225px; height: 235px; right: 0px;">';
                detail += '        <div class="ps__thumb-y" tabindex="0" style="top: 115px; height: 120px;"></div>';
                detail += '    </div>';
                $('#conversation').html(detail);
                //bajar scroll al final del chat
                $('#conversation').scrollTop($('#conversation')[0].scrollHeight);
            }
        });
    }

    function selectCategory(id) {
        $.ajax({
            url: "{{URL::to('agent/updateCategory')}}/" + id,
            type: 'PUT',
            data: {
                "_token": "{{ csrf_token() }}",
                category: $('#category-message').val()
            },
            success: function(res) {
                if (res) {

                }
            }
        });
    }

    function changeEstado(id, header, tipo) {
        if ($("#change-" + tipo).is(':checked') && (id == 1 || id == 2)) {
            var resultado = 1;
        } else if (!$("#change-" + tipo).is(':checked') && (id == 1 || id == 2)) {
            var resultado = 0;
        } else {
            var resultado = $("#change-" + tipo).val()
        }
        $.ajax({
            url: "{{URL::to('agent/updateConfig')}}",
            type: 'PUT',
            data: {
                "_token": "{{ csrf_token() }}",
                tipo: tipo,
                header: header,
                resultado: resultado
            },
            success: function(res) {
                if (res) {

                }
            }
        });
    }

    function enviarMensaje(id) {
        var text = $('#whatsapp').val();
        $('#whatsapp').val('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('agent/sendWhatsappAgente')}}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                text: text
            },
            success: function(res) {
                if (res) {

                }
            }
        });
    }

    function bucarTablaActivos() {
        var oTable = $('#table_mensajes').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [
                [2, "DESC"]
            ],
            "ajax": {
                url: "{{URL::to('agent/verDatosActivos')}}",
                "dataType": "json",
                "type": "GET",
                "async": false
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'persona'
                },
                {
                    data: 'accion'
                },
            ]
        });
        $('#table_mensajes_filter').show();
        $('#cabeceraMensaje').hide();
        setInterval(function() {
            oTable.ajax.reload(null, false);
        }, 5000);
    }

    function bucarTablaCerrados() {
        var oTable = $('#table_mensajes_cerrado').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [
                [2, "DESC"]
            ],
            "ajax": {
                url: "{{URL::to('agent/verDatosCerrados')}}",
                "dataType": "json",
                "type": "GET",
                "async": false
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'persona'
                },
                {
                    data: 'accion'
                },
            ]
        });
        $('#table_mensajes_cerrado_filter').hide();
        $('#cabeceraMensajeCerrado').hide();
        setInterval(function() {
            oTable.ajax.reload(null, false);
        }, 5000);
    }
</script>
@stop