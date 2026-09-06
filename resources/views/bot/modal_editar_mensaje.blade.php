<div class="modal fade" id="modalEditarMensaje" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-comment"></i> Editar Mensaje</h4>
                <input type="hidden" id="bot-header" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editarMensajeDetalle">
                <div class="row">
                    <div class="col-md-8">
                        <select class="form-select select2-variable-personalized" id="select-variable-personalized">
                            <option selected="" disabled>--Elije una variable--</option>
                            <option value="customer.name">Nombre Conocido</option>
                            <option value="customer.nombres">Nombres</option>
                            <option value="customer.apellidos">Apellidos</option>
                            <option value="customer.numero_documento">Numero de Documento</option>
                            <option value="customer.direccion">Nombre del Cliente</option>
                            <option value="customer.telefono">Telñefono FIjo</option>
                            <option value="customer.celular_1">Celular 1</option>
                            <option value="customer.celular_2">Celular 2</option>
                            <option value="customer.celular_3">Celular 3</option>
                            <option value="customer.correo">Correo</option>
                            <option value="customer.birth_date">Fecha de Nacimiento</option>
                            <option value="customer.nationality">Nacionalidad</option>
                            <option value="customer.sex">Sexo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a onclick="javascript:agregarVariable(' + id + ');" class="btn btn-green"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="mensajeIntencion" class="form-label">Sigcenter</label>
                    <textarea class="form-control" id="mensajeIntencion" rows="8"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a onclick="javascript:editarModalMensaje();" type="button" class="btn btn-primary">Guardar</a>
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>