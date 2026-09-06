<div class="modal fade" id="modalIntenciones" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-hand-pointer"></i> Intenciones</h4>
                <input type="hidden" id="bot-header" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-muted" id="objetivoIntencionTexto">
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <label class="form-label">Intención del mensaje</label>
                        <div id="select-option-modal">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="javascript:cambioOption();" type="button" class="btn btn-primary">Guardar</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>