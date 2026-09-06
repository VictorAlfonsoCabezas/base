@extends('layouts.app')
@section('title')Empresas @stop
@section('breadcrumbs1')Empresas @stop
@section('breadcrumbs2')Empresas @stop
@section('custom_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<style>
    #map {
        position: relative;
        outline: none;
        width: 650px;
        height: 650px;
    }
</style>
@stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-6 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel-heading ui-sortable-handle">
                <i class="fas fa-lg fa-fw me-10px fa-building"></i><span>Empresas</span>&nbsp;
            </div>
            <div class="panel-body bg-light">
                <ul id="ioniconsTab" class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a href="company/create" class="nav-link active d-flex align-items-center">
                            <i class="ion-md-add-circle-outline fa-lg"></i>
                            <span class="d-none d-lg-inline ms-2">Agregar</span>&nbsp;
                        </a>
                    </li>
                </ul>
                <hr class="bg-gray-500" />
                <table id="table-company" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th class="text-nowrap">Empresa</th>
                            <th data-orderable="false">URL</th>
                            <th data-orderable="false">Conexión</th>
                            <th data-orderable="false">Twilio</th>
                            <th data-orderable="false">Estado</th>
                            <th data-orderable="false">Funciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company as $value)
                        <tr id="compa-{{$value->id}}">
                            <td width="1%">{{$value->id}}</td>
                            <td>
                                {{$value->comercial_name}}<br>
                                <b>{{$value->ruc}}</b>
                            </td>
                            <td>
                                {{$value->url}}<br>
                                <b>{{$value->ip}}</b>
                            </td>
                            <td class="text-center">
                                <input type="hidden" id="compa-conexion-{{$value->id}}" value="{{$value->conexion}}">
                                <div id="conexion-{{$value->id}}">
                                    @if($value->conexion)
                                    <i class="fas fa-lg fa-fw me-10px fa-signal"></i>
                                    @else
                                    <i class="fas fa-spinner fa-pulse text-success"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div>
                                    @if($value->twilio_principal)
                                    <span onclick="javascript:showInstance('{!! $value->id !!}');" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> I</span>
                                    @else
                                    <span onclick="javascript:showInstance('{!! $value->id !!}');" class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> I</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div id="company-status-{{$value->id}}">
                                    @if($value->status)
                                    <label onclick="javascript:descativarCompany('{!! $value->id !!}');" class="badge bg-blue">Activo</label>
                                    @else
                                    <label onclick="javascript:descativarCompany('{!! $value->id !!}');" class="badge bg-danger">Inactivo</label>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <form action="{{URL::to('company/'.$value->id)}}" method="POST">
                                    @csrf
                                    <a href="{{URL::to('company/'.$value->id.'/edit')}}" method="GET" class="btn btn-default"><i class="fas fa-edit"></i></a>
                                    @if(!$value->principal)
                                    @method("delete")
                                    <button type="submit" class="btn btn-default"><i class="far fa-trash-alt"></i></button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel-heading ui-sortable-handle">
                <i class="fas fa-lg fa-fw me-10px fa-location-arrow"></i><span>Mapa</span>&nbsp;
            </div>
            <div class="panel-body bg-light">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
