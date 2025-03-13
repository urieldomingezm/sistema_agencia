<?php
require_once(CONFIG_PATH . 'bd.php'); // Archivo con la clase Database

class Ascenso {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarAscenso($usuario, $rango, $mision_antigua, $mision_nueva, $firma, $motivo, $hora_proxima, $encargado) {
        try {
            $sql = "INSERT INTO gestion_ascenso 
                    (ascenso_usuario, ascenso_rango, ascenso_mision_antigua, ascenso_mision_nueva, ascenso_firma, ascenso_status, ascenso_motivo, ascenso_hora_proxima, ascenso_encargado_usuario, ascenso_fecha_registro) 
                    VALUES (:usuario, :rango, :mision_antigua, :mision_nueva, :firma, 'en proceso', :motivo, :hora_proxima, :encargado, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':rango', $rango);
            $stmt->bindParam(':mision_antigua', $mision_antigua);
            $stmt->bindParam(':mision_nueva', $mision_nueva);
            $stmt->bindParam(':firma', $firma);
            $stmt->bindParam(':motivo', $motivo);
            $stmt->bindParam(':hora_proxima', $hora_proxima);
            $stmt->bindParam(':encargado', $encargado);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar ascenso: " . $e->getMessage());
            return false;
        }
    }
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarAscenso'])) {
    $database = new Database();
    $db = $database->getConnection();
    $ascenso = new Ascenso($db);

    $resultado = $ascenso->registrarAscenso(
        $_POST['ascenso_usuario'],
        $_POST['ascenso_rango'],
        $_POST['ascenso_mision_antigua'],
        $_POST['ascenso_mision_nueva'],
        $_POST['ascenso_firma'],
        $_POST['ascenso_motivo'],
        $_POST['ascenso_hora_proxima'],
        $_POST['ascenso_encargado_usuario']
    );

    if ($resultado) {
        echo "<script>
            alert('Ascenso registrado exitosamente');
            window.location.href = '/usuario/index.php'; 
        </script>";
    } else {
        echo "<script>alert('Error al registrar ascenso');</script>";
    }
}
?>


<!-- metodo get
 
if ($resultado) {
    $usuario = urlencode($_POST['ascenso_usuario']);
    $rango = urlencode($_POST['ascenso_rango']);

    echo "<script>
        alert('Ascenso registrado exitosamente');
        window.location.href = '/usuario/GSAS.php?usuario=$usuario&rango=$rango'; 
    </script>";
} else {
    echo "<script>alert('Error al registrar ascenso');</script>";
}
-->

<!-- Modal para Dar Ascenso -->
<div class="modal fade" id="modalAscenso" tabindex="-1" aria-labelledby="modalAscensoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAscensoLabel">Dar Ascenso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="ascenso_usuario" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Rango</label>
                            <input type="text" name="ascenso_rango" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Misión Antigua</label>
                            <input type="text" name="ascenso_mision_antigua" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Misión Nueva</label>
                            <input type="text" name="ascenso_mision_nueva" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Firma</label>
                            <input type="text" name="ascenso_firma" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Motivo</label>
                            <input type="text" name="ascenso_motivo" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Hora Próxima</label>
                            <input type="time" name="ascenso_hora_proxima" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label">Encargado</label>
                            <input type="text" name="ascenso_encargado_usuario" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" name="guardarAscenso" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
