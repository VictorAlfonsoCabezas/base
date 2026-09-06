@extends('layouts.app')
@section('title')Home @stop
@section('breadcrumbs1')Dashboard Default @stop
@section('breadcrumbs2')Dashboard Default @stop
@section('custom_css')@stop
@section('content')
<div class="row">

    <div class="col-sm-12">

        <a href="#" class="widget-card rounded mb-20px" data-id="widget">
            <div class="widget-card-cover rounded" style="background-image: url(../assets/img/gallery/gallery-portrait-11-thumb.jpg)"></div>
            <div class="widget-card-content">
                <b class="text-white">{{$company->company_name}}</b>
            </div>
            <div class="widget-card-content bottom">
                <i class="fab fa-pushed fa-5x text-indigo"></i>
                <h4 class="text-white mt-10px"><b>{{$user->firstname . ' ' . $user->lastname}}<br> {{$user->username}}</b></h4>
                <h5 class="fs-12px text-white text-opacity-75 mb-0"><b>{{$user->email}}</b></h5>
            </div>
        </a>

    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@stop