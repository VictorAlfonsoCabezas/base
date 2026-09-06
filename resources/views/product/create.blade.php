@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="card card-dark">
    <div class="card-header">
        Craer Productos
    </div>
    <div class="card-body col-sm-12">
        <form action="/product" method="POST" autocomplete="false" autocomplete="off" class="validate-form" enctype="multipart/form-data">
            @csrf
            <div class="row col col-sm-12">
                <section class="col col-sm-6">
                    <div class="form-group">
                        <label for="name">Nombre del Producto</label>
                        <input type="text" class="form-control text-uppercase" id="name" name="name"  placeholder="Nombre del Producto" required>
                    </div>
                </section>
                <section class="col col-sm-6">
                    <div class="form-group">
                        <label for="description">Descripcion Rápida</label>
                        <input type="text" class="form-control text-uppercase" id="description" name="description"  placeholder="description" required maxlength="50">
                    </div>
                </section>
                <section class="col col-sm-5">
                    <div class="form-group">
                        <label for="cate_yapa">Categoría</label>
                        <select type="text" id="cate_yapa" name="cate_yapa" class="form-control" required>
                            @foreach($layapa as $yapa)
                            <option value="{{$yapa->id}}" >{{$yapa->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </section>
                <section class="col-auto">
                    <a class="btn btn-primary mb-2"style="color: white; position: relative; top: 30px;" onclick="javascript:agregarCategoria();"><i class="fas fa-plus"></i> Agregar Categoría</a>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12">
                <section class="col col-sm-12">
                    <div class="form-group">
                        <label>Descripción Completa</label>
                        <textarea id="description_larga" name="description_larga" class="form-control" rows="3" placeholder="Descripción Completa" maxlength="1000" required=""></textarea>
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12">
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="unidad_id">Unidad</label>
                        <select type="text" id="unidad_id" name="unidad_id" class="form-control" required>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}" >{{$cat->title}}</option>
                            @endforeach
                        </select> 
                    </div>
                </section>
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="tipo_iva">Tipo de Iva</label>
                        <select type="text" id="tipo_iva" name="tipo_iva" class="form-control" required>
                            <option value="A" selected="">Con IVA</option>
                            <option value="B" >Sin IVA</option>
                        </select> 
                    </div>
                </section>
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select  class="form-control" id="tipo" name="tipo"  onchange="javascript:cambioTipo();">
                            <option value="P" selected="">PRODUCTO</option>
                            <option value="S" >SERVICIO</option>
                        </select> 
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col-sm-12">
                <section class="col col-sm-3" id="costo_producto">
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" class="form-control text-uppercase" id="costo" name="costo" step="0.01" placeholder="0.00" required  maxlength="6" value="0.00">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="precio_a">Precio A</label>
                        <input type="number" class="form-control text-uppercase" id="precio_a" name="precio_a" step="0.01" placeholder="0.00" required value="0.00">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="precio_b">Precio B</label>
                        <input type="number" class="form-control text-uppercase" id="precio_b" name="precio_b" step="0.01" placeholder="0.00" required value="0.00">
                    </div>
                </section>
                <section class="col col-sm-3" >
                    <div class="form-group">
                        <label for="precio_c">Precio C</label>
                        <input type="number" class="form-control text-uppercase" id="precio_c" name="precio_c" step="0.01"  placeholder="0.00" required value="0.00">
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12" id="precio_producto">                
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="stock_inicial">Stock Inicial</label>
                        <input type="number" class="form-control text-uppercase" id="stock_inicial" name="stock_inicial" step="1" placeholder="1" value="0">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="stock_minimo">Estock Minimo</label>
                        <input type="number" class="form-control text-uppercase" id="stock_minimo" name="stock_minimo" step="1" placeholder="1" value="0">
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12">
                <section class="col col-sm-6">
                    <div class="form-group col-md-12">
                        <label>Imagen Producto</label>
                        <div class="custom-file">
                            <input id="photo" type="file" class="custom-file-input"  onchange="$('#showImg').html(this.value)" name="photo" accept="image/*">
                            <label class="custom-file-label" for="validatedCustomFile" id="showImg">Elegir Archivo...</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="product-image">
                            <img src="{{ URL::asset('/img/sinimagenprod.jpg') }}" id="prevPhoto" class="img-thumbnail" style="width: 250px;">
                        </div>
                        <div class="note" id="prevPhotoText"></div>
                        <small class="note text-danger">Dimensiones de trabajo en <strong>Productos</strong> (300px X 200px)</small>
                    </div>
                </section>
                <section class="col col-sm-6">
                    <div class="form-group col-md-12">
                        <label>Imagen Venta</label>
                        <div class="custom-file">
                            <input id="photoVenta" type="file" class="custom-file-input"  onchange="$('#showImgVenta').html(this.value)" name="photoVenta" accept="image/*">
                            <label class="custom-file-label" for="validatedCustomFile" id="showImgVenta">Elegir Archivo...</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="product-image">
                            <img src="{{ URL::asset('/img/sinimagenprod.jpg') }}" id="prevPhotoVenta" class="img-thumbnail" style="width: 250px;">
                        </div>
                        <div class="note" id="prevPhotoTextVenta"></div>
                        <small class="note text-danger">Dimensiones de trabajo en <strong>Productos</strong> (300px X 400px)</small>
                    </div>
                </section>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-danger"><a href="/product" style="color: white;">Cancelar</a></button>
        </form>        
    </div>
</div>
@include('product/modal_categoria')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        cambioTipo();
        $("#photo").change(function () {
            readURL(this, '');
        });
        $("#photoVenta").change(function () {
            readURLVenta(this, '');
        });

        function readURL(input, tipo) {
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
        function readURLVenta(input, tipo) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileName = input.files[0].name;
                var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                var fileSize = input.files[0].size;
                var fileType = input.files[0].type;
                reader.onload = function (e) {
                    $('#prevPhotoVenta').attr('src', e.target.result);
                    $('#prevPhotoTextVenta').html("<span class='info'><b>Archivo para subir:</b> " + fileName + "<br> <b>Peso total:</b> " + fileSize + " bytes. <br><b>Tipo: </b>" + fileType + ",<br> <b>Extención:</b> " + fileExtension + "</span>");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    });

    function cambioTipo() {
        console.log($('#tipo').val());
        if ($('#tipo').val() == 'P') {
            $('#precio_producto').show();
            $('#costo_producto').show();
        } else {
            $('#precio_producto').hide();
            $('#costo_producto').hide();
        }
    }

    function agregarCategoria() {
        $('#formCategoriaModal').modal('show');
    }
    function agregarCategoriaBase() {
        var parametros = {};
        parametros['categoria'] = $('#categoria_layapa').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{URL::to('product/saveCateLayapa')}}",
            type: 'POST',
            data: {parametros: parametros},
            success: function (res) {
                if (res) {
                    console.log(res);
                    var selec = '';
                    $.each(res, function (index, value) {
                        selec += "<option value=" + value.id + ">" + value.title + "</option>";
                    });
                    $('#cate_yapa').html(selec);
                    $('#formCategoriaModal').modal('hide');
                }
            }
        });
    }
</script>

@stop