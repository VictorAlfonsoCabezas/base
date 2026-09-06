<div class="modal fade" id="modalFile" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-file"></i> Multimedia</h4>
                <input type="hidden" id="bot-header" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="detalleModalId">
                <div class="modal-body">
                    <form id="formFile" class="needs-validation" novalidate enctype='multipart/form-data'>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Archivo (Imagen, Audio o Video)</label>
                            <input class="form-control" type="file" id="fileOne" name="fileOne" accept="image/png, image/jpeg, video/mp4, audio/mp3">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="javascript:guardarArchivo();" type="button" class="btn btn-primary">Guardar</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>