@extends('layouts.app')
@section('title')Home @stop
@section('breadcrumbs1')Dashboard @stop
@section('breadcrumbs2')Dashboard @stop
@section('custom_css')@stop
@section('content')
<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">EMPRESAS</div>
                <div class="stats-number">{{$totalEmpresas}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 70.1%;"></div>
                </div>
                <div class="stats-desc">Better than last week (70.1%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">USUARIOS</div>
                <div class="stats-number">{{$usuariosTotales}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 40.5%;"></div>
                </div>
                <div class="stats-desc">Better than last week (40.5%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon stats-icon-lg"><i class="fab fa-whatsapp fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">WHASTAPP ENVIADOS</div>
                <div class="stats-number">{{$mensajesEnviados}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 76.3%;"></div>
                </div>
                <div class="stats-desc">Better than last week (76.3%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-gray-900">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">CHAT TOTALES</div>
                <div class="stats-number">{{$chatTotales}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 54.9%;"></div>
                </div>
                <div class="stats-desc">Better than last week (54.9%)</div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@stop