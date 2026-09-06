@extends('layouts.app')
@section('title')Chat Bot @stop
@section('breadcrumbs1')Chat Bot @stop
@section('breadcrumbs2')Chat Bot @stop
@section('custom_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<style>
    #map {
        position: relative;
        outline: none;
        width: 496px;
        height: 200px;
    }
</style>
@stop
@section('content')
<div class="row">
    <div class="col-xl-4 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-5">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Chat</h4>
            </div>
            <div class="panel-body">


                <div class="col-xl-12 ui-sortable">

                    <ul class="nav nav-pills">
                        <li class="nav-item" style="width: 50%;">
                            <a href="#default-tab-1" data-bs-toggle="tab" class="nav-link active" style="text-align: center;">Trabajando en</a>
                        </li>
                        <li class="nav-item" style="width: 50%;">
                            <a href="#default-tab-2" data-bs-toggle="tab" class="nav-link" style="text-align: center;">Cerrados</a>
                        </li>
                    </ul>

                    <div class="tab-content panel p-3 rounded">
                        <div class="tab-pane fade active show" id="default-tab-1">
                            <div class="widget-list rounded mb-4" data-id="widget">
                                @foreach($chatActivos as $chatAc)
                                <div class="widget-list-item" onclick="javascript:selectPaciente('{!! $chatAc->id !!}')">
                                    <div class="widget-list-media">
                                        <img src="../assets/img/user/sinfoto.jpg" width="50" alt="" class="rounded">
                                        <i class="fa fa-circle text-red" style="position: relative;top: 14px;left: -18px;"></i>
                                    </div>
                                    <div class="widget-list-content">
                                        <h4 class="widget-list-title">{!! $chatAc->customer->name !!}</h4>
                                        <p class="widget-list-desc">{{$chatAc->ultimoMensaje}}</p>
                                    </div>
                                    <div class="widget-list-action">
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fa fa-robot fs-15px"></i></a>&nbsp;&nbsp;
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fab fa-whatsapp fs-15px"></i></a>&nbsp;&nbsp;
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fas fa-eye fs-15px"></i></a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="tab-pane fade" id="default-tab-2">
                            <div class="widget-list rounded mb-4" data-id="widget">
                                @foreach($chatFinalizados as $chatFin)
                                <div class="widget-list-item" onclick="javascript:selectPaciente('{!! $chatFin->id !!}')">
                                    <div class="widget-list-media">
                                        <img src="../assets/img/user/sinfoto.jpg" width="50" alt="" class="rounded">
                                        <i class="fa fa-circle text-green" style="position: relative;top: 14px;left: -18px;"></i>
                                    </div>
                                    <div class="widget-list-content">
                                        <h4 class="widget-list-title">{!! $chatFin->customer->name !!}</h4>
                                        <p class="widget-list-desc">{{$chatFin->ultimoMensaje}}</p>
                                    </div>
                                    <div class="widget-list-action">
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fa fa-robot fs-15px"></i></a>&nbsp;&nbsp;
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fab fa-whatsapp fs-15px"></i></a>&nbsp;&nbsp;
                                        <a href="#" class="text-gray-500" aria-expanded="false"><i class="fas fa-eye fs-15px"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>



            </div>





        </div>
    </div>
    <div class="col-xl-8 ui-sortable">
        <div class="row">
            <div class="col-xl-12 ui-sortable">
                <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                    <div class="panel-heading ui-sortable-handle">
                        <i class="fas fa-lg fa-fw me-10px fa-user"></i><span id="name" class="clean"></span>&nbsp;
                        <i class="fas fa-lg fa-fw me-10px fa-address-card"></i><span id="numero_documento" class="clean"></span>&nbsp;
                        <i class="fas fa-lg fa-fw me-10px fa-gift"></i><span id="birth_date" class="clean"></span>&nbsp;
                        <i class="fab fa-lg fa-fw me-10px fa-whatsapp"></i><span id="celular_1" class="clean"></span>&nbsp;
                        <i class="fas fa-lg fa-fw me-10px fa-envelope"></i><span id="correo" class="clean"></span>&nbsp;
                    </div>
                    <div class="panel-body bg-light">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-sm mb-0 text-dark">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <b>Dirección:</b>
                                                <br><span id="direccion" class="clean"></span>
                                            </td>
                                            <td>
                                                <b>Nacionalidad:</b>
                                                <br><span id="nationality" class="clean"></span>
                                            </td>
                                            <td>
                                                <b>Sexo:</b>
                                                <br><span id="sex" class="clean"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"><b>Observación</b></label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1"><b>Observación 2</b></label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="map-container">
                                        <div id="map">
                                            <p class="text-center"><i class="icon-location-pin h3 d-block"></i>Localización.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 ui-sortable">
                <div class="row">
                    <div class="col-xl-6 ui-sortable">
                        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                            <div class="panel-heading ui-sortable-handle">
                                <i class="fas fa-lg fa-fw me-10px fa-robot"></i><span>Bots</span>&nbsp;
                            </div>
                            <div class="panel-body bg-light">
                                <div id="div-bots">
                                    <p class="text-center"><i class="icon-user h3 d-block"></i>Seleccione un Paciente.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 ui-sortable">
                        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                            <div class="panel-heading ui-sortable-handle">
                                <i class="far fa-lg fa-fw me-10px fa-comments"></i><span>Conversaciones</span>&nbsp;
                            </div>
                            <div class="panel-body bg-light">
                                <div id="div-conversation">
                                    <p class="text-center"><i class="icon-user h3 d-block"></i>Seleccione un Paciente.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-chatapi").DataTable({
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

    function selectPaciente(id) {
        pintarFilas(id);
        $.ajax({
            url: "{{URL::to('chatbot')}}/" + id + "/edit",
            type: 'GET',
            success: function(res) {
                console.log(res);
                $('#name').html(res.customer.name);
                $('#numero_documento').html(res.customer.numero_documento);
                $('#birth_date').html(res.customer.birth_date);
                $('#celular_1').html(res.customer.celular_1);
                $('#correo').html(res.customer.correo);
                $('#direccion').html(res.customer.direccion);
                $('#nationality').html(res.customer.nationality);
                $('#sex').html(res.customer.sex);
                mostrarMapa(res.address);
                if (res.header.length === 0) {
                    limpiarCampos();
                } else {
                    var linea = '';
                    linea += '<table id="table-bots" class="table table-sm mb-0 text-dark">';
                    linea += '  <tbody>';
                    linea += '  <tr id="fil-' + res.header.id + '" onclick="javascript:selectChatBot(' + res.header.id + ')">';
                    linea += '      <td>' + res.header.date_created + ' (' + res.header.name + ')<br>';
                    linea += '          <b>' + res.header.description + '</b>';
                    linea += '      </td>';
                    linea += '      <td>';
                    if (res.header.status) {
                        linea += '  <label class="badge bg-blue">Activo</label>';
                    } else {
                        linea += '  <label class="badge bg-danger">Inactivo</label>';
                    }
                    linea += '  </tr>';
                    linea += '  </tbody>';
                    linea += '</table>';
                    $('#div-bots').html(linea);
                    var conversation = '';
                    conversation += '<p class="text-center"><i class="icon-bubbles h3 d-block"></i>Seleccione el Bots.</p>';
                    $('#div-conversation').html(conversation);
                }
            }
        });
    }

    function selectChatBot(id) {
        $.ajax({
            url: "{{URL::to('chatbot/showConversation')}}/" + id,
            type: 'GET',
            success: function(res) {
                console.log(res);
                var detail = '';
                detail += '<div class="chats" data-scrollbar="true" data-height="225px" data-init="true" style="overflow-y: scroll;height: 362px;">';
                $.each(res, function(index, value) {
                    if (value.bot) {
                        detail += '     <div class="chats-item end">';
                        detail += '         <span class="date-time">08:12am</span>';
                        detail += '         <a href="javascript:;" class="name"><span class="badge bg-blue">Bot Intelho</span> Me</a>';
                        detail += '         <a href="javascript:;" class="image"><img alt="" src="{{ URL::to("/intelho/chatbot.png") }}"></a>';
                        detail += '         <div class="message">' + value.bot_question + '</div>';
                        detail += '     </div>';
                    } else {
                        detail += '     <div class="chats-item start">';
                        detail += '         <span class="date-time">yesterday 11:23pm</span>';
                        detail += '         <a href="javascript:;" class="name">Cliente</a>';
                        detail += '         <a href="javascript:;" class="image"><img alt="" src="{{ URL::to("/intelho/chatcliente.jpg") }}"></a>';
                        detail += '         <div class="message">' + value.customer_answer + '</div>';
                        detail += '     </div>';
                    }
                });
                detail += '</div>';
                $('#div-conversation').html(detail);
            }
        });
    }

    function pintarFilas(id) {
        $('.table-pacientes').removeClass('table-primary');
        $('#fil-' + id).addClass('table-primary');
    }

    function limpiarCampos() {
        var bot = '';
        bot += '<p class="text-center"><i class="icon-cup h3 d-block"></i>Nos existen Bots.</p>';
        $('#div-bots').html(bot);
        var conversation = '';
        conversation += '<p class="text-center"><i class="icon-cup h3 d-block"></i>Nos existen Bots.</p>';
        $('#div-conversation').html(conversation);
    }

    function mostrarMapa(res) {
        $('#map').html('');
        if (res.length >= 1) {
            $('#map-container').html('');
            var map = '';
            map += '<div id="map">';
            map += '</div>';
            $('#map-container').html(map);

            var map = L.map('map').setView([-1.7532045, -78.8376817], 5);
            var token = 'pk.eyJ1IjoiZmFyYWRheTIiLCJhIjoiTUVHbDl5OCJ9.buFaqIdaIM3iXr1BOYKpsQ';
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + token, {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'your.mapbox.access.token'
            }).addTo(map);
            $.each(res, function(index, value) {
                if (value.latitud !== null && value.longitud !== null) {
                    var marker = L.marker([value.latitud, value.longitud]).addTo(map);
                    var valor = "<b>";
                    valor += value.text;
                    valor += "</b><br>";
                    valor += value.latitud + ' ' + value.longitud;
                    marker.bindPopup(valor);
                }
            });
        } else {
            $('#map-container').html('');
            var map = '';
            map += '<div id="map">';
            map += '    <p class="text-center"><i class="icon-location-pin h3 d-block"></i>Sin Localización.</p>';
            map += '</div>';
            $('#map-container').html(map);
        }
    }
</script>
@stop