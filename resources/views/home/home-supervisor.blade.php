@extends('layouts.app')
@section('title')Home @stop
@section('breadcrumbs1')Dashboard Supervisor @stop
@section('breadcrumbs2')Dashboard Supervisor @stop
@section('custom_css')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 1620px;
        max-width: 800px;
        margin: 1em auto;
    }

    #container {
        height: 400px;
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
        <div class="widget widget-stats bg-teal">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">AGENTES</div>
                <div class="stats-number">{{$usuarioAgentes}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 70.1%;"></div>
                </div>
                <div class="stats-desc">Better than last week (70.1%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon stats-icon-lg"><i class="fab fa-whatsapp fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">WHATSAPP TOTALES</div>
                <div class="stats-number">{{$mensajesTotales}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 40.5%;"></div>
                </div>
                <div class="stats-desc">Better than last week (40.5%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-indigo">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-comment fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">CONVERSACIONES TOTALES</div>
                <div class="stats-number">{{$conversacionesTotales}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 76.3%;"></div>
                </div>
                <div class="stats-desc">Better than last week (76.3%)</div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-gray-900">
            <div class="stats-icon stats-icon-lg"><i class="fas fa-money-bill fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">CONVERSACIONES VENDIDOS</div>
                <div class="stats-number">{{$conversacionesVendidas}}</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 54.9%;"></div>
                </div>
                <div class="stats-desc">Better than last week (54.9%)</div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12">
        <figure class="highcharts-figure">
            <div id="container"></div>
    </div>
    </figure>

</div>

@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        cargarGrafica();
    });

    function cargarGrafica() {
        $.ajax({
            url: "{{URL::to('home/graficaAgenteSupervisor')}}",
            type: 'GET',
            success: function(res) {
                if (res) {
                    console.log(res);
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            align: 'left',
                            text: 'Gráficas anules de envio de mensajes'
                        },
                        subtitle: {
                            align: 'left',
                            text: 'Anual'
                        },
                        accessibility: {
                            announceNewData: {
                                enabled: true
                            }
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Cantidades por por mes y por agente'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.0f}'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> total<br/>'
                        },

                        series: [{
                            name: "Mensual",
                            colorByPoint: true,
                            data: res.mesesTotales
                        }],
                        drilldown: {
                            breadcrumbs: {
                                position: {
                                    align: 'right'
                                }
                            },
                            series: res.mesesIndividual
                        }
                    });
                }
            }
        });
    }
</script>
@stop