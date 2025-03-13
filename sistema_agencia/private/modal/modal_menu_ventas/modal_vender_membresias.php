<?php
require_once(CONFIG_PATH . 'bd.php');

class Suscripcion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarSuscripcion($usuario, $plan, $inicio, $fin, $estado, $costo, $encargado) {
        try {
            $sql = "INSERT INTO gestion_suscripciones
                    (suscripcion_usuario, suscripcion_plan, suscripcion_inicio, suscripcion_fin, suscripcion_estado, suscripcion_costo, suscripcion_encargado, suscripcion_fecha_registro) 
                    VALUES (:usuario, :plan, :inicio, :fin, :estado, :costo, :encargado, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':plan', $plan);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':costo', $costo);
            $stmt->bindParam(':encargado', $encargado);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar suscripción: " . $e->getMessage());
            return false;
        }
    }
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarSuscripcion'])) {
    $database = new Database();
    $db = $database->getConnection();
    $suscripcion = new Suscripcion($db);

    $resultado = $suscripcion->registrarSuscripcion(
        $_POST['suscripcion_usuario'],
        $_POST['suscripcion_plan'],
        $_POST['suscripcion_inicio'],
        $_POST['suscripcion_fin'],
        $_POST['suscripcion_estado'],
        $_POST['suscripcion_costo'],
        $_POST['suscripcion_encargado']
    );

    if ($resultado) {
        echo "<script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'Suscripción registrada exitosamente',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Suscripciones';
            }
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'Error al registrar suscripción',
            icon: 'error',
            confirmButtonText: 'Intentar de nuevo'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Suscripciones';
            }
        });
        </script>";
    }
}
?>

<!-- Modal para Venta de Membresías -->
<div class="modal fade" id="modalmembresias" tabindex="-1" aria-labelledby="modalmembresiasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalmembresiasLabel">Venta de Membresías</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="was-validated">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Título</label>
                            <input type="text" name="venta_titulo" maxlength="50" class="form-control" required>
                            <div class="invalid-feedback">El título es obligatorio</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Descripción</label>
                            <input type="text" name="venta_descripcion" maxlength="60" class="form-control" required>
                            <div class="invalid-feedback">La descripción es obligatoria</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Fecha de Compra</label>
                            <input type="date" name="venta_compra" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Fecha de Caducidad</label>
                            <input type="date" name="venta_caducidad" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Estado</label>
                            <input type="text" name="venta_estado" maxlength="50" class="form-control" required>
                            <div class="invalid-feedback">El estado es obligatorio</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Costo</label>
                            <input type="number" name="venta_costo" class="form-control" required>
                            <div class="invalid-feedback">El costo es obligatorio</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Comprador</label>
                            <input type="text" name="venta_comprador" maxlength="16" class="form-control" required>
                            <div class="invalid-feedback">El comprador es obligatorio</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Encargado</label>
                            <input type="text" name="venta_encargado" maxlength="16" class="form-control" required>
                            <div class="invalid-feedback">El encargado es obligatorio</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardarAscenso" class="btn btn-success">Registrar Membresía</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
