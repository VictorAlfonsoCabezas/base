@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')


<div class="card card-dark">
    <div class="card-header">
        Editar Productos
    </div>
    <div class="card-body col-sm-12">
        <form action="{{URL::to('product/'.$product->id)}}" method="POST" autocomplete="false" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row col col-sm-12">
                <section class="col col-sm-6">
                    <div class="form-group">
                        <label for="name">Nombre del Producto</label>
                        <input type="text" class="form-control text-uppercase" id="name" name="name"  placeholder="Nombre del Producto" required value="{{$product->name}}">
                    </div>
                </section>
                <section class="col col-sm-6">
                    <div class="form-group">
                        <label for="description">Descripcion Rápida</label>
                        <input type="text" class="form-control text-uppercase" id="description" name="description"  placeholder="description" required value="{{$product->description}}">
                    </div>
                </section>
                <section class="col col-sm-5">
                    <div class="form-group">
                        <label for="description">Categoría</label>
                        <select type="text" id="cate_yapa" name="cate_yapa" class="form-control" required>
                            @foreach($layapa as $yapa)
                            <option value="{{$yapa->id}}" {{($yapa->id == $product->category_product_id)?'selected=""':''}}>{{$yapa->title}}</option>
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
                        <textarea id="description_larga" name="description_larga" class="form-control" rows="3" placeholder="Descripción Completa" maxlength="1000" required="" value="">{{$product->description_larga}}</textarea>
                    </div>
                </section>
            </div>
            <div class="row col-sm-12">
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="unidad_id">Unidad</label>
                        <select type="text" id="unidad_id" name="unidad_id" class="form-control" required value="{{$product->unidad_id}}">
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}" {{($cat->id == $product->unit_measure_id)?'selected=""':''}}>{{$cat->title}}</option>
                            @endforeach
                        </select> 
                    </div>
                </section>
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="tipo_iva">Tipo de Iva</label>
                        <select type="text" id="tipo_iva" name="tipo_iva" class="form-control" required value="{{$product->tipo_iva}}">
                            <option value="A" {{($product->tipo_iva == 'A')?'selected=""':''}}>Con IVA</option>
                            <option value="B" {{($product->tipo_iva == 'B')?'selected=""':''}}>Sin IVA</option>
                        </select> 
                    </div>
                </section>
                <section class="col col-sm-4">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select type="text" id="tipo" name="tipo" class="form-control" onchange="javascript:cambioTipo();">
                            <option value="P" {{($product->tipo == 'P')?'selected=""':''}}>PRODUCTO</option>
                            <option value="S" {{($product->tipo == 'S')?'selected=""':''}}>SERVICIO</option>
                        </select> 
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col-sm-12">
                <section class="col col-sm-3" id="costo_producto">
                    <div class="form-group">
                        <label for="costo">Costo</label>
                        <input type="number" class="form-control text-uppercase" id="costo" name="costo" step="0.01" placeholder="0.00" required value="{{$product->costo}}">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="precio_a">Precio A</label>
                        <input type="number" class="form-control text-uppercase" id="precio_a" name="precio_a" step="0.01" placeholder="0.00" required value="{{$product->precio_a}}">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="precio_b">Precio B</label>
                        <input type="number" class="form-control text-uppercase" id="precio_b" name="precio_b" step="0.01" placeholder="0.00" required value="{{$product->precio_b}}">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="precio_c">Precio C</label>
                        <input type="number" class="form-control text-uppercase" id="precio_c" name="precio_c" step="0.01"  placeholder="0.00" required value="{{$product->precio_c}}">
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12" id="precio_producto">               
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="stock_inicial">Stock Inicial</label>
                        <input type="number" class="form-control" id="stock_inicial" name="stock_inicial" step="1" placeholder="1" value="{{$product->stock}}">
                    </div>
                </section>
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="stock_minimo">Estock Minimo</label>
                        <input type="number" class="form-control text-uppercase" id="stock_minimo" name="stock_minimo" step="1" placeholder="1" value="{{$product->stock_minimo}}">
                    </div>
                </section>
            </div>
            <hr class="my-10">
            <div class="row col col-sm-12">
                <section class="col col-sm-6">
                    <div class="form-group col-md-12">
                        <label>Imagen</label>
                        <div class="custom-file">
                            <input id="photo" type="file" class="custom-file-input"  onchange="$('#showImg').html(this.value)" name="photo" accept="image/*">
                            <label class="custom-file-label" for="validatedCustomFile" id="showImg">Elegir Archivo...</label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="product-image">
                            @if($product->photo !== null)
                            <img src="{{ URL::asset('/uploads/products/'.$product->photo) }}" title="" id="prevPhoto" class="img-thumbnail" style="width: 300px;"/><br/>
                            @else
                            <img src="{{ URL::asset('/img/sinimagenprod.jpg') }}"  title="" id="prevPhoto" class="img-thumbnail" style="width: 300px;"/><br/>
                            @endif
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
                            @if($product->photoVenta !== null)
                            <img src="{{ URL::asset('/uploads/products/'.$product->photoVenta) }}" title="" id="prevPhotoVenta" class="img-thumbnail" style="width: 300px;"/><br/>
                            @else
                            <img src="{{ URL::asset('/img/sinimagenprod.jpg') }}"  title="" id="prevPhotoVenta" class="img-thumbnail" style="width: 300px;"/><br/>
                            @endif
                        </div>
                        <div class="note" id="prevPhotoTextVenta"></div>
                        <small class="note text-danger">Dimensiones de trabajo en <strong>Productos</strong> (300px X 400px)</small>
                    </div>
                </section>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileName = input.files[0].name;
                var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                var fileSize = input.files[0].size;
                var fileType = input.files[0].type;
                reader.onload = function (e) {
                    console.log(e);
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
            console.log('P');
            $('#precio_producto').show();
            $('#costo_producto').show();
        } else {
            console.log('S');
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