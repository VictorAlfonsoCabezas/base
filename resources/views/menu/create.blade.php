@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>
            <h4><i class="icon fa fa-ban"></i>El Formulario contiene errores.</h4>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session("mensaje"))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>
            <h4><i class="icon fa fa-check"></i>Mensaje de Sistema Onix.</h4>
            <ul>
                <li>{{ session("mensaje") }}</li>
            </ul>
        </div>
        @endif
        <div class="box box-danger">
            <h3 class="box-title">Crear Menus</h3>
        </div>
        <form action="{{route('menu.store')}}" method="POST">
            @csrf
            <div class="box-body">
                @include('menu.form')
            </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>
            </div>
    </div>
</form>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#icono').on('blur', function () {
            console.log($(this).val());
            $('#mostrar-icono').removeClass().addClass($(this).val());
            // $('#mostrar-icono').removeClass().addClass('fa fa-fw ' + $(this).val());
        });
    });
</script>
@stop
