@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="card card-dark">
    <div class="card-header">
        Información de Categorias 
    </div>
    <form action="{{URL::to('category/'.$value->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="card-body col-sm-12">
            <div class="row">
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="title">Nombre</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Nombre de la categoria" required value="{{$value->title}}">
                    </div>                     
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="description">Descripción</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Descripción" required value="{{$value->description}}">
                    </div>                     
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label form="type">Tipo de Categoria</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="1" {{($value->type==1)?'selected=""':''}}>ONIX</option>
                            <option value="2" {{($value->type==2)?'selected=""':''}}>LAYAPA</option>
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
                                @if($value->photo !== null)
                                <img alt="{{$value->title}}" src="{{ URL::asset('/uploads/categories/'.$value->photo) }}" title="{!! $value->title !!}" id="prevPhoto" class="img-thumbnail" style="width: 300px;"/><br/>
                                @else
                                <img alt="{{$value->title}}" src="{{ URL::asset('/img/no-disponible.png') }}"  title="{!! $value->title !!}" id="prevPhoto" class="img-thumbnail" style="width: 300px;"/><br/>
                                @endif
                            </div>
                            <div class="note" id="prevPhotoText"></div>
                            <small class="note text-danger">Dimensiones de trabajo en <strong>Categorias</strong> (370px X 250px)</small>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a class="btn btn-danger" href="/category" style="color: white;">Volver</a>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#form-company").validate({
            errorPlacement: function (error, element) {
//                error.insertAfter(element.parent());
            }
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

        $("#electronicaS").change(function () {
            if ($('#electronicaS').is(":checked")) {
                $('#electronica').val(1);
            } else {
                $('#electronica').val(0);
            }
        });

        $("#conexionS").change(function () {
            if ($('#conexionS').is(":checked")) {
                $('#conexion').val(1);
            } else {
                $('#conexion').val(0);
            }
        });
    });
</script>
@stop