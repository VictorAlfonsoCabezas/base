@extends('layouts.app')
@section('title')Empresas @stop
@section('breadcrumbs1')Empresas @stop
@section('breadcrumbs2')Editar @stop
@section('content')
<div class="row">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-xl-12 col-lg-6 ui-sortable">
        <div class="panel panel-inverse" data-sortable-id="index-2" data-init="true">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Información de Empresas</h4>
            </div>
            <form action="{{URL::to('company/'.$company->id)}}" method="POST" autocomplete="false" enctype="multipart/form-data">
                @csrf
                @method("put")
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
                                        <input type="text" class="form-control fs-15px" name="ruc" id="ruc" value="{{$company->ruc}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            RUC
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="company_name" id="company_name" value="{{$company->company_name}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Nombre de la Companía
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="comercial_name" id="comercial_name" value="{{$company->comercial_name}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Nombre Comercial
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="legal_representative" id="legal_representative" value="{{$company->legal_representative}}" />
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
                                        <textarea class="form-control text-uppercase" name="company_description" id="company_description" rows="5">{{$company->company_description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Dirección</label>
                                        <textarea class="form-control text-uppercase" name="address" id="address" rows="5">{{$company->address}}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-15px">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="company_color" id="company_color" value="{{$company->company_color}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Color
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control fs-15px" name="phone" id="phone" value="{{$company->phone}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Teléfono
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="email" class="form-control fs-15px" name="email" id="email" value="{{$company->email}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Email
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="url" id="url" value="{{$company->url}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            URL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control fs-15px" name="ip" id="ip" value="{{$company->ip}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            IP Externa
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="latitud" id="latitud" value="{{$company->latitud}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Latitud
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="longitud" id="longitud" value="{{$company->longitud}}" />
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
                                        <input type="text" class="form-control fs-15px" name="principal" id="principal" value="{{$company->principal}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Principal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="code_intel" id="code_intel" value="{{$company->code_intel}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Código Intélho
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="conexion" id="conexion" value="{{$company->conexion}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Conexion
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="imprimir_comprobantes" id="imprimir_comprobantes" value="{{$company->imprimir_comprobantes}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Comprobantes Electrónicos
                                        </label>
                                    </div>
                                </div>
                            </div>




                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="instancia_interno" id="instancia_interno" value="{{$company->instancia_interno}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Instancia Interna
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="token_interno" id="token_interno" readonly="" value="{{$company->token_interno}}" required />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Token Interno
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="instancia" id="instancia" value="{{$company->instancia}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Instancia ChatAPI
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control fs-15px" name="token_chatapi" id="token_chatapi" readonly="" value="{{$company->token_chatapi}}" required />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Token ChatApi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-15px">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control fs-15px" name="hora_inicio" id="hora_inicio" value="{{$company->hora_inicio}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Hora Inicio
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control fs-15px" name="hora_fin" id="hora_fin" value="{{$company->hora_fin}}" />
                                        <label for="floatingInput" class="d-flex align-items-center fs-13px">
                                            Hora Fin
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>





                    <!-- <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#basic" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Información</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#tax" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true">Servicios</a>
                            </li>
                        </ul>
                    </div> -->

                    <!-- <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">


                            <div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <div class="row">
                                    <section class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="company_name">Nombre de la Empresa</label>
                                            <input type="text" class="form-control text-uppercase" name="company_name" id="company_name" placeholder="Nombre de la Empresa" value="{{old('company_name',$company->company_name)}}" required>
                                        </div>
                                    </section>
                                    <section class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="ruc">RUC</label>
                                            <input type="number" class="form-control text-uppercase" name="ruc" id="ruc" placeholder="RUC" value="{{old('company_name',$company->ruc)}}" required>
                                        </div>
                                    </section>
                                </div>
                                <hr class="my-10">
                                <div class="row col col-sm-12">
                                    <section class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telefono</label>
                                            <input type="number" class="form-control text-uppercase" name="phone" id="phone" placeholder="Telefono" value="{{old('company_name',$company->phone)}}" required>
                                        </div>
                                    </section>
                                    <section class="col col-sm-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico" value="{{old('company_name',$company->email)}}" required>
                                        </div>
                                    </section>
                                    <section class="col col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Dirección</label>
                                            <textarea class="form-control text-uppercase" name="address" id="address" required>{{old('company_name',$company->address)}}</textarea>
                                        </div>
                                    </section>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <div class="form-group">
                                    <section class="col col-sm-4">
                                        <div class="form-group">
                                            <label for="token_company">Token API</label>
                                            <input type="text" class="form-control text-uppercase" name="token_company" id="token_company" readonly="" value="{{old('company_name',$company->token_interno)}}" required>
                                        </div>
                                    </section>
                                    @foreach($service as $ser)
                                    <div class="custom-control custom-checkbox">
                                        @if($ser['vista'])
                                        <input class="custom-control-input" type="checkbox" id="check-{{$ser['id']}}" name="check-{{$ser['id']}}" value="{{$ser['id']}}" checked="">
                                        @else
                                        <input class="custom-control-input" type="checkbox" id="check-{{$ser['id']}}" name="check-{{$ser['id']}}" value="{{$ser['id']}}">
                                        @endif
                                        <label for="check-{{$ser['id']}}" class="custom-control-label">{{$ser['name']}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div> -->



                </div>

                <div class="panel-footer text-end">
                    <a class="btn btn-white btn-sm" href="/company"> Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $("#photo").change(function() {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileName = input.files[0].name;
                var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                var fileSize = input.files[0].size;
                var fileType = input.files[0].type;
                reader.onload = function(e) {
                    $('#prevPhoto').attr('src', e.target.result);
                    $('#prevPhotoText').html("<span class='info'><b>Archivo para subir:</b> " + fileName + "<br> <b>Peso total:</b> " + fileSize + " bytes. <br><b>Tipo: </b>" + fileType + ",<br> <b>Extención:</b> " + fileExtension + "</span>");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@stop