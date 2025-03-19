<?php
require_once(CONFIG_PATH . 'bd.php');

class VerificacionManager {
    private $conn;
    private $session;

    public function __construct($conn, $session) {
        $this->conn = $conn;
        $this->session = $session;
    }

    public function updateUserStatus($userId, $status) {
        try {
            $this->conn->beginTransaction();
            
            $updateQuery = "UPDATE registro_usuario SET verificado = ? WHERE id = ?";
            $updateStmt = $this->conn->prepare($updateQuery);
            $result = $updateStmt->execute([$status, $userId]);
            
            if ($result) {
                $accion = $status == 1 ? 'Verificación de cuenta' : 'Rechazo de cuenta';
                $detalles = "Usuario {$this->session['usuario_registro']} ha realizado la acción: $accion para el ID: $userId";
                
                $blimQuery = "INSERT INTO blim (usuario, accion, detalles, fecha) VALUES (?, ?, ?, NOW())";
                $blimStmt = $this->conn->prepare($blimQuery);
                $blimResult = $blimStmt->execute([
                    $this->session['usuario_registro'],
                    $accion,
                    $detalles
                ]);

                if ($blimResult) {
                    $this->conn->commit();
                    return ['success' => true];
                }
            }
            
            $this->conn->rollBack();
            return ['success' => false, 'error' => 'Error al actualizar estado'];
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error en verificación: " . $e->getMessage());
            return ['success' => false, 'error' => 'Error en base de datos'];
        }
    }

    public function changeUserPassword($userId, $newPassword) {
        try {
            $this->conn->beginTransaction();
            
            // Hash the password using the same method as in registration
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE registro_usuario SET password_registro = ? WHERE id = ?";
            $updateStmt = $this->conn->prepare($updateQuery);
            $result = $updateStmt->execute([$hashedPassword, $userId]);
            
            if ($result) {
                // Log in BLIM
                $blimQuery = "INSERT INTO blim (usuario, accion, detalles, fecha) VALUES (?, ?, ?, NOW())";
                $blimStmt = $this->conn->prepare($blimQuery);
                $blimResult = $blimStmt->execute([
                    $this->session['usuario_registro'],
                    'Cambio de contraseña',
                    "Usuario {$this->session['usuario_registro']} realizó un cambio de contraseña para el usuario ID: $userId"
                ]);

                if ($blimResult) {
                    $this->conn->commit();
                    return ['success' => true];
                }
            }
            
            $this->conn->rollBack();
            return ['success' => false, 'error' => 'Error al cambiar contraseña'];
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error al cambiar contraseña: " . $e->getMessage());
            return ['success' => false, 'error' => 'Error en base de datos'];
        }
    }
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    $database = new Database();
    $conn = $database->getConnection();

    if (!$conn) {
        echo json_encode(['success' => false, 'error' => 'Error de conexión']);
        exit;
    }

    $verificacionManager = new VerificacionManager($conn, $_SESSION);

    if ($_POST['action'] === 'updateStatus') {
        $userId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
        echo json_encode($verificacionManager->updateUserStatus($userId, $status));
        exit;
    }

    if ($_POST['action'] === 'changePassword') {
        $userId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $newPassword = $_POST['newPassword'];
        echo json_encode($verificacionManager->changeUserPassword($userId, $newPassword));
        exit;
    }
}

// Regular page load database query
$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    die("Error: No se pudo conectar a la base de datos.");
}

try {
    $query = "SELECT id, usuario_registro, nombre_habbo, rango, fecha_registro, verificado FROM registro_usuario ORDER BY fecha_registro DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error en consulta: " . $e->getMessage());
    $usuarios = [];
}
?>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="text-white mb-0">
                        <i class="fas fa-user-check me-2"></i>Estado de Verificación
                    </h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="verificationTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombre Habbo</th>
                            <th>Rango</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario['id'] ?></td>
                                <td><?= htmlspecialchars($usuario['usuario_registro']) ?></td>
                                <td><?= htmlspecialchars($usuario['nombre_habbo']) ?></td>
                                <td><?= htmlspecialchars($usuario['rango']) ?></td>
                                <td><?= $usuario['fecha_registro'] ?></td>
                                <td>
                                    <?php
                                    switch($usuario['verificado']) {
                                        case 0:
                                            echo '<span class="badge bg-warning">Pendiente</span>';
                                            break;
                                        case 1:
                                            echo '<span class="badge bg-success">Verificado</span>';
                                            break;
                                        case 2:
                                            echo '<span class="badge bg-danger">Rechazado</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($usuario['verificado'] == 0): ?>
                                        <button class="btn btn-success btn-sm" onclick="updateStatus(<?= $usuario['id'] ?>, 1)">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="updateStatus(<?= $usuario['id'] ?>, 2)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    <?php endif; ?>
                                    <button class="btn btn-warning btn-sm" onclick="changePassword(<?= $usuario['id'] ?>)">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataTable = new simpleDatatables.DataTable("#verificationTable", {
        searchable: true,
        fixedHeight: true,
        perPage: 10,
        labels: {
            placeholder: "Buscar usuarios...",
            perPage: "Mostrar {select} registros",
            noRows: "No se encontraron registros",
            info: "Mostrando {start} a {end} de {rows} registros",
            noResults: "No hay resultados"
        },
        layout: {
            top: "{search}",
            bottom: "{info}{pager}"
        }
    });
});

function updateStatus(userId, status) {
    const action = status === 1 ? 'verificar' : 'rechazar';
    
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas ${action} este usuario?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: status === 1 ? '#28a745' : '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('action', 'updateStatus');
            formData.append('id', userId);
            formData.append('status', status);

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    return Swal.fire({
                        title: '¡Completado!',
                        text: `El usuario ha sido ${status === 1 ? 'verificado' : 'rechazado'} exitosamente`,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.error || 'Error al actualizar el estado');
                }
            })
            .then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 1600);
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error al procesar la solicitud',
                    icon: 'error'
                });
            });
        }
    });
}
// Add this function after the updateStatus function
function changePassword(userId) {
    Swal.fire({
        title: 'Cambiar Contraseña',
        input: 'password',
        inputLabel: 'Nueva Contraseña',
        inputPlaceholder: 'Ingrese la nueva contraseña',
        showCancelButton: true,
        confirmButtonText: 'Cambiar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ffc107',
        inputValidator: (value) => {
            if (!value) {
                return 'Por favor ingrese una contraseña';
            }
            // Validar requisitos de contraseña como en el registro
            if (value.length < 8) {
                return 'La contraseña debe tener al menos 8 caracteres';
            }
            if (!/[A-Z]/.test(value)) {
                return 'La contraseña debe contener al menos una mayúscula';
            }
            if (!/[a-z]/.test(value)) {
                return 'La contraseña debe contener al menos una minúscula';
            }
            if (!/[0-9]/.test(value)) {
                return 'La contraseña debe contener al menos un número';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('action', 'changePassword');
            formData.append('id', userId);
            formData.append('newPassword', result.value);

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: '¡Completado!',
                        text: 'La contraseña ha sido actualizada exitosamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error(data.error || 'Error al actualizar la contraseña');
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error al cambiar la contraseña',
                    icon: 'error'
                });
            });
        }
    });
}
</script>

<style>
.dataTable-table > tbody > tr:hover {
    background-color: #f8f9fa;
}
.badge {
    font-size: 0.875rem;
}
.btn-sm {
    padding: 0.25rem 0.5rem;
    margin: 0 2px;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
