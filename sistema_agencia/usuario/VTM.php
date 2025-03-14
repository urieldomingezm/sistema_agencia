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
                <form method="POST" class="was-validated">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Eres</label>
                            <select class="select-from" required id="seleccion_eres">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="trabajador">Trabajador</option>
                                <option value="administrador">Administrador</option>
                                <option value="afueras">Afueras</option>
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
                        <button type="submit" name="guardarAscenso" class="btn btn-success">Registrar ascenso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#seleccion_eres').change(function() {
        const tipo = $(this).val();
        let campos = '';
        
        const campoBase = `
            <div class="col-md-6 mb-2">
                <label class="form-label">Rango deseado</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Misión</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
                <label class="form-label">Costo</label>
                <input type="number" class="form-control" required>
            </div>
        `;

        switch(tipo) {
            case 'trabajador':
                campos = `
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Rango actual</label>
                        <input type="text" class="form-control" required>
                    </div>
                    ${campoBase}
                `;
                break;
            case 'administrador':
            case 'afueras':
            case 'nuevo':
                campos = campoBase;
                break;
        }

        $('#campos_dinamicos').html(campos);
    });
});
</script>
