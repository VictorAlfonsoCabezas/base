@extends('layouts.app')
@section('title')Envios @stop
@section('breadcrumbs1')Envios @stop
@section('breadcrumbs2')Envios @stop
@section('content')
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Mensajes</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <input type="text" placeholder="Parámetros de Busqueda..." class="form-control-sm form-control" id="search" style="border-radius:0px;width:280px;">
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="tabla_mensajes" class="table table-striped table-bordered align-middle">
            <thead class="thead-primary" style="font-size: 10px;">
                <tr role="row">
                    <th scope="col">#</th>
                    <th class="text-center" scope="col">EMPRESA</th>
                    <th class="text-center" scope="col">PACIENTE</th>
                    <th class="text-center" scope="col">TELEFONO</th>
                    <th class="text-center" scope="col">EMAIL</th>
                    <th class="text-center" scope="col">ESTADO</th>
                    <th class="text-center" scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px;">
                @foreach($sends as $send)
                <tr id="{{$send->id}}" class="items">
                    <td>{{$send->id}}</td>
                    <td class="text-center">{{$send->company->company_name}}</td>
                    <td class="text-center">{{$send->customer_name}}</td>
                    <td class="text-center"><b>{{$send->customer_phone}}</b></td>
                    <td class="text-center"><b>{{$send->customer_email}}</b></td>
                    <td class="text-center">
                        <span class="badge bg-blue rounded-pill">
                            {{$send->status}}
                        </span>
                    </td>
                    <td class="text-center">
                        @foreach($services as $serv)
                        <button onclick="verDetalles('{!! $send->id !!}', '{!! $serv->id !!}');" class="btn btn-{{$serv->class}} btn-sm">
                            <i class="{{$serv->icon}}"></i>
                        </button>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('envios/modal_detalle')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        setInterval('mensajes()', 5000);
        $("#search").keyup(function () {
            _this = this;
            $.each($("#tabla_mensajes tbody tr"), function () {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });

    function mensajes() {
        $.ajax({
            type: "GET",
            url: '{{URL::to("envios/traficoApis")}}'
        }).done(function (res) {
            $.each(res.mensajes, function (index, value) {
                if ($('#tabla_mensajes >tbody').find('#' + value.id).length == 0) {
                    $('#search').val('');
                    agregarLinea(value.id);
                }
            });
            $.each($('.items'), function (index, val) {
                var existe = res.mensajes.findIndex(res => res.id == val.id);
                if (existe == '-1') {
                    $('#search').val('');
                    eliminarLinea(val.id);
                }
            });
            $.each(res.services, function (index, va) {
                $('#' + va.name).html(va.cantidad);
            });
        });
    }

    function agregarLinea(id) {
        $.ajax({
            type: "GET",
            url: '{{URL::to("envios/newApis")}}/' + id
        }).done(function (res) {
            console.log(res);
            var linea = '';
            linea += '<tr id="' + res.new.id + '" class="items">';
            linea += '       <td>' + res.new.id + '</td>';
            linea += '       <td class="text-center">' + res.new.company_name + '</td>';
            linea += '       <td class="text-center">' + res.new.customer_name + '</td>';
            linea += '       <td class="text-center"><b>' + res.new.customer_phone + '</b></td>';
            linea += '       <td class="text-center"><b>' + res.new.customer_email + '</b></td>';
            linea += '       <td class="text-center">';
            linea += '           <span class="badge bg-blue rounded-pill">' + res.new.status + '</span>';
            linea += '       </td>';
            linea += '       <td class="text-center">';
            $.each(res.services, function (index, va) {
                linea += '           <button onclick="verDetalles(' + res.new.id + ', ' + va.id + ');"class="btn btn-' + va.class + ' btn-sm">';
                linea += '              <i class="' + va.icon + '"></i>';
                linea += '           </button>';
            });
            linea += '       </td>';
            linea += '</tr>';
            $('#tabla_mensajes >tbody').prepend(linea);
        });
    }

    function eliminarLinea(id) {
        $('#' + id).remove();
    }

    function verDetalles(id, servicio) {
        $.ajax({
            type: "GET",
            url: '{{URL::to("envios/showApis")}}/' + id + '/' + servicio
        }).done(function (res) {
            console.log(res);
            var linea = '';
            $.each(res, function (index, value) {
                linea += '<tr>';
                linea += '      <td class="text-center">' + value.id + '</td>';
                linea += '      <td><i class="' + value.service.icon + '"></i> ' + value.service.name + '</td>';
                linea += '      <td><b>' + value.date_send + '</b></td>';
                if (value.status == 'ENVIADO') {
                    linea += '      <td class="text-center">'
                    linea += '           <div class="progress progress-xs progress-striped active">';
                    linea += '               <div class="progress-bar bg-success" style="width: 100%"></div>';
                    linea += '           </div>';
                    linea += '      </td>';
                    linea += '      <td class="text-center" style="width: 4%;">'
                    linea += '          <span class="badge bg-success">100%</span>';
                    linea += '      </td>';
                } else {
                    linea += '      <td class="text-center">'
                    linea += '           <div class="progress progress-xs progress-striped active">';
                    linea += '               <div class="progress-bar bg-danger" style="width: 0%"></div>';
                    linea += '           </div>';
                    linea += '      </td>';
                    linea += '      <td class="text-center" style="width: 4%;">'
                    linea += '          <span class="badge bg-danger">0%</span>';
                    linea += '      </td>';
                }
                if (value.programmed) {
                    linea += '      <td class="text-center"><span class="badge bg-warning rounded-pill">Si</td>';
                } else {
                    linea += '      <td class="text-center"><span class="badge bg-danger rounded-pill">No</td>';

                }
                linea += '      <td class="text-center"><span class="badge bg-indigo rounded-pill">' + value.status + '</td>';
                linea += '</tr>';
            });
            $('#detalle_send > tbody').html(linea);
            $('#formDetalles').modal('show');
        });
    }
</script>
@stop