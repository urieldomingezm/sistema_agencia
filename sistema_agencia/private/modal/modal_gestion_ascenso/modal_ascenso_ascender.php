<!-- MODAL PARA ASCENDER PERSONA -->
<div class="modal fade" id="modal_ascender" tabindex="-1" aria-labelledby="modal_ascenderLabel" aria-hidden="true"
        role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modal_ascenderLabel">Ascender persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- Primera columna -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="ascenso_usuario" id="recipient-name"
                                        disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="mision-anterior" class="col-form-label">Misión anterior:</label>
                                    <input class="form-control" id="mision-anterior" readonly disabled>
                                </div>
                                <div class="form-group">
                                    <label for="mision-nueva" class="col-form-label">Misión nueva:</label>
                                    <input class="form-control" id="mision-nueva" name="ascenso_mision_nueva">
                                </div>
                                <div class="form-group">
                                    <label for="firma" class="col-form-label">Firma:</label>
                                    <input class="form-control" id="firma" name="ascenso_firma">
                                </div>
                            </div>

                            <!-- Segunda columna -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rango">Rango:</label>
                                    <select class="form-select" name="ascenso_rango">
                                        <option selected disabled>Seleccionar en el menú</option>
                                        <option value="Agente">Agente</option>
                                        <option value="Seguridad">Seguridad</option>
                                        <option value="Tecnico">Técnico</option>
                                        <option value="Logistica">Logística</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Director">Director</option>
                                        <option value="Presidente">Presidente</option>
                                        <option value="Operativo">Operativo</option>
                                        <option value="Junta directiva">Junta directiva</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Estado:</label>
                                    <input class="form-control" id="status" name="ascenso_status">
                                </div>
                                <div class="form-group">
                                    <label for="encargado" class="col-form-label">Encargado:</label>
                                    <input class="form-control" id="encargado" name="ascenso_encargado_usuario">
                                </div>
                                <div class="form-group">
                                    <label for="hora-proxima">Hora próxima:</label>
                                    <select class="form-select" name="ascenso_hora_proxima">
                                        <option selected disabled>Seleccionar en el menú</option>
                                        <option value="00:30:00">Agente</option>
                                        <option value="02:00:00">Seguridad</option>
                                        <option value="24:00:00">Tecnico</option>
                                        <option value="48:00:00">Logistica</option>
                                        <option value="72:00:00">Supervisor</option>
                                        <option value="120:00:00">Director</option>
                                        <option value="168:00:00">Presidente</option>
                                        <option value="240:00:00">Operativo</option>
                                        <option value="360:00:00">Junta directiva</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Ascender</button>
                </div>
            </div>
        </div>
    </div>