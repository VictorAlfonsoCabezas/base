@extends('layouts.app')
@section('title')Regiones @stop
@section('breadcrumbs1')Regiones @stop
@section('breadcrumbs2')Regiones @stop
@section('custom_css') @stop
@section('content')







<div class="mb-3 d-md-flex fw-bold">
    <div class="mt-md-0 mt-2"><a href="#" class="text-decoration-none text-dark"><i class="fa fa-print fa-fw me-1 text-dark text-opacity-50"></i> Print</a></div>
    <div class="ms-md-4 mt-md-0 mt-2"><a href="#" class="text-decoration-none text-dark"><i class="fa fa-boxes-stacked fa-fw me-1 text-dark text-opacity-50"></i> Restock items</a></div>
    <div class="ms-md-4 mt-md-0 mt-2"><a href="#" class="text-decoration-none text-dark"><i class="fa fa-pen fa-fw me-1 text-dark text-opacity-50"></i> Edit</a></div>
    <div class="ms-md-4 mt-md-0 mt-2 dropdown-toggle">
        <a href="#" data-bs-toggle="dropdown" class="text-decoration-none text-dark text-opacity-75"><i class="fa fa-cog fa-fw me-1 text-dark text-opacity-50"></i> More Actions <b class="caret"></b></a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div role="separator" class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
        </div>
    </div>
</div>
<div class="row gx-4">




    <div class="col-lg-4">

        <div class="card border-0">
            <ul class="nav nav-tabs mb-0" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#nav-pills-tab-1" data-bs-toggle="tab" class="nav-link px-3 active" aria-selected="true" role="tab">
                        <span class="d-sm-none">Pills 1</span>
                        <span class="d-sm-block d-none">Atendiendo</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#nav-pills-tab-2" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                        <span class="d-sm-none">Pills 2</span>
                        <span class="d-sm-block d-none">Finalizados</span>
                    </a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content p-3 rounded-top panel rounded-0 m-0" style="overflow-y: scroll;height: 105vh;">
                    <div class="input-group mb-0">
                        <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"><span class="d-none d-md-inline">Filter orders</span><span class="d-inline d-md-none"><i class="fa fa-credit-card"></i></span> <b class="caret"></b></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 start-0" style="z-index: 1;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control px-35px bg-light" placeholder="Search orders...">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade active show" id="nav-pills-tab-1" role="tabpanel">
                        <div class="card-body p-3 text-dark fw-bold">

                            <div class="row align-items-center">
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="h-65px w-65px d-flex align-items-center justify-content-center position-relative">
                                        <img src="../assets/img/user/sinfoto.jpg" class="mw-100 mh-100">
                                        <span class="w-20px h-20px p-0 d-flex align-items-center justify-content-center badge bg-primary text-white position-absolute end-0 top-0 fw-bold fs-12px rounded-pill mt-n2 me-n2">1</span>
                                    </div>
                                    <div class="ps-3 flex-1">
                                        <div><a href="#" class="text-decoration-none text-dark">iPhone 13 Pro Max</a></div>
                                        <div class="text-dark text-opacity-50 small fw-bold">
                                            SKU: IP13PROMAX-512
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 m-0 ps-lg-3">
                                    $999 x 1
                                </div>
                                <div class="col-lg-2 text-dark fw-bold m-0 text-end">
                                    $999
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="h-65px w-65px d-flex align-items-center justify-content-center position-relative">
                                        <img src="../assets/img/user/sinfoto.jpg" class="mw-100 mh-100">
                                        <span class="w-20px h-20px p-0 d-flex align-items-center justify-content-center badge bg-primary text-white position-absolute end-0 top-0 fw-bold fs-12px rounded-pill mt-n2 me-n2">1</span>
                                    </div>
                                    <div class="ps-3 flex-1">
                                        <div class=""><a href="#" class="text-decoration-none text-dark">Macbook Pro 2020</a></div>
                                        <div class="text-dark text-opacity-50 small fw-bold">
                                            SKU: MACBOOKPRO-1TB
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 m-0 ps-lg-3">
                                    $1,999 x 1
                                </div>
                                <div class="col-lg-2 text-dark fw-bold m-0 text-end">
                                    $1,999
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="h-65px w-65px d-flex align-items-center justify-content-center position-relative">
                                        <img src="../assets/img/user/sinfoto.jpg" class="mw-100 mh-100">
                                        <span class="w-20px h-20px p-0 d-flex align-items-center justify-content-center badge bg-primary text-white position-absolute end-0 top-0 fw-bold fs-12px rounded-pill mt-n2 me-n2">1</span>
                                    </div>
                                    <div class="ps-3 flex-1">
                                        <div class=""><a href="#" class="text-decoration-none text-dark">Apple Watch 5</a></div>
                                        <div class="text-dark text-opacity-50 small fw-bold">
                                            SKU: APPLEWATCHBLACK
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 m-0 ps-lg-3">
                                    $599 x 1
                                </div>
                                <div class="col-lg-2 text-dark fw-bold m-0 text-end">
                                    $599
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="nav-pills-tab-2" role="tabpanel">
                        <h3 class="mt-10px">Nav Pills Tab 2</h3>
                        <p>
                            test2
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 mb-4">
            <div class="card-header bg-none p-4 h6 m-0 d-flex align-items-center">
                <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                Products (3)
                <a href="#" class="ms-auto text-decoration-none text-gray-500"><i class="fa fa-truck fa-lg me-1"></i> Add Tracking Link</a>
            </div>
            <div class="card-body p-3 text-dark fw-bold" style="overflow-y: scroll;height: 100vh;">

            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card border-0 mb-4">
            <div class="card-header bg-none p-4 h6 m-0 d-flex align-items-center">
                Perfil
                <a href="#" class="ms-auto text-decoration-none text-gray-500">Edit</a>
            </div>
            <div class="card-body fw-bold" style="overflow-y: scroll;height: 100vh;">
                <i class="fa fa-phone fa-fw"></i> +916-663-4289<br><br>
                867 Highland View Drive<br>
                Newcastle, CA<br>
                California<br>
                95658<br>
            </div>
        </div>
    </div>
