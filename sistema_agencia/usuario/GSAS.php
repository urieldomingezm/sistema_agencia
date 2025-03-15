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

<body class="bg-light">
    <div class="dashboard-container">
        <div class="container py-4">
            <div class="header-section mb-4">
                <h2 class="text-primary text-center fw-bold">
                    <i class="fas fa-users-cog me-2"></i>
                    Gestión de Ascensos
                </h2>
                <p class="text-muted text-center">Sistema de gestión y control de ascensos del personal</p>
            </div>

            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaAscenso" class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Usuario</th>
                                    <th>Rango</th>
                                    <th class="text-center">Status</th>
                                    <th>Motivo</th>
                                    <th>Encargado</th>
                                    <th class="text-center">Próximo</th>
                                    <th>Fecha</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ascensos as $ascenso) : ?>
                                    <tr data-id="<?= $ascenso['ascenso_id'] ?>" class="align-middle">
                                        <td class="text-center"><?= $ascenso['ascenso_id'] ?></td>
                                        <td>
                                            <button class="btn btn-link text-decoration-none user-btn" type="button" data-bs-toggle="modal" data-bs-target="#modalInformacionPersona">
                                                <i class="fas fa-user-circle me-2"></i>
                                                <?= $ascenso['ascenso_usuario'] ?>
                                            </button>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                <?= $ascenso['ascenso_rango'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center estado">
                                            <span class="badge-status <?= $ascenso['ascenso_status'] == 'Disponible' ? 'available' : 'pending' ?>">
                                                <?= $ascenso['ascenso_status'] ?>
                                            </span>
                                        </td>
                                        <td><?= $ascenso['ascenso_motivo'] ?></td>
                                        <td>
                                            <button class="btn btn-link text-decoration-none admin-btn" type="button" data-bs-toggle="modal" data-bs-target="#modalInformacionPersonaEncargado">
                                                <i class="fas fa-user-shield me-2"></i>
                                                <?= $ascenso['ascenso_encargado_usuario'] ?>
                                            </button>
                                        </td>
                                        <td class="text-center tiempo-restante fw-bold"><?= $ascenso['ascenso_hora_proxima'] ?></td>
                                        <td><?= $ascenso['ascenso_fecha_registro'] ?></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-cog me-1"></i> Acciones
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_ascender">
                                                            <i class="fas fa-arrow-up text-success me-2"></i> Ascender
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_despedir_persona">
                                                            <i class="fas fa-user-times text-danger me-2"></i> Despedir
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                                            <i class="fas fa-arrow-down text-warning me-2"></i> Bajar rango
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales existentes... -->

    <style>

        .header-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .badge-status {
            padding: 0.5em 1em;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
            min-width: 100px;
        }

        .badge-status.available {
            background: #d4edda;
            color: #155724;
        }

        .badge-status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .user-btn, .admin-btn {
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .user-btn:hover {
            color: #3498db;
        }

        .admin-btn:hover {
            color: #e74c3c;
        }

        .table {
            vertical-align: middle;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .tiempo-restante {
            font-family: 'Courier New', monospace;
            color: #2c3e50;
        }
    </style>

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Existing scripts... -->
</body>

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