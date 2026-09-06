@extends('layouts.app')
@section('title')Api @stop
@section('breadcrumbs1')Api @stop
@section('breadcrumbs2')Api @stop
@section('custom_css') @stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-4 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                <div class="panel-heading ui-sortable-handle">
                    <i class="fas fa-lg fa-fw me-10px fa-city"></i><span>Empresas</span>&nbsp;
                </div>
            </div>
            <div class="panel-body bg-light">
                <table id="table-company-apiheader" class="table table-bordered align-middle">
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
    <div class="col-xl-8 ui-sortable">
        <div class="row">
            <div class="col-xl-12 ui-sortable">
                <div class="row">
                    <div class="col-xl-6 ui-sortable">
                        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                            <div class="panel-heading">
                                <h4 class="panel-title">Apis</h4>
                                <input type="hidden" id="company-api">
                                <div class="btn-group my-n1" id="add-api">

                                </div>
                            </div>
                            <div class="panel-body bg-light" id="apis-vista">
                                <p class="text-center"><i class="icon-direction h3 d-block"></i>Seleccione una Empresa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 ui-sortable">
                        <div class="row">
                            <div class="col-xl-12 ui-sortable">
                                <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                                    <div class="panel-heading ui-sortable-handle">
                                        <i class="fas fa-lg fa-fw me-10px fa-cog"></i><span>Campos (Lo que se va a obtener de la consulta)</span>&nbsp;
                                    </div>
                                    <div class="panel-body bg-light">
                                        <div id="campos-buttons">
                                        </div>
                                        <div id="campos-vista">
                                            <p class="text-center"><i class="icon-globe-alt h3 d-block"></i>Seleccione una Api.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 ui-sortable">
                                <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
                                    <div class="panel-heading ui-sortable-handle">
                                        <i class="fas fa-lg fa-fw me-10px fa-cog"></i><span>Parametros (Lo que se va a enviar a la consulta)</span>&nbsp;
                                    </div>
                                    <div class="panel-body bg-light">
                                        <div id="parameters-buttons">
                                        </div>
                                        <div id="parameters-vista">
                                            <p class="text-center"><i class="icon-globe-alt h3 d-block"></i>Seleccione una Api.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('apiheader/modal_apiheader')
