<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT * FROM gestion_ascenso";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $ascensos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ascenso_id']) && isset($_POST['tiempo_restante'])) {
        $ascenso_id = $_POST['ascenso_id'];
        $tiempo_restante = $_POST['tiempo_restante'];

        if ($tiempo_restante == 0) {
            $nuevo_estado = "Disponible";
            $updateQuery = "UPDATE gestion_ascenso SET ascenso_hora_proxima = '00:00:00', ascenso_status = :nuevo_estado WHERE ascenso_id = :ascenso_id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':nuevo_estado', $nuevo_estado, PDO::PARAM_STR);
        } else {
            $horas = str_pad(floor($tiempo_restante / 3600), 2, "0", STR_PAD_LEFT);
            $minutos = str_pad(floor(($tiempo_restante % 3600) / 60), 2, "0", STR_PAD_LEFT);
            $segundos = str_pad($tiempo_restante % 60, 2, "0", STR_PAD_LEFT);
            $tiempo_formateado = "$horas:$minutos:$segundos";

            $updateQuery = "UPDATE gestion_ascenso SET ascenso_hora_proxima = :tiempo_formateado WHERE ascenso_id = :ascenso_id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':tiempo_formateado', $tiempo_formateado, PDO::PARAM_STR);
        }
        $stmt->bindParam(':ascenso_id', $ascenso_id, PDO::PARAM_INT);
        $stmt->execute();
        exit;
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
                <tbody>
                    <?php foreach ($ascensos as $ascenso) : ?>
                        <tr data-id="<?= $ascenso['ascenso_id'] ?>">
                            <td><?= $ascenso['ascenso_id'] ?></td>
                            <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalInformacionPersona"><?= $ascenso['ascenso_usuario'] ?></button></td>
                            <td><?= $ascenso['ascenso_rango'] ?></td>
                            <td class="estado">
                                <span class="badge <?= $ascenso['ascenso_status'] == 'Disponible' ? 'bg-success' : 'bg-secondary' ?>"><?= $ascenso['ascenso_status'] ?></span>
                            </td>
                            <td><?= $ascenso['ascenso_motivo'] ?></td>
                            <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal" data-bs-target="#modalInformacionPersonaEncargado"><?= $ascenso['ascenso_encargado_usuario'] ?></button></td>
                            <td class="tiempo-restante"><?= $ascenso['ascenso_hora_proxima'] ?></td>
                            <td><?= $ascenso['ascenso_fecha_registro'] ?></td>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
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

    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Script para inicializar Simple DataTables y manejar el tiempo restante -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar Simple DataTables
            new simpleDatatables.DataTable('#tablaAscenso');

            // Funciones para manejar el tiempo restante
            function timeToSeconds(time) {
                const [hours, minutes, seconds] = time.split(":").map(Number);
                return (hours * 3600) + (minutes * 60) + seconds;
            }

            function secondsToTime(seconds) {
                const hours = String(Math.floor(seconds / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
                const remainingSeconds = String(seconds % 60).padStart(2, '0');
                return `${hours}:${minutes}:${remainingSeconds}`;
            }

            function updateAscensoTime() {
                $(".tiempo-restante").each(function() {
                    const tiempoElem = $(this);
                    let tiempoRestante = timeToSeconds(tiempoElem.text());

                    if (tiempoRestante > 0) {
                        tiempoRestante--;
                        tiempoElem.text(secondsToTime(tiempoRestante));

                        const ascensoId = tiempoElem.closest("tr").data("id");
                        $.post("", {
                            ascenso_id: ascensoId,
                            tiempo_restante: tiempoRestante
                        });
                    } else {
                        const estadoElem = tiempoElem.closest("tr").find(".estado");
                        estadoElem.html('<span class="badge bg-success">Disponible</span>');
                    }
                });
            }

            // Actualizar el tiempo cada segundo
            setInterval(updateAscensoTime, 1000);
        });
    </script>
</body>