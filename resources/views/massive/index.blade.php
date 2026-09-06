@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')

<div class="well">
    <div class="botonesSuperiores" style="margin-bottom: 5px;">
        <a id="agregarEvento" class="btn btn-labeled btn-primary header-btn btn-lg" href="{{URL::to('massive/create')}}">
            <span class="btn-label"><i class="fas fa-plus fa-xs"></i></span>
            Agregar Campaña Masiva
        </a>

    </div>
</div>
<div class="panel panel-inverse" data-sortable-id="table-basic-3">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Lista de Campañas</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-sm mb-0 text-inverse">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Titulo</th>
                        <th>Fecha Creación</th>
                        <th>Fechas de envíio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($masivoH as $masiv)
                    <tr>
                        <td>{{$masiv->id}}</td>
                        <td>{{$masiv->code}}</td>
                        <td>{{$masiv->mensajeName}}</td>                       
                        <td>{{$masiv->date_created}}</td>
                        <td>{{$masiv->dateSend}}</td>
                        <td>
                            <div class="col-6">
                                <div class="fs-18px mb-5px fw-bold">% <span data-animation="number" data-value="{{number_format ($masiv->porcentaje, 2)}}">{{number_format ($masiv->porcentaje, 2)}}</span></div>
                                <div class="progress h-5px rounded-3 bg-gray-900 mb-5px">
                                    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="{{number_format ($masiv->porcentaje, 2)}}%" style="width: 50%;"></div>
                                </div>
                            </div>
                        </td>
                        <td>{{$masiv->id}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function () {
    });


</script>
@stop