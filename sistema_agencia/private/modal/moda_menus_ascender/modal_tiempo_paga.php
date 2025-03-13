<?php
require_once(CONFIG_PATH . 'bd.php'); // Conexión a la base de datos

class Tiempo {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarTiempo($usuario, $status, $acumulado, $transcurrido, $total, $encargado) {
        try {
            $sql = "INSERT INTO gestion_tiempo 
                    (tiempo_usuario, tiempo_status, tiempo_acumulado, tiempo_transcurrido, tiempo_total, tiempo_encargado_usuario, tiempo_fecha_registro) 
                    VALUES (:usuario, :status, :acumulado, :transcurrido, :total, :encargado, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':acumulado', $acumulado);
            $stmt->bindParam(':transcurrido', $transcurrido);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':encargado', $encargado);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar tiempo: " . $e->getMessage());
            return false;
        }
    }
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarTiempo'])) {
    $database = new Database();
    $db = $database->getConnection();
    $tiempo = new Tiempo($db);

    $resultado = $tiempo->registrarTiempo(
        $_POST['tiempo_usuario'],
        $_POST['tiempo_status'],
        $_POST['tiempo_acumulado'],
        $_POST['tiempo_transcurrido'],
        $_POST['tiempo_total'],
        $_POST['tiempo_encargado_usuario']
    );

    if ($resultado) {
        echo "<script>
            alert('Tiempo registrado exitosamente');
            window.location.href = '/usuario/index.php?usuario=" . urlencode($_POST['tiempo_usuario']) . "&status=" . urlencode($_POST['tiempo_status']) . "';
        </script>";
    } else {
        echo "<script>alert('Error al registrar tiempo');</script>";
    }
}
?>

<!-- Modal para Tomar Time -->
<div class="modal fade" id="modalTiempo" tabindex="-1" aria-labelledby="modalTiempoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTiempoLabel">Tomar Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="tiempo_usuario" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Estado</label>
                            <input type="text" name="tiempo_status" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Acumulado</label>
                            <input type="time" name="tiempo_acumulado" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Transcurrido</label>
                            <input type="time" name="tiempo_transcurrido" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Total</label>
                            <input type="time" name="tiempo_total" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Encargado</label>
                            <input type="text" name="tiempo_encargado_usuario" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardarTiempo" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
