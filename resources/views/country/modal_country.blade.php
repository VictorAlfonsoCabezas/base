<div class="modal fade" id="modalCountry" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Países</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id_country">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control fs-15px" id="name" />
                            <label for="name" class="d-flex align-items-center fs-13px">
                                Nombre del País
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control fs-15px" id="iso" />
                            <label for="iso" class="d-flex align-items-center fs-13px">
                                ISO
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control fs-15px" id="code" />
                            <label for="code" class="d-flex align-items-center fs-13px">
                                Código
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
                <a onclick="javascript:saveCountry();" class="btn btn-primary">Guardar</a>
            </div>
        </div>
    </div>
</div>