<div class="modal fade" id="formCategoriaModal" tabindex="1" role="dialog" aria-labelledby="PagoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form id="formCategoriaLayapa" method="post" class="form-horizontal bv-form" novalidate="novalidate">
                    <div class="row col col-sm-12">
                        <section class="col col-sm-10">
                            <div class="form-group">
                                <label for="categoria_layapa">CATEGORIA</label>
                                <input type="text" class="form-control text-uppercase" id="categoria_layapa" name="categoria_layapa"  placeholder="Nombre Categoria" required>
                            </div>
                        </section>
                        <section class="col col-sm-2">
                            <a class="btn btn-danger"style="color: white; position: relative; top: 30px;" onclick="javascript:agregarCategoriaBase();"><i class="fas fa-plus"></i></a>
                        </section>
                        <small class="note">Esta Categoria es solo para esta Empresa.</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 