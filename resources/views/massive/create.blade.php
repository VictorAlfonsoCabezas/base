@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')

<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Información del Usuario</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <form id="form_documento" data-parsley-validate="true" action="/usuarios" method="POST" autocomplete="false" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="codigo_carga" name="codigo_carga" value="{{$tokem}}">
        <input type="hidden" id="input_inmediato" name="input_inmediato" value="N">
        <input type="hidden" id="input_repetir" name="input_repetir" value="N">
        <div class="panel-body">
            <div class="row">
                <div class="tab-pane" id="hr3" >
                    <ul>
                        <li><h2 style="margin: 0;">Paso 1. Descargar el archivo Modelo en formato Excel</h2>
                            <small>Comience por descargar el archivo modelo con los titulos de las columnas que el sistema necesita para importar sus datos</small><br>
                            <a href="{{ asset('descargables/MensajeriaMasiva.xlsx') }}">Descargar archivo modelo</a>
                        </li>
                        <li><h2 style="margin: 5px;">Paso 2. Copiar los datos en la planilla</h2>
                            <small>
                                Copie y pegue los datos dentro del archivo descargado en el Paso 1. Asegurese de que los datos que se copian coincidan con los titulos de las columnas respectivas del archivo modelo.<br>
                                <b class="text-danger">IMPORTANTE: No cambie los títulos de las columnas en el archivo modelo, ni cree páginas extra dentro del archivo. Estos tienen que permanecer sin cambios para que la importación funcione correctamente.</b>
                            </small>
                        </li>
                        <li><h2 style="margin: 5px;">Paso 3. "Guardar Como" archivo.xlsx </h2>
                            <small>
                                Una vez completado el archivo modelo con los datos. "Guardar Como" su Excel .
                            </small>
                        </li>
                        <li><h2 style="margin: 5px;">Paso 4. Importar el archivo .xlsx generado</h2>
                            <small>
                                Seleccionar el archivo .xlsx generado y hacer click en el botón "Importar Datos".
                            </small>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox"  id="envio_inmediato" name="envio_inmediato" onchange="javascript:cambioInmediato();">
                        <label class="form-check-label" for="envio_inmediato">Envio Inmediato ?</label>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6" style="display: none;" id="div_inmediato">
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="col-lg-12">
                                <input type="date" class="form-control" id="fecha_envio" name="fecha_envio" placeholder="Select Date" value="{{date('Y-m-d')}}">
                                <small class="fs-12px text-gray-500-darker">Seleccione la fecha de envio.</small>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="col-lg-12">
                                <input type="time" id="hora_envio" name="hora_envio" class="form-control timepicker" value="{{date('H:m:i')}}">
                                <small class="fs-12px text-gray-500-darker">Seleccione la hora de envio.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox"  id="recurrencia" name="recurrencia" onchange="javascript:recurrenciaEnvio();">
                        <label class="form-check-label" for="recurrencia">Repetir los mensajes ?</label>
                    </div>
                </div>
                <div class="col-xl-8 col-md-6" style="display: none;" id="div_recurrente">
                    <div class="well">
                        <div class="botonesSuperiores" style="margin-bottom: 5px;">
                            <div class="row">
                                <div class="col-xl-4 col-md-6">
                                    <div class="col-lg-12">
                                        <input type="date" class="form-control" id="fecha_recurrencia" name="fecha_recurrencia" placeholder="Select Date" value="{{date('Y-m-d')}}">
                                        <small class="fs-12px text-gray-500-darker">Seleccione Fecha.</small>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="col-lg-12">
                                        <input type="time" id="hora_recurrencia" name="hora_recurrencia" class="form-control" value="{{date('H:m:i')}}">
                                        <small class="fs-12px text-gray-500-darker">Seleccione hora.</small>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="col-lg-12">
                                        <a id="agregarEvento" class="btn btn-labeled btn-success header-btn btn-lg" href="javascript:agregarFecha()">
                                            <span class="btn-label"><i class="fas fa-plus fa-xs"></i></span>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-inverse">
                        <div class="panel-body">
                            <div id="data-table-default_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table id="table_fechas" class="table table-striped table-bordered align-middle dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table-default_info" style="width: 100%;;">
                                    <thead>
                                        <tr role="row">
                                            <th width="1%" class="sorting sorting_asc" tabindex="0" aria-controls="data-table-default" rowspan="1" colspan="1" style="width: 20px;" aria-sort="ascending" aria-label=": activate to sort column descending">
                                            </th>
                                            <th class="text-nowrap sorting" tabindex="0" aria-controls="data-table-default" rowspan="1" colspan="1" style="width: 156px;" aria-label="Rendering engine: activate to sort column ascending">Fecha</th>
                                            <th class="text-nowrap sorting" tabindex="0" aria-controls="data-table-default" rowspan="1" colspan="1" style="width: 193px;" aria-label="Browser: activate to sort column ascending">Hora</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control" id="file" type="file" class="custom-file-input"  name="file">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="bot_header_id" id="bot_header_id" data-parsley-required="true">
                        <option value="">- Elija una Campaña-</option>
                        @foreach($botHeader as $bot)
                        <option value="{{$bot->id}}">{{$bot->name}}</option>
                        @endforeach
                    </select>
                    <small class="fs-12px text-gray-500-darker">Seleccione El mensaje a enviar.</small>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                        <div class="col-lg-8">
                            <a onclick="javascript:cargarArchivo();" class="btn btn-primary">Importar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="panel panel-inverse" data-sortable-id="table-basic-8">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Personas <span class="badge bg-success ms-1">Nuevas</span></h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="tabla_cargas" class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input type="checkbox" value="" id="table_checkbox_1" class="form-check-input">
                                <label for="table_checkbox_1" class="form-check-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>Primer NOmbre</th>
                        <th>Segundo NOmbre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>N. Identificacion</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input type="checkbox" value="" id="table_checkbox_2" class="form-check-input">
                                <label for="table_checkbox_2" class="form-check-label">&nbsp;</label>
                            </div>
                        </td>
                        <th>Victor</th>
                        <th>Alfonso</th>
                        <th>Cabezas</th>
                        <th>Anrango</th>
                        <th>1722695556</th>
                        <th>victorcabezas28@gmail.com</th>
                        <th>0998747681</th>
                        <th>Estado</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function () {
        cambioInmediato();
    });
    function cargarArchivo() {
        var formData = new FormData(document.getElementById("form_documento"));
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: "POST",
            url: "{{URL::to('massive/cargarArchivo')}}",
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            data: formData
        }).done(function (res) {
            window.location.href = "{{ URL::to('/massive') }}";
        });
    }
    function cambioInmediato() {
        if ($('#envio_inmediato').prop('checked')) {
            $('#div_inmediato').hide();
            $('#input_inmediato').val('S');
        } else {
            $('#div_inmediato').show();
            $('#input_inmediato').val('N');
        }
    }
    function recurrenciaEnvio() {
        if ($('#recurrencia').prop('checked')) {
            $('#div_recurrente').show();
            $('#input_repetir').val('S');
        } else {
            $('#div_recurrente').hide();
            $('#input_repetir').val('N');
        }
    }
    function agregarFecha() {
        var aleatorio = Math.floor(Math.random() * (1000 - 1 + 1)) + 1;
        var fecha = $('#fecha_recurrencia').val();
        var hora = $('#hora_recurrencia').val();
        if (fecha != '' && hora != '') {
            var tabla = '';
            tabla += '<tr id="' + aleatorio + '"  class="gradeX odd">';
            tabla += '    <td width="1%" class="fw-bold text-inverse dtr-control sorting_1" tabindex="0">';
            tabla += '        <a onclick="eliminaFamiliar(' + aleatorio + ')" class="btn btn-danger btn-icon btn-circle btn-sm"><i class="fa fa-times"></i></a>';
            tabla += '    </td>';
            tabla += '    <td><input type="hidden" id="fechaAddHora" name="fechaAddHora[]" class="fechaAddHora" value="' + fecha + '/' + hora + '">' + fecha + '</td>';
            tabla += '    <td><input type="hidden" id="horaAdd" name="horaAdd[]" class="horaAdd" value="' + hora + '">' + hora + '</td>';
            tabla += '</tr>';
            $('#table_fechas > tbody').append(tabla);
        } else {
            $.gritter.add({
                title: 'Alerta !',
                text: 'Asegurese de seleccionar una fecha y una hora para ser agregada',
                image: '../assets/img/user/user-2.jpg',
                sticky: true,
                time: '',
                class_name: 'my-sticky-class gritter-default',
            });

        }

    }
    function eliminaFamiliar(aleatorio) {
        $('#' + aleatorio).remove();
    }
</script>
@stop