@include('company/modal_instance')
@endsection
@section('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script type="text/javascript">
    $(document).ready(function() {
        cargarCompanies();
        setInterval('conexionCompanies()', 10000);
        $('#table-company').DataTable();
    });

    function eliminarCompany(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('company')}}/" + id
        }).done(function(res) {
            if (res) {
                $('#' + id).remove();
            }
        });
    }

    function cargarCompanies() {
        $.ajax({
            method: "GET",
            url: "{{URL::to('company/showCompanies')}}"
        }).done(function(res) {
            if (res) {
                console.log(res);
                var map = L.map('map').setView([-1.7532045, -78.8376817], 7);
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
                    var marker = L.marker([value.latitud, value.longitud]).addTo(map);
                    var valor = "Sede: <b>";
                    valor += value.name;
                    valor += "</b><br>";
                    valor += "<center><i>";
                    valor += value.company.comercial_name;
                    valor += "</i></center>";
                    marker.bindPopup(valor);
                });
            }
        });
    }

    function conexionCompanies() {
        $.ajax({
            method: "GET",
            url: "{{URL::to('company/conexionCompanies')}}"
        }).done(function(res) {
            $.each(res, function(index, value) {
                if ($('#compa-conexion-' + value.id).val() !== value.conexion) {
                    $('#compa-conexion-' + value.id).val(value.conexion)
                    var conex = '';
                    if (value.conexion) {
                        conex += '<i class="fas fa-lg fa-fw me-10px fa-signal"></i>';
                    } else {
                        conex += '<i class="fas fa-spinner fa-pulse text-success"></i>';
                    }
                    $('#conexion-' + value.id).html(conex);
                }
            });
        });
    }

    function descativarCompany(id) {
        console.log(id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: "{{URL::to('company/desactivarCompany')}}/" + id
        }).done(function(res) {
            if (res) {
                console.log(res);
                var estado = '';
                if (res.status) {
                    estado += '<label onclick="javascript:descativarCompany(' + id + ');" class="badge bg-blue">Activo</label>';
                    $('#company-status-' + id).html(estado);
                } else {
                    estado += '<label onclick="javascript:descativarCompany(' + id + ');" class="badge bg-danger">Inactivo</label>';
                    $('#company-status-' + id).html(estado);
                }
            }
        });
    }

    function showInstance(company) {
        $.ajax({
            method: "GET",
            url: "{{URL::to('company/knowInstance')}}/" + company
        }).done(function(res) {
            console.log(res);
            if (res) {
                var twilioPrincipal = res.company.twilio_principal;
                $('#modal-title-company').html(res.company.company_name)
                var tableSede = '';
                tableSede += '<div class="table-responsive">';
                tableSede += '  <table class="table table-striped mb-0 align-middle">';
                tableSede += '      <thead>';
                tableSede += '          <tr>';
                tableSede += '              <th>#</th>';
                tableSede += '              <th>Nombre</th>';
                tableSede += '              <th>Latitud</th>';
                tableSede += '              <th>Longitud</th>';
                tableSede += '              <th>Número Twilio</th>';
                tableSede += '              <th>Sid Twilio</th>';
                tableSede += '              <th>Token Twilio</th>';
                tableSede += '              <th width="1%"></th>';
                tableSede += '          </tr>';
                tableSede += '      </thead>';
                tableSede += '      <tbody>';
                $.each(res.sedes, function(index, value) {
                    tableSede += '          <tr>';
                    tableSede += '              <td>' + value.id + '</td>';
                    tableSede += '              <td><b>' + value.name + '</b></td>';
                    tableSede += '              <td><input id="lat-sede-' + value.id + '" type="text" class="form-control" value="' + value.latitud + '" style="width: 80px;"></td>';
                    tableSede += '              <td><input id="lon-sede-' + value.id + '" type="text" class="form-control" value="' + value.longitud + '" style="width: 80px;"></td>';
                    if (!twilioPrincipal) {
                        tableSede += '              <td><input id="number-sede-' + value.id + '" type="text" class="form-control" value="' + value.twilio_phone_number + '" style="width: 80px;"></td>';
                        tableSede += '              <td><input id="instance-sede-' + value.id + '" type="text" class="form-control" value="' + value.twilio_sid + '" style="width: 80px;"></td>';
                        tableSede += '              <td><input id="token-sede-' + value.id + '" type="text" class="form-control" value="' + value.twilio_token + '" style="width: 180px;"></td>';
                    } else {
                        tableSede += '              <td><h5>' + value.twilio_phone_number + '</h5></td>';
                        tableSede += '              <td><h5>' + value.twilio_sid + '</h5></td>';
                        tableSede += '              <td><h5>' + value.twilio_token + '</h5></td>';
                    }
                    tableSede += '              <td nowrap="">';
                    tableSede += '                  <a onclick="javascript:saveSede(' + twilioPrincipal + ',' + value.id + ');" class="btn btn-sm btn-primary w-72px me-1">Guardar</a>';
                    tableSede += '              </td>';
                    tableSede += '          </tr>';

                });
                tableSede += '      </tbody>';
                tableSede += '   </table>';
                tableSede += '</div>';
                $('#table-sedes-modal').html(tableSede);
                $('#modalInstance').modal('show');
            }
        });
    }

    function saveSede(twilioPrincipal, id) {
        console.log(id);
        var latitud = $('#lat-sede-' + id).val();
        var longitud = $('#lon-sede-' + id).val();
        var instancia = '';
        var token = '';
        var number = '';
        if(!twilioPrincipal){
            var instancia = $('#instance-sede-' + id).val();
            var token = $('#token-sede-' + id).val();
            var number = $('#number-sede-' + id).val();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "PUT",
            url: "{{URL::to('company/updateSede')}}/" + id,
            data: {
                latitud: latitud,
                longitud: longitud,
                instancia: instancia,
                token: token,
                number: number,
            },
        }).done(function(res) {
            if (res) {
                alerta.toast('Notificación', 'Se actualizó correctamente...', 'success');
                $('#modalInstance').modal('hide');
            }
        });


    }
</script>
@stop