</div>



<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">Lista de Regiones</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <ul id="ioniconsTab" class="nav nav-pills mb-3">
            <li class="nav-item">
                <a onclick="javascript:modalRegion(0);" class="nav-link active d-flex align-items-center">
                    <i class="ion-md-add-circle-outline fa-lg"></i>
                    <span class="d-none d-lg-inline ms-2">Crear</span>&nbsp;
                </a>
            </li>
        </ul>
        <hr class="bg-gray-500" />
        <table id="table-region" class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th class="text-nowrap">Nombres</th>
                    <th class="text-nowrap">Código</th>
                    <th class="text-nowrap">País</th>
                    <th data-orderable="false">Estado</th>
                    <th data-orderable="false">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($regions as $region)
                <tr id='{{$region->id}}'>
                    <td width="1%">{{$region->id}}</td>
                    <td>{{$region->name}}</td>
                    <td>{{$region->code}}</td>
                    <td>{{$region->country->name}}</td>
                    <td class="text-center">
                        @if($region->id)
                        <span class="badge bg-blue rounded-pill">Activo</span>
                        @else
                        <span class="badge bg-red rounded-pill">Activo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a onclick="javascript:modalRegion('{!!$region->id!!}');" class="btn btn-outline-blue btn-circle btn-xs">
                            <i class="ion ion-md-create "></i>
                        </a>
                         <a class="btn btn-outline-red btn-circle btn-xs">
                            <i class="ion ion-md-trash "></i>
                        </a> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('region/modal_region')
@endsection
@section('scripts')


<script type="text/javascript">
    $(document).ready(function () {
        $("#table-region").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de MAX registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar MENU registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Busqueda:",
                "searchPlaceholder": "Datos para buscar",
                "zeroRecords": "No se han encontrado coincidencias.",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": "Ordenación ascendente",
                    "sortDescending": "Ordenación descendente"
                }
            }
        });
    });

    function modalRegion(id) {
        if (id !== 0) {
            $.ajax({
                url: "{{URL::to('region')}}/" + id + "/edit",
                type: 'GET',
                success: function (res) {
                    $('#name').val(res.name);
                    $('#country_id').val(res.country_id);
                    $('#code').val(res.code);
                    $('#id_region').val(res.id);
                    $('#modalRegion').modal('show');
                }
            });
        } else {
            $('#name').val('');
            $('#country_id').val(59);
            $('#code').val('');
            $('#id_region').val(0);
            $('#modalRegion').modal('show');
        }
    }

    function saveRegion() {
        var name = $('#name').val();
        var country_id = $('#country_id').val();
        var code = $('#code').val();
        if ($('#id_region').val() == 0) {
            var method = 'POST';
            var url = "{{URL::to('region')}}";
        } else {
            var method = 'PUT';
            var url = "{{URL::to('region')}}/" + $('#id_region').val();
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: method,
            data: {
                name: name,
                country_id: country_id,
                code: code,
            },
            success: function (res) {
                if (res) {
                    location.reload();
                }
            }
        });
    }
</script>
@stop