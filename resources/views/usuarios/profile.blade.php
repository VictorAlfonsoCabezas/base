@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="profile">
    <div class="profile-header">
        <!-- BEGIN profile-header-cover -->
        <div class="profile-header-cover"></div>
        <!-- END profile-header-cover -->
        <!-- BEGIN profile-header-content -->
        <div class="profile-header-content">
            <!-- BEGIN profile-header-img -->
            <div class="profile-header-img">
                @if((Auth::user()->photo !=='') && (Auth::user()->photo !== null))
                <img src="{{ URL::asset('/uploads/users/' . Auth::user()->photo) }}" alt="">
                @else
                <img src="{{ URL::asset('/assets/img/user/user-12.jpg') }}" alt="">
                @endif
            </div>
            <!-- END profile-header-img -->
            <!-- BEGIN profile-header-info -->
            <div class="profile-header-info">
                <h4 class="mt-0 mb-1">{{ (Auth::user()->firstname.' '.Auth::user()->lastname) ?? 'Invitado' }}</h4>
                <p class="mb-2">{{$rolName}}</p>
                <a href="#" class="btn btn-xs btn-yellow">Editar Perfil</a>
            </div>
            <!-- END profile-header-info -->
        </div>
        <!-- END profile-header-content -->
        <!-- BEGIN profile-header-tab -->
        <ul class="profile-header-tab nav nav-tabs">
            <li class="nav-item"><a href="#profile-post" class="nav-link active" data-bs-toggle="tab">CREDENCIALES</a></li>
            <li class="nav-item"><a href="#profile-about" class="nav-link" data-bs-toggle="tab">ABOUT</a></li>
            <li class="nav-item"><a href="#profile-photos" class="nav-link" data-bs-toggle="tab">PHOTOS</a></li>
            <li class="nav-item"><a href="#profile-videos" class="nav-link" data-bs-toggle="tab">VIDEOS</a></li>
            <li class="nav-item"><a href="#profile-friends" class="nav-link" data-bs-toggle="tab">FRIENDS</a></li>
        </ul>
        <!-- END profile-header-tab -->
    </div>
</div>
<div class="profile-content">
    <!-- BEGIN tab-content -->
    <div class="tab-content p-0">
        <!-- BEGIN #profile-post tab -->
        <div class="tab-pane fade active show" id="profile-post">
            <div class="row">
                <!-- BEGIN col-12 -->
                <div class="col-6 ui-sortable">
                    <!-- BEGIN panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-12">
                        <!-- BEGIN panel-heading -->
                        <div class="panel-heading ui-sortable-handle">
                            <h4 class="panel-title">Nueva Contraseña</h4>
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <!-- END panel-heading -->
                        <!-- BEGIN panel-body -->
                        <div class="panel-body">
                            <form name="form_pass" id="form_pass" class="row row-cols-lg-auto g-3 align-items-center"  method="POST">
                                <div class="row">
                                    <section class="col col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="addon-wrapping-left"> Nueva Contraseña</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text"><i class="icon-append fa fa-key"></i></div>
                                                <input  type="password" id="clave_nueva" name="clave_nueva" class="form-control" placeholder="Nueva Contraseña" aria-label="Nueva Contraseña" aria-describedby="addon-wrapping-left" onkeyup="checkPassword()">
                                                </div>
                                                <div class="alert alert-yellow alert-dismissible fade show" id="div_alerta" style="display: none;">
                                                    <div class="fs-14px"><i class="fa fa-info-circle"></i>
                                                        <b>INCORRECTO</b> La contraseña debe contener al menos una letra mayúscula(A), al menos una letra minúscula(b), al menos un número o caracter especial(1*), longitud mínima de 8 caracteres.
                                                    </div>
                                                </div>
                                        </section>
                                        <section class="col col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="addon-wrapping-left">Repita la Contraseña</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text"><i class="icon-append fa fa-key"></i></div>
                                                    <input type="password" id="repetir_clave" name="repetir_clave" class="form-control" placeholder="Repita Contraseña" aria-label="Repita Contraseña" aria-describedby="addon-wrapping-left" onkeyup="verificarPass()">
                                                </div>
                                                <div class="alert alert-yellow alert-dismissible fade show" id="div_alerta_iguales" style="display: none;">
                                                    <div class="fs-14px"><i class="fa fa-info-circle"></i>
                                                        <b>INCORRECTO</b> Las contraseñas no son iguales.
                                                    </div>
                                                </div>
                                        </section>
                                    </div>
                                <a id="buttomGuardar" type="submit" class="btn btn-primary w-100px me-5px" disabled="" onclick="javascript:actualizarPass()">Guardar</a>

                            </form>
                        </div>
                    </div>
                    <!-- END panel -->
                </div>
                <!-- END col-6 -->
            </div>
        </div>
        <!-- END #profile-post tab -->
        <!-- BEGIN #profile-about tab -->
        <div class="tab-pane fade" id="profile-about">
            <!-- BEGIN table -->
            <div class="table-responsive form-inline">

            </div>
            <!-- END table -->
        </div>
        <!-- END #profile-about tab -->
        <!-- BEGIN #profile-photos tab -->
        <div class="tab-pane fade" id="profile-photos" data-init="true">

        </div>
        <!-- END #profile-photos tab -->
        <!-- BEGIN #profile-videos tab -->
        <div class="tab-pane fade" id="profile-videos">
            <h4 class="mb-3">Videos (16)</h4>
            <!-- BEGIN row -->

            <!-- END row -->
        </div>
        <!-- END #profile-videos tab -->
        <!-- BEGIN #profile-friends tab -->
        <div class="tab-pane fade" id="profile-friends">
            <h4 class="mb-3">Friend List (14)</h4>
            <!-- BEGIN row -->

            <!-- END row -->
        </div>
        <!-- END #profile-friends tab -->
    </div>
    <!-- END tab-content -->
</div>
@endsection
@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function () {
    });
    function checkPassword() {
        var str = $('#clave_nueva').val();
        console.log(str);
        //        var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
        //        var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
        var re = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
        if (re.test(str)) {
            $('#div_alerta').hide();
        } else {
            $('#div_alerta').show();
        }
    }
    function verificarPass() {
        var nueva = $('#clave_nueva').val();
        var doble = $('#repetir_clave').val();
        if (nueva == doble) {
            $('#buttomGuardar').prop('disabled', false);
            $('#div_alerta_iguales').hide();
        } else {
            $('#buttomGuardar').prop('disabled', true);
            $('#div_alerta_iguales').show();
        }
    }
    function actualizarPass() {
        var parametros = {};
        parametros['nueva'] = $('#clave_nueva').val();
        parametros['doble'] = $('#repetir_clave').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('usuarios/actualizarPassword')}}",
            type: 'POST',
            data: {parametros: parametros},
            success: function (res) {
                location.reload();
            }
        });
    }

</script>
@stop