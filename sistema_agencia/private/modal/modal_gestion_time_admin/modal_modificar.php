   <!-- Modal Modificar -->
   <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModificar">
                        <input type="hidden" id="editId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editNombre" readonly disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editTiempoRestado" class="form-label">Tiempo Restado</label>
                                <input type="text" class="form-control" id="editTiempoRestado">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editTiempoAcumulado" class="form-label">Tiempo Acumulado</label>
                                <input type="text" class="form-control" id="editTiempoAcumulado">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editTiempoTotal" class="form-label">Tiempo Total</label>
                                <input type="text" class="form-control" id="editTiempoTotal">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editTiempoTranscurrido" class="form-label">Tiempo Transcurrido</label>
                                <input type="text" class="form-control" id="editTiempoTranscurrido">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>