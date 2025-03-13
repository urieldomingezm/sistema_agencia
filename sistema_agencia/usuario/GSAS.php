<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT * FROM gestion_ascenso";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $ascensos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error al obtener datos: " . $e->getMessage());
    $ascensos = [];
}
?>

<!-- INFORMACION DE PERFIL DE USUARIO -->
<meta name="keywords" content="Gestion de tiempo de ascenso, tiempo de ascenso y ascensos">

<body>
    <div class="container mt-4 text-center">
        <h2 class="mb-3">Gestión de ascensos</h2>
        <div class="d-flex justify-content-center">
            <table id="tablaAscenso" class="table table-bordered table-dark table-striped w-auto">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rango</th>
                        <th>Status</th>
                        <th>Motivo</th>
                        <th>Encargado</th>
                        <th>Próximo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaAscensoBody"></tbody>
            </table>
        </div>
    </div>


    <!-- MODALES -->
    <?php
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_ascender.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_baja.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_despedir.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_informacion_encargado.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_informacion_persona.php');
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tablaAscensoBody = document.getElementById("tablaAscensoBody");

            // Datos obtenidos desde PHP
            const ascensos = <?php echo json_encode($ascensos); ?>;

            if (ascensos.length > 0) {
                ascensos.forEach(ascenso => {
                    const fila = document.createElement("tr");

                    fila.innerHTML = `
                        <td>${ascenso.ascenso_id}</td>
                        <td><button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersona">${ascenso.ascenso_usuario}</button></td>
                        <td>${ascenso.ascenso_rango}</td>
                        <td><span class="badge ${getStatusClass(ascenso.ascenso_status)}">${ascenso.ascenso_status}</span></td>
                        <td>${ascenso.ascenso_motivo}</td>
                        <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersonaEncargado">${ascenso.ascenso_encargado_usuario}</button></td>
                        <td>${ascenso.ascenso_hora_proxima}</td>
                        <td>${ascenso.ascenso_fecha_registro}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_ascender">Ascender</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_despedir_persona">Despedir</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">Bajar rango</a></li>
                                </ul>
                            </div>
                        </td>
                    `;
                    tablaAscensoBody.appendChild(fila);
                });

                // Inicializar DataTable
                new simpleDatatables.DataTable("#tablaAscenso");
            }

            function getStatusClass(status) {
                switch (status.toLowerCase()) {
                    case 'proceso':
                        return 'bg-warning text-dark';
                    case 'completado':
                        return 'bg-success';
                    case 'despedido':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }
        });
    </script>
</body>