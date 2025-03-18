<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT *, 
        TIMESTAMPDIFF(SECOND, tiempo_fecha_registro, NOW()) as segundos_transcurridos 
    FROM gestion_tiempo";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tiempos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tiempo_id']) && isset($_POST['tiempo_transcurrido'])) {
        $tiempo_id = $_POST['tiempo_id'];
        $tiempo_transcurrido = $_POST['tiempo_transcurrido'];
        
        $horas = str_pad(floor($tiempo_transcurrido / 3600), 2, "0", STR_PAD_LEFT);
        $minutos = str_pad(floor(($tiempo_transcurrido % 3600) / 60), 2, "0", STR_PAD_LEFT);
        $segundos = str_pad($tiempo_transcurrido % 60, 2, "0", STR_PAD_LEFT);
        $tiempo_formateado = "$horas:$minutos:$segundos";

        $updateQuery = "UPDATE gestion_tiempo SET tiempo_transcurrido = :tiempo_formateado WHERE tiempo_id = :tiempo_id";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':tiempo_formateado', $tiempo_formateado, PDO::PARAM_STR);
        $stmt->bindParam(':tiempo_id', $tiempo_id, PDO::PARAM_INT);
        $stmt->execute();
        exit;
    }
    // Add after existing POST handlers
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tiempo_id']) && isset($_POST['accion'])) {
        $tiempo_id = $_POST['tiempo_id'];
        $accion = $_POST['accion'];
        
        switch($accion) {
            case 'iniciar':
                $updateQuery = "UPDATE gestion_tiempo SET 
                    tiempo_status = 'Corriendo',
                    tiempo_fecha_registro = NOW()
                    WHERE tiempo_id = :tiempo_id";
                break;
                
            case 'pausar':
                $updateQuery = "UPDATE gestion_tiempo SET 
                    tiempo_status = 'Pausado'
                    WHERE tiempo_id = :tiempo_id";
                break;
        }
        
        if (isset($updateQuery)) {
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':tiempo_id', $tiempo_id, PDO::PARAM_INT);
            $stmt->execute();
            exit;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tiempo_id']) && isset($_POST['accion']) && $_POST['accion'] === 'detener') {
        $tiempo_id = $_POST['tiempo_id'];
        $tiempo_transcurrido = $_POST['tiempo_transcurrido'];
        
        // Get current accumulated time
        $queryActual = "SELECT tiempo_acumulado FROM gestion_tiempo WHERE tiempo_id = :tiempo_id";
        $stmt = $conn->prepare($queryActual);
        $stmt->bindParam(':tiempo_id', $tiempo_id, PDO::PARAM_INT);
        $stmt->execute();
        $tiempoActual = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Sum times
        $tiempo_actual = strtotime("1970-01-01 " . $tiempoActual['tiempo_acumulado'] . " UTC");
        $tiempo_nuevo = $tiempo_actual + $tiempo_transcurrido;
        
        // Format new accumulated time
        $tiempo_acumulado = gmdate("H:i:s", $tiempo_nuevo);
        
        // Update database
        $updateQuery = "UPDATE gestion_tiempo SET 
            tiempo_acumulado = :tiempo_acumulado,
            tiempo_transcurrido = '00:00:00',
            tiempo_status = 'Pausado'
            WHERE tiempo_id = :tiempo_id";
        
        $stmt = $conn->prepare($updateQuery);
        $stmt->bindParam(':tiempo_acumulado', $tiempo_acumulado, PDO::PARAM_STR);
        $stmt->bindParam(':tiempo_id', $tiempo_id, PDO::PARAM_INT);
        $stmt->execute();
        exit;
    }
} catch (PDOException $e) {
    error_log("Error al obtener datos: " . $e->getMessage());
    $tiempos = [];
}
?>



<!-- INFORMACION DE PERFIL DE USUARIO -->
<meta name="keywords" content="Gestion de tiempo de paga, tiempo de paga o time de paga">

