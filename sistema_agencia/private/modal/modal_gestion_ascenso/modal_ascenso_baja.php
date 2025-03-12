    <!-- MODAL PARA BAJAR DE RANGO PERSONA -->
    <div class="modal fade" id="modal_bajar_rango" tabindex="-1" aria-labelledby="modal_bajar_rangoLabel"
        aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modal_bajar_rangoLabel">Bajar rango persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Usuario:</label>
                                    <input type="text" class="form-control" name="ascenso_usuario" id="recipient-name"
                                        disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Misión actual:</label>
                                    <input class="form-control" id="message-text" readonly disabled>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Firma:</label>
                                    <input class="form-control" id="message-text" name="ascenso_firma">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Encargado:</label>
                                    <input class="form-control" id="message-text" name="ascenso_encargado_usuario">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Rango</label>
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
                                    <label for="message-text" class="col-form-label">Misión baja:</label>
                                    <input class="form-control" id="message-text" name="ascenso_mision_nueva">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status:</label>
                                    <input class="form-control" id="message-text" name="ascenso_status">
                                </div>
                                <div class="form-group">
                                    <label for="">Hora próxima</label>
                                    <select class="form-select" name="ascenso_hora_proxima">
                                        <option selected disabled>Seleccionar en el menú</option>
                                        <option value="00:30:00">00:30:00</option>
                                        <option value="02:00:00">02:00:00</option>
                                        <option value="24:00:00">24:00:00</option>
                                        <option value="48:00:00">48:00:00</option>
                                        <option value="72:00:00">72:00:00</option>
                                        <option value="120:00:00">120:00:00</option>
                                        <option value="168:00:00">168:00:00</option>
                                        <option value="240:00:00">240:00:00</option>
                                        <option value="360:00:00">360:00:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning">Bajar rango</button>
                </div>
            </div>
        </div>
    </div>