<?php
require_once(CONFIG_PATH . 'bd.php');

class Pago
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrarPago($usuario, $recibio, $motivo, $completo, $descripcion)
    {
        try {
            $sql = "INSERT INTO gestion_pagas 
                    (pagas_usuario, pagas_recibio, pagas_motivo, pagas_completo, pagas_descripcion, pagas_fecha_registro) 
                    VALUES (:usuario, :recibio, :motivo, :completo, :descripcion, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':recibio', $recibio);
            $stmt->bindParam(':motivo', $motivo);
            $stmt->bindParam(':completo', $completo);
            $stmt->bindParam(':descripcion', $descripcion);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar pago: " . $e->getMessage());
            return false;
        }
    }
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarPago'])) {
    $database = new Database();
    $db = $database->getConnection();
    $pago = new Pago($db);

    $resultado = $pago->registrarPago(
        $_POST['pagas_usuario'],
        $_POST['pagas_recibio'],
        $_POST['pagas_motivo'],
        $_POST['pagas_completo'],
        $_POST['pagas_descripcion']
    );

    if ($resultado) {
        echo "<script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'Pago registrado exitosamente',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Requisitos de paga';
            }
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'Error al registrar pago',
            icon: 'error',
            confirmButtonText: 'Intentar de nuevo'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=Pagos';
            }
        });
        </script>";
    }
}
?>

<!-- Modal para Registrar Pago -->
<div class="modal fade" id="modalpagar" tabindex="-1" aria-labelledby="modalpagarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalpagarLabel">Registrar Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="was-validated">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="pagas_usuario" maxlength="16" class="form-control" required>
                            <div class="invalid-feedback">El usuario es obligatorio</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Recibió</label>
                            <input type="number" name="pagas_recibio" class="form-control" required>
                            <div class="invalid-feedback">El monto recibido es obligatorio</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Membresia usada</label>
                            <select name="pagas_motivo" class="form-select" id="pagas_motivo" required>
                                <option value="" disabled>Seleccionar</option>
                                <option value="Ninguno">Ninguno</option>
                                <option value="Guarda paga">Guarda paga</option>
                                <option value="Diamante">Diamante</option>
                            </select>
                            <div class="invalid-feedback">El motivo </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Pago Completo</label>
                            <select class="form-select" name="pagas_completo" id="pagas_completo" required>
                                <option value="" disabled>Seleccionar</option>
                                <option value="Nomina">Nomina</option>
                                <option value="Bonificacion">Bonificacion</option>
                                <option value="Completo">Completo</option>
                            </select>
                            <div class="invalid-feedback">Debe indicar si completo o no</div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Descripción</label>
                        <textarea name="pagas_descripcion" placeholder="Es opcional" maxlength="255" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardarPago" class="btn btn-success">Registrar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>