<div class="container-fluid mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary py-3 border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="text-white mb-0">
                        <i class="fas fa-clock me-2"></i>Gestión de Tiempos
                    </h5>
                </div>
                <div class="col text-end">
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTiempo">
                        <i class="fas fa-plus me-2"></i>Nuevo Registro
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaTiempos" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Usuario</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Restado</th>
                            <th class="text-center">Acumulado</th>
                            <th class="text-center">Transcurrido</th>
                            <th class="text-center">Total</th>
                            <th>Encargado</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tiempos as $tiempo) : ?>
                            <tr data-id="<?= $tiempo['tiempo_id'] ?>" class="align-middle">
                                <td class="text-center"><?= $tiempo['tiempo_id'] ?></td>
                                <td>
                                    <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#modalInformacionPersona">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-2">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                            <?= $tiempo['tiempo_usuario'] ?>
                                        </div>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 <?= getStatusClass($tiempo['tiempo_status']) ?>">
                                        <i class="fas <?= getStatusIcon($tiempo['tiempo_status']) ?> me-1"></i>
                                        <?= $tiempo['tiempo_status'] ?>
                                    </span>
                                </td>
                                <td class="text-center font-monospace"><?= $tiempo['tiempo_restado'] ?></td>
                                <td class="text-center font-monospace"><?= $tiempo['tiempo_acumulado'] ?></td>
                                <td class="text-center tiempo-transcurrido" data-segundos="<?= $tiempo['segundos_transcurridos'] ?>">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-hourglass-half me-1"></i>
                                        <?= $tiempo['tiempo_transcurrido'] ?>
                                    </span>
                                </td>
                                <td class="text-center font-monospace"><?= $tiempo['tiempo_total'] ?></td>
                                <td>
                                    <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#modalInformacionPersonaEncargado">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs me-2">
                                                <i class="fas fa-user-shield text-primary"></i>
                                            </div>
                                            <?= $tiempo['tiempo_encargado_usuario'] ?>
                                        </div>
                                    </button>
                                </td>
                                <td class="text-center"><?= formatDate($tiempo['tiempo_fecha_registro']) ?></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item text-success" href="#" data-bs-toggle="modal" data-bs-target="#modal_ascender">
                                                    <i class="fas fa-play me-2"></i>Iniciar tiempo
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal_despedir_persona">
                                                    <i class="fas fa-user-clock me-2"></i>Ausente
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                                    <i class="fas fa-pause me-2"></i>Pausar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                                    <i class="fas fa-stop me-2"></i>Parar
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-info" href="#" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                                    <i class="fas fa-check me-2"></i>Completado
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

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #A78BFA, #8B5CF6);
    }

    .bg-gradient-info {
        background: linear-gradient(45deg, #36b9cc, #258391);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th,
    .table td {
        border: 1px solid #e3e6f0;
        padding: 1rem;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fc;
        border-top: none;
        border-bottom: 2px solid #e3e6f0;
    }

    .table tbody tr:hover {
        background-color: rgba(167, 139, 250, 0.05);
    }

    .table tbody td {
        transition: all 0.3s ease;
    }

    .card-body {
        padding: 1.5rem;
        background-color: #ffffff;
        border-radius: 0 0 0.5rem 0.5rem;
    }

    .avatar-xs {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .font-monospace {
        font-family: 'Roboto Mono', monospace;
    }

    .dropdown-menu {
        font-size: 0.875rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
    }

    .dropdown-item i {
        width: 1rem;
        text-align: center;
    }
</style>

<?php
function getStatusClass($status)
{
    switch (strtolower($status)) {
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

function getStatusIcon($status)
{
    switch (strtolower($status)) {
        case 'corriendo':
            return 'fa-play';
        case 'pausado':
            return 'fa-pause';
        case 'completado':
            return 'fa-check';
        case 'ausente':
            return 'fa-user-clock';
        default:
            return 'fa-circle';
    }
}

function formatDate($date)
{
    return date('d/m/Y H:i', strtotime($date));
}
?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        new simpleDatatables.DataTable('#tablaTiempos');

        // Handle all action buttons
        document.querySelectorAll('.dropdown-item').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const row = this.closest('tr');
                const tiempoId = row.dataset.id;
                const action = this.querySelector('i').className;

                if (action.includes('fa-play')) {
                    const result = await Swal.fire({
                        title: '¿Iniciar tiempo?',
                        text: '¿Deseas iniciar el conteo de tiempo?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, iniciar',
                        cancelButtonText: 'Cancelar'
                    });

                    if (result.isConfirmed) {
                        fetch('', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `tiempo_id=${tiempoId}&accion=iniciar`
                        }).then(() => {
                            Swal.fire('¡Iniciado!', 'El tiempo ha comenzado a correr.', 'success')
                                .then(() => location.reload());
                        });
                    }
                } else if (action.includes('fa-stop')) {
                    const result = await Swal.fire({
                        title: '¿Detener tiempo?',
                        text: 'El tiempo transcurrido se sumará al acumulado',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, detener',
                        cancelButtonText: 'Cancelar'
                    });

                    if (result.isConfirmed) {
                        const tiempoElem = row.querySelector('.tiempo-transcurrido');
                        const segundos = parseInt(tiempoElem.dataset.segundos);
                        
                        fetch('', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `tiempo_id=${tiempoId}&accion=detener&tiempo_transcurrido=${segundos}`
                        }).then(() => {
                            Swal.fire('¡Detenido!', 'El tiempo se ha detenido y acumulado.', 'success')
                                .then(() => location.reload());
                        });
                    }
                } else if (action.includes('fa-pause')) {
                    const result = await Swal.fire({
                        title: '¿Pausar tiempo?',
                        text: '¿Deseas pausar el conteo de tiempo?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, pausar',
                        cancelButtonText: 'Cancelar'
                    });

                    if (result.isConfirmed) {
                        fetch('', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `tiempo_id=${tiempoId}&accion=pausar`
                        }).then(() => {
                            Swal.fire('¡Pausado!', 'El tiempo se ha pausado.', 'success')
                                .then(() => location.reload());
                        });
                    }
                }
            });
        });

        // Keep existing updateTiempoTranscurrido function
        function updateTiempoTranscurrido() {
            document.querySelectorAll(".tiempo-transcurrido, .tiempo-restado").forEach(function(tiempoElem) {
                const row = tiempoElem.closest('tr');
                const status = row.querySelector('.badge').textContent.trim().toLowerCase();
                const isRestado = tiempoElem.classList.contains('tiempo-restado');
                
                if ((status === 'corriendo' && !isRestado) || (status === 'ausente' && isRestado)) {
                    let segundos = parseInt(tiempoElem.dataset.segundos);
                    segundos++;
                    tiempoElem.dataset.segundos = segundos;
                    
                    const hours = String(Math.floor(segundos / 3600)).padStart(2, '0');
                    const minutes = String(Math.floor((segundos % 3600) / 60)).padStart(2, '0');
                    const seconds = String(segundos % 60).padStart(2, '0');
                    const timeString = `${hours}:${minutes}:${seconds}`;
                    
                    tiempoElem.querySelector('span').innerHTML = 
                        `<i class="fas fa-hourglass-half me-1"></i>${timeString}`;

                    const postData = isRestado ? 'tiempo_restado' : 'tiempo_transcurrido';
                    fetch('', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `tiempo_id=${row.dataset.id}&${postData}=${segundos}`
                    });
                }
            });
        }

        setInterval(updateTiempoTranscurrido, 1000);
    });
</script>


