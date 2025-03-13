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
        'Seguridad' => '00:45:00', // 45 minutos
        'Técnico' => '01:00:00', // 1 hora
        'Logística' => '01:15:00', // 1 hora 15 minutos
        'Supervisor' => '01:30:00', // 1 hora 30 minutos
        'Director' => '02:00:00', // 2 horas
        'Presidente' => '02:30:00', // 2 horas 30 minutos
        'Operativo' => '00:30:00' // 30 minutos
    ];

    return isset($horas[$rango]) ? $horas[$rango] : '00:30:00'; // Si no encuentra el rango, por defecto devuelve 30 minutos
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
            alert('Ascenso registrado exitosamente');
            window.location.href = '/usuario/index.php'; 
        </script>";
    } else {
        echo "<script>alert('Error al registrar ascenso');</script>";
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
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="ascenso_usuario" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Rango</label>
                                <select name="ascenso_rango" class="form-control" required onchange="cambiarHoraProxima()">
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
                                <input type="text" name="ascenso_mision_antigua" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Misión Nueva</label>
                                <input type="text" name="ascenso_mision_nueva" class="form-control">
                            </div>
                        </div>
                        <div class="mt-4">
<hr>
                            <div class="row">
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
                                    <input type="text" name="ascenso_hora_proxima" id="ascenso_hora_proxima" class="form-control" value="00:00:00" disabled required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">Encargado</label>
                                    <input type="text" name="ascenso_encargado_usuario" class="form-control" required>
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
        // Función para cambiar la hora según el rango seleccionado
        function cambiarHoraProxima() {
            var rango = document.querySelector('select[name="ascenso_rango"]').value;
            var horaProxima = document.getElementById('ascenso_hora_proxima');

            var horas = {
                'Agente': '00:30:00',
                'Seguridad': '00:45:00',
                'Técnico': '01:00:00',
                'Logística': '01:15:00',
                'Supervisor': '01:30:00',
                'Director': '02:00:00',
                'Presidente': '02:30:00',
                'Operativo': '00:30:00'
            };

            horaProxima.value = horas[rango] || '00:30:00'; // Cambiar la hora automáticamente según el rango
        }

        // Llamar a la función al cargar la página para asegurar que la hora está configurada por defecto
        window.onload = cambiarHoraProxima;
    </script>

</body>