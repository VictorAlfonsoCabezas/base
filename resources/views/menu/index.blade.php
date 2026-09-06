@extends('layouts.app')
@section('title')Menus @stop
@section('breadcrumbs1')Menu @stop
@section('breadcrumbs2')Menu @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Menús</h4>
        <div class="panel-heading-btn">
            <a
                href="javascript:;"
                class="btn btn-xs btn-icon btn-default"
                data-toggle="panel-expand"
                ><i class="fa fa-expand"></i
                ></a>
            <a
                href="javascript:;"
                class="btn btn-xs btn-icon btn-success"
                data-toggle="panel-reload"
                ><i class="fa fa-redo"></i
                ></a>
            <a
                href="javascript:;"
                class="btn btn-xs btn-icon btn-warning"
                data-toggle="panel-collapse"
                ><i class="fa fa-minus"></i
                ></a>
            <a
                href="javascript:;"
                class="btn btn-xs btn-icon btn-danger"
                data-toggle="panel-remove"
                ><i class="fa fa-times"></i
                ></a>
        </div>
    </div>
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body">
        @include('includes.mensaje')
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <!--                <a
                                    href="{{route('crear_menu')}}"
                                    class="nav-link active d-flex align-items-center"
                                    >
                                    <i class="ion-md-add-circle-outline fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-2">Agregar Menu</span>&nbsp;
                                </a>-->
                <a href="javascript:abrirMenus();" class="nav-link active d-flex align-items-center" >
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Agregar Menu</span>&nbsp;
                </a>
            </li>
        </ul>
        @csrf
        <div class="dd" id="nestable">
            <ol class="dd-list">
                @foreach ($menus as $key => $item)
                @if ($item["menu_id"] != 0)
                @break
                @endif
                @include("menu.menu-item",["item" => $item])
                @endforeach
            </ol>
        </div>
    </div>
</div>
@include('menu/modal_menus')
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        console.log('holaaaaa');
        $('#nestable').nestable().on('change', function () {
            console.log('entraaaa');
            const data = {
                menu: window.JSON.stringify($('#nestable').nestable('serialize')),
                _token: $('input[name=_token]').val()
            };
            $.ajax({

                url: '{{URL("menu/guardar-orden")}}',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function (respuesta) {
                }
            });
        });
        $('.eliminar-menu').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: '¿ Está seguro que desea eliminar el registro ?',
                text: "Esta acción no se puede deshacer!",
                icon: 'warning',
                buttons: {
                    cancel: "Cancelar",
                    confirm: "Aceptar"
                },
            }).then((value) => {
                console.log(value);
                if (value) {
                    window.location.href = url;
                }
            });
        })
        $('#nestable').nestable('expandAll');
        $('#icono').on('blur', function () {
            console.log($(this).val());
            $('#mostrar-icono').removeClass().addClass('fas ' + $(this).val() + ' fa-7x');
            // $('#mostrar-icono').removeClass().addClass('fa fa-fw ' + $(this).val());
        });
    });
    function abrirMenus() {
        $('#edit_menu').val(0);
        $('#modalMenus').modal('show');
    }
    function guardarMenu() {
        var idEdit = $('#edit_menu').val();
        var url = '';
        var parametros = {};
        parametros['nombre'] = $('#nombre').val();
        parametros['url'] = $('#url').val();
        parametros['icono'] = $('#icono').val();
        if (idEdit != 0) {
            url = "{{URL::to('menu/update-nemu')}}";
            parametros['edit_menu'] = $('#edit_menu').val();
        } else {
            url = "{{URL::to('menu/guardar-nuevo')}}";
        }
        console.log(parametros);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: "POST",
            url: url,
            data: {parametros: parametros},
        }).done(function (res) {
            console.log(res);
            $('#modalMenus').modal('hide');
            location.reload();

        });
    }
    function editarMenu(id) {
        console.log(id);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{URL::to('menu/datos-menu')}}/" + id,
            method: "GET",
        }).done(function (res) {
            console.log(res);
            $('#edit_menu').val(id);
            $('#nombre').val(res.nombre);
            $('#url').val(res.url);
            $('#icono').val(res.icono);
            $('#modalMenus').modal('show');
        });

    }
</script>
@endsection

