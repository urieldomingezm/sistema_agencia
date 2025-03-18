<?php
require_once(CONFIG_PATH . 'bd.php');

try {
    $database = new Database();
    $conn = $database->getConnection();

    $query = "SELECT * FROM registro_usuario WHERE verificado = 0";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error al obtener usuarios: " . $e->getMessage());
    $usuarios = [];
}
?>

<!-- Meta keywords for search -->
<meta name="keywords" content="verificar usuario, verificación, usuarios pendientes, verificar">

<div class="container-fluid mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary py-3 border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="text-white mb-0">
                        <i class="fas fa-user-check me-2"></i>Verificación de Usuarios
                    </h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Usuario</th>
                            <th>Nombre Habbo</th>
                            <th>Rango</th>
                            <th class="text-center">Fecha Registro</th>
                            <th class="text-center">IP</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td class="text-center"><?= $usuario['id'] ?></td>
                                <td><?= $usuario['usuario_registro'] ?></td>
                                <td><?= $usuario['nombre_habbo'] ?></td>
                                <td><?= $usuario['rango'] ?></td>
                                <td class="text-center"><?= $usuario['fecha_registro'] ?></td>
                                <td class="text-center"><?= $usuario['ip_registro'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm verificar-usuario" data-id="<?= $usuario['id'] ?>">
                                        <i class="fas fa-check me-1"></i>Verificar
                                    </button>
                                    <button class="btn btn-danger btn-sm rechazar-usuario" data-id="<?= $usuario['id'] ?>">
                                        <i class="fas fa-times me-1"></i>Rechazar
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

<link href="/public/custom/data_simple/style.css" rel="stylesheet">
<script src="/public/custom/data_simple/script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dataTable = new simpleDatatables.DataTable("#tablaUsuarios", {
        searchable: true,
        fixedHeight: true,
        labels: {
            placeholder: "Buscar...",
            perPage: "Registros por página",
            noRows: "No hay usuarios pendientes de verificación",
            info: "Mostrando {start} a {end} de {rows} usuarios",
            noResults: "No hay resultados que coincidan con su búsqueda"
        },
        layout: {
            top: "{search}{select}",
            bottom: "{info}{pager}"
        }
    });

    // Handle verify user
    document.querySelectorAll('.verificar-usuario').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            Swal.fire({
                title: '¿Verificar usuario?',
                text: "¿Estás seguro de verificar este usuario?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, verificar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your verification logic here
                    // Example: fetch('/verificar_usuario.php', { method: 'POST', body: ... })
                }
            });
        });
    });

    // Handle reject user
    document.querySelectorAll('.rechazar-usuario').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            Swal.fire({
                title: '¿Rechazar usuario?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, rechazar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add your rejection logic here
                    // Example: fetch('/rechazar_usuario.php', { method: 'POST', body: ... })
                }
            });
        });
    });
});
</script>