@include('apiheader/modal_api_intention')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#table-company-apiheader").DataTable({
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
    });

    function selectCompany(company) {
        pintarFilas(company);
        $.ajax({
            url: "{{URL::to('apiheader')}}/" + company,
            type: 'GET',
            success: function(res) {
                console.log(res);
                $('#company-api').val(company);
                var botonaddapi = '';
                var botonaddapi = '<a onclick="javascript:agregarApis();" class="btn btn-primary btn-xs"><i class=" fas fa-cloud"></i> Agregar</a>';
                $('#add-api').html(botonaddapi);
                if (res.length === 0) {
                    limpiarCampos();
                } else {
                    var linea2 = '';
                    linea2 += '<p class="text-center"><i class="icon-globe-alt h3 d-block"></i>Seleccione una Api.</p>';
                    $('#campos-vista').html(linea2);
                    var linea3 = '';
                    linea3 += '<p class="text-center"><i class="icon-globe-alt h3 d-block"></i>Seleccione una Api.</p>';
                    $('#parameters-vista').html(linea3);
                    addApis(res);
                }
            }
        });
    }

    function limpiarCampos() {
        var linea = '';
        linea += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No se ha encontrado Información.</p>';
        $('#apis-vista').html(linea);
        var linea2 = '';
        linea2 += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No se ha encontrado Información.</p>';
        $('#campos-vista').html(linea2);
        var linea3 = '';
        linea3 += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No se ha encontrado Información.</p>';
        $('#parameters-vista').html(linea3);
        var campboton = '';
        $('#campos-buttons').html(campboton);
        var paramboton = '';
        $('#parameters-buttons').html(paramboton);
    }

    function addApis(res) {
        table = '';
        table += '  <table id="table-apis" class="table table-sm mb-0 text-dark">';
        table += '      <thead>';
        table += '          <tr>';
        table += '              <th>Nombre</th>';
        table += '              <th>Método</th>';
        table += '              <th data-orderable="false">Acción</th>';
        table += '          </tr>';
        table += '      </thead>';
        table += '      <tbody>';
        table += '      </tbody>';
        table += '  </table>';
        $('#apis-vista').html(table);
        api = '';
        $.each(res, function(index, value) {
            api += '<tr id="api-' + value.id + '" class="api-header">';
            api += '    <td>';
            api += '        ' + value.description + '<br>';
            api += '        <b>Tabla: ' + value.table_name + '</b><br> <label class="badge bg-success">' + value.tipo_consulta + '</label>';
            api += '        <i><b>URL: </b>' + value.api_link + '</i>';
            api += '    </td>';
            api += '    <td>';
            api += '        <label class="badge bg-danger">' + value.method + '</label>';
            api += '    </td>';
            api += '    <td class="text-center">';
            api += '        <a onclick="javascript:selectIntention(' + value.id + ',' + value.company_id + ');" type="button" class="btn btn-default btn-xs" title="Relacionar Intenciones"><i class="fas fa-hand-pointer"></i></a>';
            api += '        <a onclick="javascript:selectApi(' + value.id + ',' + value.company_id + ');" type="button" class="btn btn-default btn-xs" title="Ver Campos y Parámetros"><i class="fas fa-eye"></i></a>';
            api += '        <a onclick="javascript:deleteApi(' + value.id + ');" type="button" class="btn btn-default btn-xs" title="Eliminar Api!!!!"><i class="fas fa-folder-minus"></i></a>';
            api += '        <a onclick="javascript:editApi(' + value.id + ');" type="button" class="btn btn-default btn-xs" title="Editar Api"><i class="fa fa-edit"></i></a>';
            api += '    </td>';
            api += '</tr>';
        });
        $('#table-apis > tbody').html(api);
        $("#table-apis").DataTable({
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
    }

    function selectApi(header, company) {
        pintarFilasHeader(header);
        $.ajax({
            url: "{{URL::to('apiheader/showParameters')}}/" + header + '/' + company,
            type: 'GET',
            success: function(res) {
                console.log(res);
                var campboton = '';
                addColumns
                campboton += '<form class="form-horizontal form-bordered">';
                campboton += '      <div class="form-group row">';

                if (res.header.need_table) {
                    campboton += '          <div class="col-lg-5">';
                    campboton += '              <select class="detail-select2 form-control" id="campos-select">';
                    campboton += '                  <optgroup label="Campos que se encuentran en la Tabla">';
                    $.each(res.columns, function(index, value) {
                        if (res.sistema == 1) {
                            campboton += '                  <option value="' + value + '">' + value + '</option>';
                        } else {
                            campboton += '                  <option value="' + value.Column_name + '">' + value.Column_name + '</option>';
                        }
                    });
                    campboton += '                  </optgroup>';
                    campboton += '              </select>';
                    campboton += '          </div>';

                    campboton += '<div class="col-lg-4">';
                    campboton += '    <input type="text" class="form-control mb-5px" id="campos-alias">';
                    campboton += '</div>';

                } else {
                    campboton += '<div class="col-lg-8">';
                    campboton += '    <input type="text" class="form-control mb-5px" id="campos-select">';
                    campboton += '</div>';
                }

                campboton += '          <div class="col-lg-3">';
                campboton += '              <a onclick="javascript:agregarCampoTabla(' + header + ');" class="btn btn-danger btn-sm">Agregar</a>';
                campboton += '          </div>';
                campboton += '      </div>';
                campboton += '</form>';
                campboton += '<hr class="bg-gray-500" />';
                $('#campos-buttons').html(campboton);
                $(".detail-select2").select2();
                if (res.detail.length === 0) {
                    var campos = '';
                    campos += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No se ha encontrado Información.</p>';
                    $('#campos-vista').html(campos);
                } else {
                    if (res.detail.length >= 1) {
                        addColumns(res.detail);
                    }
                }
                var paramboton = '';
                paramboton += '<form class="form-horizontal form-bordered">';
                paramboton += '      <div class="form-group row">';

                if (res.header.need_table) {
                    paramboton += '          <div class="col-lg-8">';
                    paramboton += '              <select class="parameters-select2 form-control" id="parameters-select">';
                    paramboton += '                  <optgroup label="Parametros que se envia en la API">';
                    $.each(res.columns, function(index, value) {
                        if (res.sistema == 1) {
                            paramboton += '                  <option value="' + value + '">' + value + '</option>';
                        } else {
                            paramboton += '                  <option value="' + value.Column_name + '">' + value.Column_name + '</option>';
                        }
                    });
                    paramboton += '                  </optgroup>';
                    paramboton += '              </select>';
                    paramboton += '          </div>';
                } else {
                    paramboton += '<div class="col-lg-8">';
                    paramboton += '    <input type="text" class="form-control mb-5px" id="parameters-select">';
                    paramboton += '</div>';
                }

                paramboton += '          <div class="col-lg-4">';
                paramboton += '              <a onclick="javascript:agregarParametersTabla(' + header + ');" class="btn btn-indigo btn-sm">Agregar</a>';
                paramboton += '          </div>';
                paramboton += '      </div>';
                paramboton += '</form>';
                paramboton += '<hr class="bg-gray-500" />';
                $('#parameters-buttons').html(paramboton);
                $(".parameters-select2").select2();
                if (res.parameters.length === 0) {
                    var parameters = '';
                    parameters += '<p class="text-center"><i class="icon-cup h3 d-block"></i>No se ha encontrado Información.</p>';
                    $('#parameters-vista').html(parameters);
                } else {
                    if (res.parameters.length >= 1) {
                        addParameters(res.parameters);
                    }
                }
            }
        });
    }

    function selectIntention(header, company) {
        $.ajax({
            url: "{{URL::to('apiheader/showIntention')}}/" + header + '/' + company,
            type: 'GET',
            success: function(res) {
                console.log(res);
                var intention = '';
                $.each(res, function(index, value) {
                    intention += '<div class="form-check mt-2 mb-2">';
                    if (value.checked) {
                        intention += '  <input onclick="javascript:saveIntention(' + value.id + ', ' + header + ', ' + company + ')" class="form-check-input" type="checkbox" value="" id="inten-' + value.id + '" name="inten-' + value.id + '" checked>';
                    } else {
                        intention += '  <input onclick="javascript:saveIntention(' + value.id + ', ' + header + ', ' + company + ')" class="form-check-input" type="checkbox" value="" id="inten-' + value.id + '" name="inten-' + value.id + '">';
                    }
                    intention += '  <label class="form-check-label" for="flexCheckDefault">' + value.name + '</label>';
                    intention += '</div>';
                });
                $('#div-intention').html(intention);
                $('#modalApiIntention').modal('show');
            }
        });
    }

    function saveIntention(intention, api, company) {
        var estado = ($('#inten-' + intention).prop('checked')) ? 1 : 0;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/saveIntention')}}",
            type: 'POST',
            data: {
                intention: intention,
                api: api,
                company: company,
                estado: estado
            },
            success: function(res) {
                if (res) {
                    alerta.toast('Notifiación', 'Se actualizó la información', 'success');
                }
            }
        });
    }

    function addColumns(res) {
        table = '';
        table += '<div class="table-responsive">';
        table += '      <table id="table-columns" class="table align-middle">';
        table += '          <thead>';
        table += '              <tr>';
        table += '                  <td colspan="2">Campos a Devolver</td>';
        table += '                  <td colspan="1">Alias</td>';
        table += '              </tr>';
        table += '          </thead>';
        table += '          <tbody>';
        table += '          </tbody>';
        table += '      </table>';
        table += '</div>';
        $('#campos-vista').html(table);
        col = '';
        $.each(res, function(index, value) {
            col += '<tr id="col-' + value.id + '">';
            col += '    <td>';
            col += '        Nombre del Campo:<br>';
            col += '        <b>' + value.column_name + '</b>';
            col += '    </td>';
            col += '    <td>';
            col += '        Alias:<br>';
            col += '        <b>' + value.alias + '</b>';
            col += '    </td>';
            col += '    <td class="text-center">';
            col += '        <a onclick="javascript:deleteCol(' + value.id + ');" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>';
            col += '    </td>';
            col += '</tr>';
        });
        $('#table-columns > tbody').html(col);
    }

    function addParameters(res) {
        table = '';
        table += '<div class="table-responsive">';
        table += '      <table id="table-parameters" class="table align-middle">';
        table += '          <thead>';
        table += '              <tr>';
        table += '                  <td colspan="2">Parametros a enviar</td>';
        table += '              </tr>';
        table += '          </thead>';
        table += '          <tbody>';
        table += '          </tbody>';
        table += '      </table>';
        table += '</div>';
        $('#parameters-vista').html(table);
        param = '';
        $.each(res, function(index, value) {
            param += '<tr id="api-' + value.id + '">';
            param += '    <td>';
            param += '        Nombre del Parámetro:<br>';
            param += '        <b>' + value.name + '</b>';
            param += '    </td>';
            param += '    <td class="text-center">';
            param += '        <a onclick="javascript:deleteParam(' + value.id + ');" class="btn btn-blue btn-icon btn-circle"><i class="fa fa-times"></i></a>';
            param += '    </td>';
            param += '</tr>';
        });
        $('#table-parameters > tbody').html(param);
    }

    function agregarApis() {
        limpiarModal();
        $('#modalApiHeader').modal('show');
    }

    function guardarApiheader() {
        parametros = {};
        parametros['company_id'] = $('#company-api').val();
        parametros['type_api'] = $('#type_api').val();
        parametros['description'] = $('#description').val();
        parametros['table_name'] = $('#table_name').val();
        parametros['api_link'] = $('#api_link').val();
        parametros['instancia'] = $('#instancia').val();
        parametros['token'] = $('#token').val();
        parametros['tipo_consulta'] = $('#tipo_consulta').val();
        parametros['method'] = $('#method').val();
        if ($('#need_table').is(':checked')) {
            parametros['need_table'] = 1;
        } else {
            parametros['need_table'] = 0;
        }

        if($('#idApi').val() !== ''){
            var id = $('#idApi').val()
            var url = "{{URL::to('apiheader/updateApi')}}/" + id;
        }else{
            var url = "{{URL::to('apiheader')}}";
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'POST',
            data: {
                parametros: parametros,
            },
            success: function(res) {
                if (res) {
                    addApis(res);
                    $('#modalApiHeader').modal('hide');
                }
            }
        });
    }

    function agregarCampoTabla(header) {
        parametros = {};
        parametros['company_id'] = $('#company-api').val();
        parametros['api_header_id'] = header;
        // parametros['description'] = $('#description').val();
        parametros['column_name'] = $('#campos-select').val();
        parametros['alias'] = $('#campos-alias').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/agregarCampo')}}",
            type: 'POST',
            data: {
                parametros: parametros,
            },
            success: function(res) {
                console.log(res);
                if (res) {
                    addColumns(res)
                }
            }
        });
    }

    function agregarParametersTabla(header) {
        parametros = {};
        parametros['company_id'] = $('#company-api').val();
        parametros['api_header_id'] = header;
        // parametros['description'] = $('#description').val();
        parametros['name'] = $('#parameters-select').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/agregarParameters')}}",
            type: 'POST',
            data: {
                parametros: parametros,
            },
            success: function(res) {
                console.log(res);
                if (res) {
                    addParameters(res)
                }
            }
        });
    }

    function deleteCol(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/deleteCol')}}/" + id,
            type: 'DELETE',
            success: function(res) {
                console.log(res);
                if (res) {
                    addColumns(res)
                }
            }
        });
    }

    function deleteParam(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/deleteParam')}}/" + id,
            type: 'DELETE',
            success: function(res) {
                console.log(res);
                if (res) {
                    addParameters(res)
                }
            }
        });
    }

    function deleteApi(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('apiheader/deleteApi')}}/" + id,
            type: 'DELETE',
            success: function(res) {
                console.log(res);
                if (res) {
                    addApis(res.apis_new);
                    addColumns(res.detail);
                    addParameters(res.parameters);
                }
            }
        });
    }

    function pintarFilas(id) {
        $('.table-company').removeClass('table-primary');
        $('#fil-' + id).addClass('table-primary');
    }

    function pintarFilasHeader(id) {
        $('.api-header').removeClass('table-primary');
        $('#api-' + id).addClass('table-primary');
    }

    function cambioSistema() {
        var sistema = $('#type_api').val();
        var company = $('#company-api').val();
        $.ajax({
            url: "{{URL::to('apiheader/agregarApis')}}/" + company + '/' + sistema,
            type: 'GET',
            success: function(res) {
                if (res) {
                    console.log(res.tables);
                    var table = '';
                    table += '<form class="form-horizontal form-bordered">';
                    table += '<label class="form-label">Tabla</label>';
                    table += '      <select class="tablas-select2 form-control" id="table_name" name="table_name">';
                    table += '      <option selected="" disabled>Seleccione una tabla</option>';
                    if (sistema == 1) {
                        $.each(res.tables, function(index, value) {
                            var database = '';
                            database = value.Tables_in_sigcrmprod;
                            table += '      <option value="' + database + '">' + database + '</option>';
                        });
                    } else {
                        $.each(res.tables, function(index, value) {
                            table += '      <option value="' + value + '">' + value + '</option>';
                        });
                    }
                    table += '      </select>';
                    table += '</form>';
                    $("#table-select").html(table);
                    $(".tablas-select2").select2({
                        dropdownParent: $("#modalApiHeader")
                    });

                }
            }
        });

    }

    function editApi(id) {
        limpiarModal();
        $.ajax({
            url: "{{URL::to('apiheader/showApi')}}/" + id,
            type: 'GET',
            success: function(res) {
                if (res) {
                    console.log(res);
                    $('#idApi').val(id);
                    $('#type_api').val(res.type_api);
                    $('#table_name').val(res.table_name);
                    if(res.need_table){
                        document.querySelector('#need_table').checked = true;
                    }else{
                        document.querySelector('#need_table').checked = false;
                    }
                    $('#description').val(res.description);
                    $('#api_link').val(res.api_link);
                    $('#instancia').val(res.instancia);
                    $('#token').val(res.token);
                    $('#tipo_consulta').val(res.tipo_consulta);
                    $('#method').val(res.method);
                    $('#modalApiHeader').modal('show');
                }
            }
        });
    }

    function limpiarModal() {
        $('#idApi').val('');
        $('#type_api').val('');
        $('#table_name').val('');
        $('#need_table').val('');
        $('#description').val('');
        $('#api_link').val('');
        $('#instancia').val('');
        $('#token').val('');
        $('#tipo_consulta').val('');
        $('#method').val('');
    }
</script>
@stop