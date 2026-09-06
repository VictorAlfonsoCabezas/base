<div class="modal fade" id="frmModalFondo" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="formulario_fondo" class="card">
                    <div class="card-header">
                        <h4 class="modal-title"><b id="typo_movimiento"></b> del fondo</h4>
                    </div>
                    <div class="card-body">
                        <form id="form_fondo_transacction" autocomplete="false" autocomplete="off" class="validate-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type_fondo" id="type_fondo" value="0">
                            <div class="row col col-sm-12">
                                <section class="col col-sm-6">
                                    <div class="form-group">
                                        <label for="description">Valor a Depositar</label>
                                        <input type="number" class="form-control text-uppercase" id="valor_fondo" name="valor_fondo"  step="0.01" placeholder="0.00" required="" style="height: 86px;font-size: 50px;color: blue;">
                                    </div>
                                </section>
                                <section class="col col-sm-6">
                                    <div class="form-group">
                                        <label>Observación</label>
                                        <textarea id="observation" name="observation" class="form-control" rows="3" placeholder="Si existe alguna observación, puede ingresarla en este apartado" maxlength="1000"></textarea>
                                    </div>
                                </section>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <a type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                                <a type="button" class="btn btn-primary" href="javascript:guardarFondoTransaction()" style="color: white">Guardar</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 