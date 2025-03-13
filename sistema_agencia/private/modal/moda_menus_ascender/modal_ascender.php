<?php
require_once(CONFIG_PATH . 'bd.php');

class Ascenso
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrarAscenso($usuario, $rango, $mision_antigua, $mision_nueva, $firma, $motivo, $hora_proxima, $encargado)
    {
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

// Función para obtener la hora según el rango
function obtenerHoraPorRango($rango)
{
    $horas = [
        'Agente' => '00:30:00', // 30 minutos
        'Seguridad' => '02:00:00', // 2 horas
        'Técnico' => '24:00:00', // 24 horas
        'Logística' => '48:00:00', // 62 horas
        'Supervisor' => '72:30:00', // 3 dias
        'Director' => '120:00:00', // 5 dias
        'Presidente' => '168:00:00', // 7 dias
        'Operativo' => '216:00:00' // 9 dias
    ];

    return isset($horas[$rango]) ? $horas[$rango] : '00:00:00';
}

// Procesar formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardarAscenso'])) {
    $rango = $_POST['ascenso_rango'];
    $hora_proxima = obtenerHoraPorRango($rango);
    $database = new Database();
    $db = $database->getConnection();
    $ascenso = new Ascenso($db);

    $resultado = $ascenso->registrarAscenso(
        $_POST['ascenso_usuario'],
        $rango,
        $_POST['ascenso_mision_antigua'],
        $_POST['ascenso_mision_nueva'],
        $_POST['ascenso_firma'],
        $_POST['ascenso_motivo'],
        $hora_proxima, // Hora determinada según el rango
        $_POST['ascenso_encargado_usuario']
    );

    if ($resultado) {
        echo "<script>
        Swal.fire({
            title: '¡Éxito!',
            text: 'Ascenso registrado exitosamente',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=gestion de ascensos';
            }
        });
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: '¡Error!',
            text: 'Error al registrar ascenso',
            icon: 'error',
            confirmButtonText: 'Intentar de nuevo'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/usuario/index.php?page=gestion de ascensos';
            }
        });
    </script>";
    }
}
?>

<body>

    <!-- Modal para Dar Ascenso -->
    <div class="modal fade" id="modalAscenso" tabindex="-1" aria-labelledby="modalAscensoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalAscensoLabel">Dar Ascenso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="was-validated">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="ascenso_usuario" maxlength="14" class="form-control" required>
                                <div class="invalid-feedback">Nombre de usuario importante</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Rango</label>
                                <select name="ascenso_rango" class="form-control" required onchange="cambiarHoraProxima()">
                                    <option value="" disabled round>Seleccionar</option>
                                    <option value="Agente">Agente</option>
                                    <option value="Seguridad">Seguridad</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Logística">Logística</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Director">Director</option>
                                    <option value="Presidente">Presidente</option>
                                    <option value="Operativo">Operativo</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Misión Antigua</label>
                                <input type="text" name="ascenso_mision_antigua" required class="form-control">
                                <div class="invalid-feedback">Mision de antigua agencia</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Misión Nueva</label>
                                <input type="text" name="ascenso_mision_nueva" required placeholder="SNY- Agente -I -XDD #" class="form-control">
                                <div class="invalid-feedback">Mision correspondiente</div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Firma</label>
                                    <input type="text" name="ascenso_firma" required maxlength="3" class="form-control">
                                    <div class="invalid-feedback">Firma de 3 digitos en mayusculas</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Motivo</label>
                                    <select name="ascenso_motivo" class="form-control" required>
                                        <option value="" disabled round>Seleccionar</option>
                                        <option value="Cumple el tiempo">Cumple el tiempo</option>
                                        <option value="Traslado">Traslado</option>
                                        <option value="Aspirante">Aspirante</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Horas para ascenso</label>
                                    <input type="text" name="ascenso_hora_proxima" id="ascenso_hora_proxima" class="form-control" value="00:00:00" disabled required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Encargado</label>
                                    <input type="text" name="ascenso_encargado_usuario" required maxlength="16" class="form-control" required>
                                    <div class="invalid-feedback">Nombre de encargado importante</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="guardarAscenso" class="btn btn-success">Registrar ascenso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cambiarHoraProxima() {
            var rango = document.querySelector('select[name="ascenso_rango"]').value;
            var horaProxima = document.getElementById('ascenso_hora_proxima');

            var horas = {
                'Agente': '00:30:00',
                'Seguridad': '02:00:00',
                'Técnico': '24:00:00',
                'Logística': '48:00:00',
                'Supervisor': '72:30:00',
                'Director': '120:00:00',
                'Presidente': '168:00:00',
                'Operativo': '216:00:00'
            };

            horaProxima.value = horas[rango] || '00:00:00'; // Cambiar la hora automáticamente según el rango
        }

        window.onload = cambiarHoraProxima;
    </script>

</body>