@extends('layouts.app')
@section('title')Empresas @stop
@section('breadcrumbs1')Empresas @stop
@section('breadcrumbs2')Empresas @stop
@section('custom_css')@stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-12 ui-sortable">
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
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
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


</script>
@stop