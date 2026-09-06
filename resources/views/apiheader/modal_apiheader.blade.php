<div class="modal fade" id="modalApiHeader" tabindex="1" style="overflow:hidden;" aria-labelledby="PagoModalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear API</h4>
                <input type="hidden" id="company-api" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="idApi">
                    <div class="col-lg-6">
                        <label class="form-label">Seleccione el Sistema</label>
                        <select class="form-select" id="type_api" name="type_api" onchange="javascript:cambioSistema();">
                            <option disabled="" selected="">Seleccione un Sistema</option>
                            <option value="1">SIGCRM</option>
                            <option value="2">SIGCENTER</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-check mt-2 mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="need_table" name="need_table" checked>
                            <label class="form-check-label" for="flexCheckDefault">
                                Consulta de una tabla
                            </label>
                        </div>
                    </div>

                    <div id="table-select" class="col-lg-12">
                        <label class="form-label">Tabla</label>
                        <input class="form-control" type="text" id="table_name" name="table_name" placeholder="" />
                    </div>

                    <div class="col-lg-12">
                        <label class="form-label">Descripcion</label>
                        <input class="form-control" type="text" id="description" name="description" placeholder="Descripcion breve de la API" />
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label">Link</label>
                        <input class="form-control" type="text" id="api_link" name="api_link" placeholder="Link de acceso a la Api del SIGCRM" />
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Instancia</label>
                        <input class="form-control" type="text" id="instancia" name="description" placeholder="Instancia" />
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Token</label>
                        <input class="form-control" type="text" id="token" name="token" placeholder="Token" />
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Tipo Consulta</label>
                        <select class="form-select" id="tipo_consulta" name="tipo_consulta">
                            <option value="CONSULTA">CONSULTA</option>
                            <option value="INSERCION">INSERCION</option>
                            <option value="ACTUALIZACION">ACTUALIZACION</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label">Método</label>
                        <select class="form-select" id="method" name="method">
                            <option value="POST">POST</option>
                            <option value="GET">GET</option>
                            <option value="PUT">PUT</option>
                            <option value="DELETE">DELETE</option>
                            <option value="FETCH">FETCH</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="guardarApiheader();" class="btn btn-indigo btn-sm">Guardar API</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>