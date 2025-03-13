<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT * FROM gestion_tiempo";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tiempos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error al obtener datos: " . $e->getMessage());
    $tiempos = [];
}
?>

<!-- INFORMACION DE PERFIL DE USUARIO -->
<meta name="keywords" content="Gestion de tiempo de paga, tiempo de paga o time de paga">

<body>
    <div class="container mt-4 text-center">
        <h2 class="mb-3">Gestión de tiempos</h2>
        <div class="d-flex justify-content-center">
            <table id="tablaTiempos" class="table table-bordered table-dark table-striped w-auto">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estatus</th>
                        <th>Restado</th>
                        <th>Acumulado</th>
                        <th>Transcurrido</th>
                        <th>Total</th>
                        <th>Encargado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaBody"></tbody>
            </table>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tablaBody = document.getElementById("tablaBody");

            // Datos obtenidos desde PHP
            const tiempos = <?php echo json_encode($tiempos); ?>;

            if (tiempos.length > 0) {
                tiempos.forEach(tiempo => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${tiempo.tiempo_id}</td>
                        <td><button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersona">${tiempo.tiempo_usuario}</button></td>
                        <td><span class="badge ${getStatusClass(tiempo.tiempo_status)}">${tiempo.tiempo_status}</span></td>
                        <td>${tiempo.tiempo_restado}</td>
                        <td>${tiempo.tiempo_acumulado}</td>
                        <td>${tiempo.tiempo_transcurrido}</td>
                        <td>${tiempo.tiempo_total}</td>
                        <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersonaEncargado">${tiempo.tiempo_encargado_usuario}</button></td>
                        <td>${tiempo.tiempo_fecha_registro}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_ascender">Iniciar tiempo</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_despedir_persona">Ausente</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">Pausar</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">Parar</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">Completado</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalModificar">Modificar</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    tablaBody.appendChild(fila);
                });

                // Inicializar DataTable
                new simpleDatatables.DataTable("#tablaTiempos");
            }

            function getStatusClass(status) {
                switch (status.toLowerCase()) {
                    case 'corriendo':
                        return 'bg-success';
                    case 'pausado':
                        return 'bg-warning text-dark';
                    case 'completado':
                        return 'bg-info';
                    case 'ausente':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }
        });
    </script>
</body>

<!-- MODALES PARA ACCIONES -->
<?php
require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_eliminar.php');
require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_informacion_encargado.php');
require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_informacion_persona.php');
require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_modificar.php');
?>