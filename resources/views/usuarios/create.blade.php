@extends('layouts.app')
@section('title')Usuarios @stop
@section('breadcrumbs1')Crear Usuarios @stop
@section('breadcrumbs2')Crear Usuarios @stop
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
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <form data-parsley-validate="true" action="/usuarios" method="POST" autocomplete="false" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label" for="firstname">Nombre</label>
                    <input class="form-control text-uppercase" type="text" name="firstname" id="firstname" placeholder="Escribe el Nombre" data-parsley-required="true">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="lastname">Apellido</label>
                    <input class="form-control text-uppercase" type="text" name="lastname" id="lastname" placeholder="Escribe el Apellido" onblur="darName();" data-parsley-required="true">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="username">Usuario</label>
                    <input class="form-control" type="text" name="username" id="username" placeholder="Automático" readonly="" data-parsley-required="true">
                    <small>Automático</small>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Automático" readonly="" data-parsley-required="true">
                    <small>Contraseña es igual al Usuario</small>
                </div>
            </div>
            <hr class="my-10">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label" for="ruc">RUC / Cédula</label>
                    <input class="form-control" type="text" name="ruc" id="ruc" placeholder="RUC" data-parsley-required="true">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="ruc">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Ingrese el Email" data-parsley-required="true">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="rol">ROL</label>
                    <select class="form-select" name="rol" id="rol" data-parsley-required="true">
                        <option value="">- Elija un Rol -</option>
                        @foreach($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr class="my-10">
            <div class="row">
                <label class="form-label" for="rol">Empresa Pertenece</label>
                <select class="form-control" id="empresa" name="empresa[]" multiple="multiple" style="width: 100%;" data-parsley-required="true">
                    <optgroup label="Empresas del Sistema">
                        <option value="" disabled="">- Elija una Empresa -</option>
                        @foreach($empresa as $emp)
                        <option value="{{$emp->id}}">{{$emp->company_name}}</option>
                        @endforeach
                    </optgroup>
                </select>
                <small>Puede seleccionar varias empresas *</small>
            </div>
            <hr class="my-10">
            <div class="row">
                <div class="col-md-8">
                    <label for="formFile" class="form-label">Elegir Archivo...</label>
                    <input class="form-control" id="photo" type="file" class="custom-file-input" onchange="$('#showImg').html(this.value)" name="photo" accept="image/*">
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <img class="card-img-top" src="{{ URL::asset('/img/sinusuario.jpg') }}" alt="" id="prevPhoto" style="width: 200px;">
                        <div class="card-body">
                            <p class="card-text" id="prevPhotoText"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label form-label">&nbsp;</label>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="/usuarios" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#empresa").select2({
            placeholder: "Seleccione una Empresa"
        });
        $("#photo").change(function () {
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileName = input.files[0].name;
                var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                var fileSize = input.files[0].size;
                var fileType = input.files[0].type;
                reader.onload = function (e) {
                    $('#prevPhoto').attr('src', e.target.result);
                    $('#prevPhotoText').html("<span class='info'><b>Archivo para subir:</b> " + fileName + "<br> <b>Peso total:</b> " + fileSize + " bytes. <br><b>Tipo: </b>" + fileType + ",<br> <b>Extención:</b> " + fileExtension + "</span>");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
    function darName() {
        var nombre = $('#firstname').val();
        var apellido = $('#lastname').val();
        $.ajax({
            url: "{{URL::to('usuarios/darUsername')}}/" + nombre + '/' + apellido,
            type: 'GET',
            success: function (res) {
                $('#username').val(res);
                $('#password').val(res);
            }
        });
    }
</script>
@stop