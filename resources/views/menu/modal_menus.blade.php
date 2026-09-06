<div class="modal fade" id="modalMenus" tabindex="1" style="overflow:hidden;" aria-labelledby="PagoModalLabel">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">API Intenciones</h4>
                <input type="hidden" id="company-api" />
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="row">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-body">
                            <form class="form-horizontal" data-parsley-validate="true" name="demo-form" novalidate="" action="javascript:guardarMenu()" method="POST">
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <input type="hidden" id="edit_menu" name="edit_menu" value="0">
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="nombre">Nombre * :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del Menú" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="url">Url * :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" id="url" name="url" placeholder="Ruta" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-lg-4 col-form-label form-label" for="icono">Icono * :</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" id="icono" name="icono" placeholder="Icono" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-lg-a">
                                    <span id="mostrar-icono" class="fas {{old('icono')}} " style="width: 20px;"></span>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>