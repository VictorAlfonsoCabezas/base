@extends('layouts.app')
@section('title')Suscripciones @stop
@section('breadcrumbs1')Suscripciones @stop
@section('breadcrumbs2')Suscripciones @stop
@section('custom_css') @stop
@section('content')
<div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Suscripciones</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body">
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <a href="" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Botones</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-suscription" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Empresa</th>
                    <th class="text-nowrap">Plan</th>
                    <th class="text-nowrap">Fecha Creación</th>
                    <th class="text-nowrap">Fecha Finalización</th>
                    <th data-orderable="false">Renovación</th>
                    <th data-orderable="false">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suscription as $sus)
                <tr id='{{$sus->id}}'>
                    <td width="1%">{{$sus->id}}</td>
                    <td>{{$sus->company_id}}</td>
                    <td>{{$sus->plan_id}}</td>
                    <td>{{$sus->date_created}}</td>
                    <td>{{$sus->date_finish}}</td>
                    <td>{{$sus->renewall}}</td>
                    <td>{{$sus->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-suscription').DataTable();
    });
</script>
@stop