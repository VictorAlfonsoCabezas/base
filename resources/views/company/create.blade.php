@extends('layouts.app')
@section('title')Empresas @stop
@section('breadcrumbs1')Empresas @stop
@section('breadcrumbs2')Crear @stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-12 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Información de Empresas</h4>
            </div>
            <form action="/company" method="POST" autocomplete="false" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="panel-body bg-light">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a href="#default-tab-1" data-bs-toggle="tab" class="nav-link active">Información</a>
                        </li>
                        <li class="nav-item">
                            <a href="#default-tab-2" data-bs-toggle="tab" class="nav-link">Servicios</a>
                        </li>
                    </ul>
                    <div class="tab-content panel p-3 rounded">
                        <div class="tab-pane fade active show" id="default-tab-1">

                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="ruc" id="ruc" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            RUC
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="company_name" id="company_name" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Nombre de la Companía
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="comercial_name" id="comercial_name" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Nombre Comercial
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="legal_representative" id="legal_representative" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Representante Legal
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-15px">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Descripción de la Empresa</label>
                                        <textarea class="form-control text-uppercase" name="company_description" id="company_description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Dirección</label>
                                        <textarea class="form-control text-uppercase" name="address" id="address" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-15px">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="company_color" id="company_color" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Color
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control fs-15px" name="phone" id="phone" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Teléfono
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="email" class="form-control fs-15px" name="email" id="email" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Email
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="url" id="url" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            URL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control fs-15px" name="ip" id="ip" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            IP Externa
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="latitud" id="latitud" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Latitud
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="longitud" id="longitud" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Longitud
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="tab-pane fade" id="default-tab-2">

                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="principal" id="principal" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Principal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="code_intel" id="code_intel" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Código Intélho
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="conexion" id="conexion" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Conexion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="imprimir_comprobantes" id="imprimir_comprobantes" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Comprobantes Electrónicos
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="instancia_interno" id="instancia_interno" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Instancia Interna
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="token_interno" id="token_interno" readonly="" value="{{$token}}" required />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Token Interno
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="instancia" id="instancia" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Instancia ChatApi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="token_chatapi" id="token_chatapi" required />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Token ChatApi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control fs-15px" name="hora_inicio" id="hora_inicio" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Hora Inicio
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control fs-15px" name="hora_fin" id="hora_fin" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Hora Fin
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="panel-footer text-end">
                    <a class="btn btn-white btn-sm" href="/company"> Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@stop