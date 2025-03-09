<body>
    <div class="container mt-4">
        <h2 class="mb-3">Gestion tiempos adminstrador</h2>
        <table id="tablaTiempos" class="table table-bordered table-borderless table-dark table-responsive-lg table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Restado</th>
                    <th>Acumulado</th>
                    <th>Total</th>
                    <th>Transcurrido</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaBody">
                <tr>
                    <td>1</td>
                    <td><button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#modalInformacionPersona">Santidemg</button></td>
                    <td><span class="badge bg-success">Corriendo</span></td>
                    <td>2h</td>
                    <td>30m</td>
                    <td>1h 30m</td>
                    <td>4h</td>
                    <td>2025-03-08</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                            data-bs-target="#modalAcciones">Detalles</button>
                        <button class="btn btn-sm btn-warning btn-editar" data-bs-toggle="modal"
                            data-bs-target="#modalModificar">Modificar</button>
                        <button class="btn btn-sm btn-danger btn-eliminar" data-bs-toggle="modal"
                            data-bs-target="#modalEliminar">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODALES DE EDITAR, ELIMINAR, DETALLES, ACCIONES ECT -->
    <?php 
    require_once(MODAL_GESTION_TIME_ADMIN_PATH . 'modal_detalles.php'); 
    require_once(MODAL_GESTION_TIME_ADMIN_PATH . 'modal_eliminar.php');
    require_once(MODAL_GESTION_TIME_ADMIN_PATH . 'modal_modificar.php');
    require_once(MODAL_GESTION_TIME_ADMIN_PATH . 'modal_informacion_persona.php');
    
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#tablaTiempos");
        });

        document.querySelectorAll(".btn-editar").forEach(button => {
            button.addEventListener("click", function() {
                let row = this.closest("tr");
                document.getElementById("editId").value = row.cells[0].textContent;
                document.getElementById("editNombre").value = row.cells[1].textContent;
                document.getElementById("editTiempoRestado").value = row.cells[3].textContent;
                document.getElementById("editTiempoAcumulado").value = row.cells[4].textContent;
                document.getElementById("editTiempoTotal").value = row.cells[5].textContent;
                document.getElementById("editTiempoTranscurrido").value = row.cells[6].textContent;
            });
        });

        document.querySelectorAll(".btn-eliminar").forEach(button => {
            button.addEventListener("click", function() {
                let row = this.closest("tr");
                document.getElementById("mensajeEliminar").textContent = "¿Estás seguro de que deseas eliminar a " + row.cells[1].textContent + "?";
            });
        });
    </script>
</body>