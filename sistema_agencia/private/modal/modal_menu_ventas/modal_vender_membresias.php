<?php
require_once(CONFIG_PATH . 'bd.php');

class Membresia {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarVenta($titulo, $descripcion, $compra, $caducidad, $estado, $costo, $comprador, $encargado) {
        try {
            $sql = "INSERT INTO gestion_ventas
                    (venta_titulo, venta_descripcion, venta_compra, venta_caducidad, venta_estado, venta_costo, venta_comprador, venta_encargado, venta_fecha_compra) 
                    VALUES (:titulo, :descripcion, :compra, :caducidad, :estado, :costo, :comprador, :encargado, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':compra', $compra);
            $stmt->bindParam(':caducidad', $caducidad);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':costo', $costo);
            $stmt->bindParam(':comprador', $comprador);
            $stmt->bindParam(':encargado', $encargado);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar venta: " . $e->getMessage());
            return false;
        }
    }
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarMembresia'])) {
    $database = new Database();
    $db = $database->getConnection();
    $membresia = new Membresia($db);

    $resultado = $membresia->registrarVenta(
        $_POST['venta_titulo'],
        $_POST['venta_descripcion'],
        $_POST['venta_compra'],
        $_POST['venta_caducidad'],
        $_POST['venta_estado'],
        $_POST['venta_costo'],
        $_POST['venta_comprador'],
        $_POST['venta_encargado']
    );

    if ($resultado) {
        echo "<script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'Membresía registrada exitosamente',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Membresias';
            }
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'Error al registrar membresía',
            icon: 'error',
            confirmButtonText: 'Intentar de nuevo'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Membresias';
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
