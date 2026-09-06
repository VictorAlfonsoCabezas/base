@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="card card-dark">
    <div class="card-header">
        Información de Categorias 
    </div>
    <div class="card-body col-sm-12">
        <form action="/category" method="POST" autocomplete="false" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="title">Nombre</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Nombre de la categoria" required>
                    </div>                     
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="description">Descripción</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Descripción" required>
                    </div>                     
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="type">Tipo de Categoria</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="1">ONIX</option>
                            <option value="2">LAYAPA</option>
                        </select>

                    </div>                     
                </section>

            </div>
            <div class="row col col-sm-12">
                <section>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Imagen</label>
                            <div class="custom-file">
                                <input id="photo" type="file" class="custom-file-input"  onchange="$('#showImg').html(this.value)" name="photo" accept="image/*">
                                <label class="custom-file-label" for="validatedCustomFile" id="showImg">Elegir Archivo...</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="product-image">
                                <img src="{{ URL::asset('/img/no-disponible.png') }}" id="prevPhoto" class="img-thumbnail" style="width: 300px;">
                            </div>
                            <div class="note" id="prevPhotoText"></div>
                            <small class="note text-danger">Dimensiones de trabajo en <strong>Categorias</strong> (370px X 250px)</small>
                        </div>
                    </div>
                </section>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-danger"><a href="/category" style="color: white;">Cancelar</a></button>
        </form>
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