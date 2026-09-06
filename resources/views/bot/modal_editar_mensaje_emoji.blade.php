<div class="modal fade" id="modalEditarMensajeEmoji" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="far fa-comment"></i> Texto Animado</h4>
                <input type="hidden" id="bot-header" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editarMensajeDetalle">
                <div class="mb-3">
                    <label for="mensajeIntencion" class="form-label">Sigcenter</label>
                    <textarea class="form-control" id="mensajeIntencionEmoji" rows="8"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="javascript:editarModalMensajeEmoji();" type="button" class="btn btn-primary">Guardar</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>