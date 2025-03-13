<!-- Modal para Dar Ascenso -->
<div class="modal fade" id="modalrangos" tabindex="-1" aria-labelledby="modalrangosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalrangosLabel">Dar Ascenso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="was-validated">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="ascenso_usuario" maxlength="14" class="form-control" required>
                                <div class="invalid-feedback">Nombre de usuario importante</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Rango</label>
                                <select name="ascenso_rango" class="form-control" required onchange="cambiarHoraProxima()">
                                    <option value="" disabled round>Seleccionar</option>
                                    <option value="Agente">Agente</option>
                                    <option value="Seguridad">Seguridad</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Logística">Logística</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Director">Director</option>
                                    <option value="Presidente">Presidente</option>
                                    <option value="Operativo">Operativo</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Misión Antigua</label>
                                <input type="text" name="ascenso_mision_antigua" required class="form-control">
                                <div class="invalid-feedback">Mision de antigua agencia</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Misión Nueva</label>
                                <input type="text" name="ascenso_mision_nueva" required placeholder="SNY- Agente -I -XDD #" class="form-control">
                                <div class="invalid-feedback">Mision correspondiente</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Firma</label>
                                    <input type="text" name="ascenso_firma" required maxlength="3" class="form-control">
                                    <div class="invalid-feedback">Firma de 3 digitos en mayusculas</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Motivo</label>
                                    <select name="ascenso_motivo" class="form-control" required>
                                        <option value="" disabled round>Seleccionar</option>
                                        <option value="Cumple el tiempo">Cumple el tiempo</option>
                                        <option value="Traslado">Traslado</option>
                                        <option value="Aspirante">Aspirante</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Encargado</label>
                                    <input type="text" name="ascenso_encargado_usuario" required maxlength="16" class="form-control" required>
                                    <div class="invalid-feedback">Nombre de encargado importante</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="guardarAscenso" class="btn btn-success">Registrar ascenso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>