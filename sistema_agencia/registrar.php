<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');
require_once(CONFIG_PATH . 'bd.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MODAL_PATH . 'User.php');
require_once(MODAL_PATH . 'GestionAscTime.php');

$database = new Database();
$conn = $database->getConnection();

function generarCodigoUnico($conn) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 6;
    $codigo_unico = '';
    $gestionAscTime = new GestionAscTime($conn);

    do {
        $codigo_unico = '';
        for ($i = 0; $i < $longitud; $codigo_unico .= $caracteres[rand(0, strlen($caracteres) - 1)], $i++);
    } while ($gestionAscTime->codigoExists($codigo_unico));

    return $codigo_unico;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = isset($_POST['registro_usuario']) ? htmlspecialchars(trim($_POST['registro_usuario'])) : '';
    $password = isset($_POST['registro_password']) ? trim($_POST['registro_password']) : '';
    $ip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

    if (!empty($usuario) && !empty($password)) {
        $user = new User($conn);
        $user->usuario_registro = $usuario;
        $user->ip_registro = $ip_usuario;

        if ($user->userExists()) {
            echo "<script>alert('El usuario ya existe.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
        } else {
            if ($user->ipRegistrations() >= 1) {
                echo "<script>alert('Se han registrado más de 2 veces desde esta IP. Por favor, contacte al soporte.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
                exit;
            }

            $user->password_registro = password_hash($password, PASSWORD_DEFAULT);
            $user->rol_id = 1;
            $user->fecha_registro = date('Y-m-d H:i:s');

            if ($user->create()) {
                $id_persona = $user->getLastInsertId();
                $codigo_usuario = generarCodigoUnico($conn);

                $gestionAscTime = new GestionAscTime($conn);
                $gestionAscTime->codigo_usuario = $codigo_usuario;
                $gestionAscTime->id_usuario = $id_persona;

                if ($gestionAscTime->create()) {
                    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = '/sistema_agencia/login.php';</script>";
                } else {
                    echo "<script>alert('Error al generar el código único. Inténtelo nuevamente.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
                }
            } else {
                echo "<script>alert('Error en el registro. Inténtelo nuevamente.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos correctamente.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
    }
}
?>

<body>
    <div class="register-container">
        <h2>Registrar Usuario</h2>

        <form id="registerForm" method="POST">
            <input type="text" name="registro_usuario" id="registro_usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="registro_password" id="registro_password" placeholder="Contraseña" required>
            <button type="submit">Registrar</button>
        </form>
        <div class="login-link">
            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
        </div>
    </div>
</body>