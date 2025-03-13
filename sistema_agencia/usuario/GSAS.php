<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT * FROM gestion_ascenso";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $ascensos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se recibió la actualización del tiempo a través de POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ascenso_id']) && isset($_POST['tiempo_restante']) && isset($_POST['nuevo_estado'])) {
        $ascenso_id = $_POST['ascenso_id'];
        $tiempo_restante = $_POST['tiempo_restante'];
        $nuevo_estado = $_POST['nuevo_estado'];

        // Actualizar el tiempo restante y el estado en la base de datos
        $updateQuery = "UPDATE gestion_ascenso SET ascenso_hora_proxima = :tiempo_restante, ascenso_status = :nuevo_estado WHERE ascenso_id = :ascenso_id";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':tiempo_restante', $tiempo_restante, PDO::PARAM_INT);
        $stmt->bindParam(':ascenso_id', $ascenso_id, PDO::PARAM_INT);
        $stmt->bindParam(':nuevo_estado', $nuevo_estado, PDO::PARAM_STR);
        $stmt->execute();
    }
} catch (PDOException $e) {
    error_log("Error al obtener datos: " . $e->getMessage());
    $ascensos = [];
}
?>

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

                    // Convertir la hora de 'ascenso_hora_proxima' a segundos
                    let tiempoRestante = timeToSeconds(ascenso.ascenso_hora_proxima);

                    fila.innerHTML = `
                        <td>${ascenso.ascenso_id}</td>
                        <td><button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersona">${ascenso.ascenso_usuario}</button></td>
                        <td>${ascenso.ascenso_rango}</td>
                        <td><span class="badge ${getStatusClass(ascenso.ascenso_status)}">${ascenso.ascenso_status}</span></td>
                        <td>${ascenso.ascenso_motivo}</td>
                        <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalInformacionPersonaEncargado">${ascenso.ascenso_encargado_usuario}</button></td>
                        <td class="tiempo-restante" data-id="${ascenso.ascenso_id}">${secondsToTime(tiempoRestante)}</td>
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

                    // Actualizar el tiempo cada segundo
                    setInterval(() => updateTime(fila, ascenso.ascenso_id), 1000);
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

            // Convertir el formato de tiempo "HH:MM:SS" a segundos
            function timeToSeconds(time) {
                const [hours, minutes, seconds] = time.split(":").map(Number);
                return (hours * 3600) + (minutes * 60) + seconds;
            }

            // Convertir segundos a formato "HH:MM:SS"
            function secondsToTime(seconds) {
                const hours = String(Math.floor(seconds / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
                const remainingSeconds = String(seconds % 60).padStart(2, '0');
                return `${hours}:${minutes}:${remainingSeconds}`;
            }

            // Actualizar el tiempo en la tabla
            function updateTime(row, ascensoId) {
                const tiempoRestanteElem = row.querySelector('.tiempo-restante');
                let tiempoRestante = timeToSeconds(tiempoRestanteElem.innerText);

                if (tiempoRestante > 0) {
                    tiempoRestante--;
                    tiempoRestanteElem.innerText = secondsToTime(tiempoRestante);

                    // Realizar la actualización del tiempo en el servidor
                    fetch('', {
                        method: 'POST',
                        body: new URLSearchParams({
                            ascenso_id: ascensoId,
                            tiempo_restante: tiempoRestante
                        })
                    }).then(response => response.text()).then(data => {
                        // Puedes agregar lógica de confirmación aquí si es necesario
                    }).catch(error => console.error('Error en la actualización del tiempo:', error));
                } else {
                    // Cambiar el estado a "Disponible" cuando el tiempo llegue a cero
                    const estadoElem = row.querySelector('td:nth-child(4) .badge');
                    estadoElem.textContent = "Disponible";
                    estadoElem.classList.remove("bg-warning", "bg-danger", "bg-success");
                    estadoElem.classList.add("bg-success");
                    
                    // Actualizar el estado en la base de datos
                    fetch('', {
                        method: 'POST',
                        body: new URLSearchParams({
                            ascenso_id: ascensoId,
                            tiempo_restante: 0,
                            nuevo_estado: "Disponible"
                        })
                    }).then(response => response.text()).then(data => {
                        // Puedes agregar lógica de confirmación aquí si es necesario
                    }).catch(error => console.error('Error en la actualización del estado:', error));
                }
            }
        });
    </script>
</body>
