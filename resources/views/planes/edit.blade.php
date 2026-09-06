@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Planes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Planes</li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card card-primary">
        <div class="card-header">
            <i class="fas fa-credit-card"></i>
            Información de Planes
        </div>    
        <div class="card-body col-sm-12">
            <form action="{{URL::to('planes/'.$plan->id)}}" method="POST" autocomplete="false" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#basic" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#tax" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="true">Servicios</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade active show" id="basic" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                            <div class="row">
                                <section class="col col-sm-12">
                                    <div class="form-group">
                                        <label for="plan_name">Nombre del Plan</label>
                                        <input type="text" class="form-control text-uppercase" name="plan_name" id="plan_name" placeholder="Nombre del Plan" required value="{{$plan->name}}">                
                                    </div>
                                </section>
                                <section class="col col-sm-6">
                                    <div class="form-group">
                                        <label for="mensual">Precio Mensual</label>
                                        <input type="number" class="form-control" name="mensual" id="mensual" placeholder="$0.00" required value="{{$plan->month_price}}">                
                                    </div>
                                </section>
                                <section class="col col-sm-6">
                                    <div class="form-group">
                                        <label for="anual">Precio Anual</label>
                                        <input type="number" class="form-control" name="anual" id="anual" placeholder="$0.00" required value="{{$plan->year_price}}">                
                                    </div>
                                </section>
                                <hr class="my-10">
                                <section class="col col-sm-12">
                                    <div class="alert alert-primary">
                                        <strong>Colores!</strong> los siguientes colores van a determinar los colores de los Planes.
                                    </div>
                                </section>
                                <section class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="color_1">Color Cabecera</label>
                                        <input type="color" class="form-control" name="color_1" id="color_1" value="{{$plan->color_1}}">                
                                    </div>
                                </section>
                                <section class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="color_2">Color Cuerpo</label>
                                        <input type="color" class="form-control" name="color_2" id="color_2" value="{{$plan->color_2}}">                
                                    </div>
                                </section>
                                <section class="col col-sm-4">
                                    <div class="form-group">
                                        <label for="color_3">Color Botones</label>
                                        <input type="color" class="form-control" name="color_3" id="color_3" value="{{$plan->color_3}}">                
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                            <div class="form-group">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Estado</td>
                                            <td>Servicio</td>
                                            <td>Cantidad</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($service as $ser)
                                        <tr>
                                            <td>    
                                                <div class="custom-control custom-checkbox">
                                                    @if($ser['vista'])
                                                    <input class="custom-control-input" type="checkbox" id="check-{{$ser['id']}}" name="check-{{$ser['id']}}" value="{{$ser['id']}}" checked="">
                                                    @else
                                                    <input class="custom-control-input" type="checkbox" id="check-{{$ser['id']}}" name="check-{{$ser['id']}}" value="{{$ser['id']}}">
                                                    @endif
                                                    <label for="check-{{$ser['id']}}" class="custom-control-label">{{$ser['name']}}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="{{$ser['icon']}}"></i>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="cont-{{$ser['id']}}" name="cont-{{$ser['id']}}" placeholder="Cantidad de Mensajes" value="{{$ser['cantidad']}}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-lg float-right"><i class="fas fa-credit-card"></i> Editar</button>
                <button type="reset" class="btn btn-secondary btn-lg"><a href="/planes" style="color: white;"><i class="fas fa-arrow-left"></i> Cancelar</a></button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
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
</script>
@stop