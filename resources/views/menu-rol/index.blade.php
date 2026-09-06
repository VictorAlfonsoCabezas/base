@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje')
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Menús - Rol</h3>
            </div>
            <div class="box-body">
                @csrf
                <table class="table table-striped table-bordered table-hover" id="tabla-data">
                    <thead>
                        <tr>
                            <th>Menú</th>
                            @foreach ($rols as $id => $nombre)
                            <th class="text-center">{{$nombre}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $key => $menu)
                        @if ($menu["menu_id"] != 0)
                        @break
                        @endif
                        <tr>
                            <td class="font-weight-bold"><i class="fa fa-arrows-alt"></i> {{$menu["nombre"]}}</td>
                            @foreach($rols as $id => $nombre)
                            <td class="text-center">
                                <input
                                    type="checkbox"
                                    class="menu_rol"
                                    name="menu_rol[]"
                                    data-menuid={{$menu[ "id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$menu["id"]], "id"))? "checked" : ""}}>
                            </td>
                            @endforeach
                        </tr>
                        @foreach($menu["submenu"] as $key => $hijo)
                        <tr>
                            <td class="pl-20"><i class="fa fa-arrow-right"></i> {{ $hijo["nombre"] }}</td>
                            @foreach($rols as $id => $nombre)
                            <td class="text-center">
                                <input
                                    type="checkbox"
                                    class="menu_rol"
                                    name="menu_rol[]"
                                    data-menuid={{$hijo[ "id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo["id"]], "id"))? "checked" : ""}}>
                            </td>
                            @endforeach
                        </tr>
                        @foreach ($hijo["submenu"] as $key => $hijo2)
                        <tr>
                            <td class="pl-30"><i class="fa fa-arrow-right"></i> {{$hijo2["nombre"]}}</td>
                            @foreach($rols as $id => $nombre)
                            <td class="text-center">
                                <input
                                    type="checkbox"
                                    class="menu_rol"
                                    name="menu_rol[]"
                                    data-menuid={{$hijo2[ "id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo2["id"]], "id"))? "checked" : ""}}>
                            </td>
                            @endforeach
                        </tr>
                        @foreach ($hijo2["submenu"] as $key => $hijo3)
                        <tr>
                            <td class="pl-40"><i class="fa fa-arrow-right"></i> {{$hijo3["nombre"]}}</td>
                            @foreach($rols as $id => $nombre)
                            <td class="text-center">
                                <input
                                    type="checkbox"
                                    class="menu_rol"
                                    name="menu_rol[]"
                                    data-menuid={{$hijo3[ "id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$hijo3["id"]], "id"))? "checked" : ""}}>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                        @endforeach
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scripts')
<script type="text/javascript">
    $('.menu_rol').on('change', function () {
        var data = {
            menu_id: $(this).data('menuid'),
            rol_id: $(this).val(),
            _token: $('input[name=_token]').val()
        };
        if ($(this).is(':checked')) {
            data.estado = 1
        } else {
            data.estado = 0
        }
        ajaxRequest('menu-rol', data);
    });
    function ajaxRequest(url, data) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (respuesta) {
                MensajeVerde.notificaciones(respuesta.respuesta, 'ONIX', 'success');
            }
        });
    }
</script>
@stop
