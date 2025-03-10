<!-- MODAL PARA BAJAR DE RANGO PERSONA -->
    <div class="modal fade" tabindex="-1" id="modal_bajar_rango" aria-labelledby="modal_bajar_rangoLabel"
        aria-hidden="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modal_bajar_rangoLabel">Bajar rango persona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label" >Usuario:</label>
                            <input type="text" class="form-control" name="ascenso_usuario" id="recipient-name" disabled readonly>
                        </div>
                        <div>
                            <label for="">Rango</label>
                            <select class="form-select" name="ascenso_rango">
                                <option selected disabled>Seleccionar en el menu</option>
                                <option value="Agente">Agente</option>
                                <option value="Seguridad">Seguridad</option>
                                <option value="Tecnico">Tecnico</option>
                                <option value="Logistica">Logistica</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Director">Director</option>
                                <option value="Presidente">Presidente</option>
                                <option value="Operativo">Operativo</option>
                                <option value="Junta directiva">Junta directiva</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mision actual:</label>
                            <input class="form-control" id="message-text" readonly disabled></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Mision baja::</label>
                            <input class="form-control" id="message-text" name="ascenso_mision_nueva"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Firma:</label>
                            <input class="form-control" id="message-text" name="ascenso_firma"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">status:</label>
                            <input class="form-control" id="message-text" name="ascenso_status"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Encargado:</label>
                            <input class="form-control" id="message-text" name="ascenso_encargado_usuario"></input>
                        </div>
                        <div>
                            <label for="">Hora proxima</label>
                            <select class="form-select" name="ascenso_hora_proxima">
                                <option selected disabled>Seleccionar en el menu</option>
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
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning">Bajar rango</button>
                </div>
            </div>
        </div>
    </div>