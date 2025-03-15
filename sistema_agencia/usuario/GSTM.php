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
                    <tbody id="tablaBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tablaBody = document.getElementById("tablaBody");
    const tiempos = <?php echo json_encode($tiempos); ?>;

    if (tiempos.length > 0) {
        tiempos.forEach(tiempo => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td class="text-center align-middle">${tiempo.tiempo_id}</td>
                <td class="align-middle">
                    <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#modalInformacionPersona">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-2">
                                <i class="fas fa-user-circle text-primary"></i>
                            </div>
                            ${tiempo.tiempo_usuario}
                        </div>
                    </button>
                </td>
                <td class="text-center align-middle">
                    <span class="badge ${getStatusClass(tiempo.tiempo_status)} rounded-pill px-3">
                        <i class="fas ${getStatusIcon(tiempo.tiempo_status)} me-1"></i>${tiempo.tiempo_status}
                    </span>
                </td>
                <td class="text-center align-middle font-monospace">${tiempo.tiempo_restado}</td>
                <td class="text-center align-middle font-monospace">${tiempo.tiempo_acumulado}</td>
                <td class="text-center align-middle font-monospace">${tiempo.tiempo_transcurrido}</td>
                <td class="text-center align-middle font-monospace">${tiempo.tiempo_total}</td>
                <td class="align-middle">
                    <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#modalInformacionPersonaEncargado">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs me-2">
                                <i class="fas fa-user-shield text-primary"></i>
                            </div>
                            ${tiempo.tiempo_encargado_usuario}
                        </div>
                    </button>
                </td>
                <td class="text-center align-middle">${formatDate(tiempo.tiempo_fecha_registro)}</td>
                <td class="text-center align-middle">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modal_ascender">
                                    <i class="fas fa-play me-2"></i>Iniciar tiempo
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal_despedir_persona">
                                    <i class="fas fa-user-clock me-2"></i>Ausente
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                    <i class="fas fa-pause me-2"></i>Pausar
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                    <i class="fas fa-stop me-2"></i>Parar
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango">
                                    <i class="fas fa-check me-2"></i>Completado
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalModificar">
                                    <i class="fas fa-edit me-2"></i>Modificar
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                    <i class="fas fa-trash me-2"></i>Eliminar
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            `;
            tablaBody.appendChild(fila);
        });

        new simpleDatatables.DataTable("#tablaTiempos", {
            searchable: true,
            fixedHeight: true,
            perPage: 10
        });
    }

    function getStatusClass(status) {
        switch (status.toLowerCase()) {
            case 'corriendo': return 'bg-success';
            case 'pausado': return 'bg-warning text-dark';
            case 'completado': return 'bg-info';
            case 'ausente': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }

    function getStatusIcon(status) {
        switch (status.toLowerCase()) {
            case 'corriendo': return 'fa-play';
            case 'pausado': return 'fa-pause';
            case 'completado': return 'fa-check';
            case 'ausente': return 'fa-user-clock';
            default: return 'fa-circle';
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('es-ES', { 
            year: 'numeric', 
            month: '2-digit', 
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
});
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.avatar-xs {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fc;
    border-top: none;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-weight: 500;
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

.card {
    margin-bottom: 1.5rem;
}
</style>

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