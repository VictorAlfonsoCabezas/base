<div class="modal fade" id="modalHeader" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bots</h4>
                <input type="hidden" id="bot-header" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Ingrese un Nombre" />
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Desripción</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Detallemos el Objetivo de este bot" rows="2"></textarea>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Código de Campaña</label>
                        <textarea class="form-control" id="start_code" name="start_code" placeholder="Codigo de Inicio de Bot" rows="2"></textarea>
                        <small class="fs-12px text-gray-500-darker"> Cuando la conversación inicie con este Frase, va iniciar este BOT</small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-label">Home Codigo</label>
                                <input class="form-control" type="text" id="home_codigo" name="home_codigo" placeholder="" />
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Texto Home</label>
                                <input class="form-control" type="text" id="home_texto" name="home_texto" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="form-label">Back Codigo</label>
                                <input class="form-control" type="text" id="back_codigo" name="back_codigo" placeholder="" />
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Texto Back</label>
                                <input class="form-control" type="text" id="back_texto" name="back_texto" placeholder="" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <a onclick="javascript:saveHeader();" type="button" class="btn btn-primary">Guardar</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>