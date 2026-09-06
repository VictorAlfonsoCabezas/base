@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div class="card card-dark">
    <div class="card-header">
        Roles
    </div>
    <div class="card-boby col-sm-12">
        <form action="/rol" method="POST"autocomplete="false">
            @csrf
            <div class="row">
                <section class="col col-sm-3">
                    <div class="form-group">
                        <label for="nombre">Rol</label> 
                        <input type="text" class="form-control text-uppercase" name="nombre" id="nombre" placeholder="Rol" required maxlength="15">
                    </div>
                </section>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-danger"><a href="/rol" style="color: white;">Cancelar</a></button>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>
@stop