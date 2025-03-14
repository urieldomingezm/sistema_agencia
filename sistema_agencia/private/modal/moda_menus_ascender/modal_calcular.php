<!-- CALCULAR RANGO EN VENTA -->

<!-- Modal para Dar Ascenso -->
<div class="modal fade" id="modalCalcular" tabindex="-1" aria-labelledby="modalCalcularLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalCalcularLabel">Calcular rango</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Eres</label>
                            <select class="form-select" required id="seleccion_eres">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="trabajador">Trabajador</option>
                                <option value="nuevo">Nuevo</option>
                            </select>
                            <div class="invalid-feedback">Seleccion de tipo eres</div>
                        </div>
                    </div>

                    <div id="campos_dinamicos" class="row mt-3">
                        <!-- Aquí se insertarán los campos dinámicamente -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle change event on selection dropdown
        $('#seleccion_eres').change(function() {
            const tipo = $(this).val();
            let campos = '';

            // Define common rank options
            const rankOptions = `
                <option disabled selected>Seleccionar</option>
                <option value="agente">Agente</option>
                <option value="seguridad">Seguridad</option>
                <option value="tecnico">Tecnico</option>
                <option value="logistica">Logistica</option>
                <option value="supervisor">Supervisor</option>
                <option value="director">Director</option>
                <option value="presidente">Presidente</option>
                <option value="operativo">Operativo</option>
            `;

            switch (tipo) {
                case 'trabajador':
                    campos = `
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Que rango eres</label>
                            <select class="form-select" required id="rango_actual">
                                ${rankOptions}
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Misión</label>
                            <input type="text" class="form-control" id="mision_actual" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Que rango deseas</label>
                            <select class="form-select" required id="rango_deseado">
                                ${rankOptions}
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Que misión deseas</label>
                            <select class="form-select" required id="mision_deseada">
                                ${rankOptions}
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Costo</label>
                            <input type="number" class="form-control" id="costo" required>
                        </div>
                    `;
                    break;

                case 'nuevo':
                    campos = `
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Rango deseado</label>
                            <select class="form-select" required id="rango_deseado_nuevo">
                                ${rankOptions}
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Misión</label>
                            <input type="text" class="form-control" id="mision_nuevo" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Costo</label>
                            <input type="number" class="form-control" id="costo_nuevo" required>
                        </div>
                    `;
                    break;
            }

            $('#campos_dinamicos').html(campos);
        });
    });
</script>