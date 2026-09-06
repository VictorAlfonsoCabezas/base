@extends('layouts.app')
@section('custom_css_rules')@stop
@section('content')
<div  class="card card-primary shadow-lg bg-white rounded">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Fondo</h3>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_fondos" class="table table-bordered table-striped dataTable dtr-inline compact" role="grid" aria-describedby="example1_info">
                            <thead class="thead-primary" style="font-size: 10px;">
                                <tr role="row">
                                    <th scope="col">CÓDIGO</th>                            
                                    <th scope="col">Valor Inicial</th>
                                    <th scope="col">Valor Ingreso</th>
                                    <th scope="col">Valor Egreso</th>
                                    <th scope="col">Total</th>                    
                                    <th scope="col">Datos de Creación</th>                                    
                                    <th scope="col">Acción</th>                                    
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px;">
                                @foreach($fondos as $fondo)
                                <tr>
                                    <td>{{$fondo->code}}</td>
                                    <td>{{$fondo->valor_inicial}}</td>
                                    <td>{{$fondo->valor_ingreso}}</td>
                                    <td>{{$fondo->valor_egreso}}</td>
                                    <td>{{$fondo->valor_total}}</td>
                                    <td class="text-center">
                                        {{$fondo->date_created}}
                                        <p><small class="note">{{$fondo->hour_created}}</small>
                                    </td>
                                    <td class="text-center">

                                        <a onclick="agregarIngreso('{!! $fondo->id !!}')" class="badge badge-success" style="color: white">
                                            <i class="fas fa-plus"></i> Ingreso
                                        </a>
                                        <a onclick="agregarEgreso('{!! $fondo->id !!}')" class="badge badge-danger" style="color: white">
                                            <i class="fas fa-minus"></i> Egreso
                                        </a>
                                        <a onclick="verDetalles('{!! $fondo->id !!}')" class="badge badge-info" style="color: white">
                                            <i class="fas fa-eye"></i> Detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('fondo/modal_fondo')
@include('fondo/modal_detalles')
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $("#table_fondos").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print", "colvis"],
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "info": "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "Datos para Buscar",
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
            },
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $(document).ready(function () {

    });
    function agregarIngreso(id) {
        console.log('ingreso', id);
        $('#valor_fondo').val('');
        $('#observation').val('');
        $('#formulario_fondo').addClass('card-primary');
        $('#formulario_fondo').removeClass('card-danger');
        $('#typo_movimiento').html('Ingreso');
        $('#type_fondo').val('IN');
        $('#frmModalFondo').modal('show');
    }


    function agregarEgreso(id) {
        console.log('egreso', id);
        $('#valor_fondo').val('');
        $('#observation').val('');
        $('#formulario_fondo').addClass('card-danger');
        $('#formulario_fondo').removeClass('card-primary');
        $('#typo_movimiento').html('Engreso');
        $('#type_fondo').val('EG');
        $('#frmModalFondo').modal('show')
    }

    function guardarFondoTransaction() {
        if ($('#valor_fondo').val() != '' && $('#observation').val() != '') {

            Swal.fire({
                title: "Seguro de realizar esta transacción?",
                text: "¡Tu no podrás revertir esta operacion!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Aceptar"
            }).then(function (result) {
                if (result.value) {
                    loading();
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        method: "POST",
                        url: "{{URL::to('fondo/transacciones')}}",
                        data: $('#form_fondo_transacction').serialize()
                    }).done(function (res) {
                        $('#frmModalFondo').modal('hide')
                        stoploading();
                        location.reload();
                    });
                }
            });
        } else {
            Swal.fire('Debe ingresar un valor y una observación para realizar esta acción.');
        }

    }

    function verDetalles(id) {
        $.ajax({
            url: "{{URL::to('fondo/ver')}}/" + id,
            type: 'GET',
            success: function (res) {
                console.log(res);
                stoploading();
                if (res != '') {
                    var customers = '';
                    $.each(res, function (key, value) {
                        customers += '<tr>';
                        if (value.type_transaction_name == 'INGRESOS') {
                            customers += '     <td><span class="badge badge-info">' + value.type_transaction_name + '</span></td>';
                        } else {
                            customers += '     <td><span class="badge badge-danger">' + value.type_transaction_name + '</span></td>';

                        }
                        customers += '     <td>' + value.valor + '</td>';
                        customers += '     <td>' + value.user_created_name + '</td>';
                        customers += '     <td>' + value.observation_created + '</td>';
                        customers += '     <td class="text-center">' + value.date_created + '';
                        customers += '       <p><small class="note"> ' + value.hour_created + '</small>';
                        customers += '      </td>';
                        customers += '</tr>';
                    });
                    $('#fondo_detalle_table >tbody').html(customers);
                    $('#frmModalFondoDetalles').modal('show');
                }
            }
        });
    }
</script>
@stop
