@extends('layouts.app')
@section('title')Home @stop
@section('breadcrumbs1')Dashboard Agente @stop
@section('breadcrumbs2')Dashboard Agente @stop
@section('custom_css')
<style>
    #container {
        height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 1600px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
@stop
@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fab fa-whatsapp"></i></div>
            <div class="stats-info">
                <h4>WHATSAPP ENVIADOS</h4>
                <p>{{$mensajesEnviados}}</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-info">
            <div class="stats-icon"><i class="fa fa-comment"></i></div>
            <div class="stats-info">
                <h4>CHAT TOTALES</h4>
                <p>{{$chatTotales}}</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-orange">
            <div class="stats-icon"><i class="fa fa-comment"></i></div>
            <div class="stats-info">
                <h4>CHAT RESUELTOS</h4>
                <p>{{$chatResueltos}}</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="fas fa-money-bill"></i></div>
            <div class="stats-info">
                <h4>CHAT VENDIDOS</h4>
                <p>{{$chatVendidos}}</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-md-12">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        cargarGrafica();
    });

    function cargarGrafica() {
        $.ajax({
            url: "{{URL::to('home/graficaAgente')}}",
            type: 'GET',
            success: function(res) {
                if (res) {
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Gráfica envios diarios'
                        },
                        subtitle: {
                            text: 'Semanal actual'
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: -45,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Envios (unidades)'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Envios diarios: <b>{point.y:.0f} mensajes</b>'
                        },
                        series: [{
                            name: 'Population',
                            data: res,
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y:.0f}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });
                }
            }
        });


    }
</script>
@stop