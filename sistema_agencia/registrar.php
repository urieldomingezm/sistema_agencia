<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');
require_once(CONFIG_PATH . 'bd.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(PROCESOS_LOGIN_PATH . 'registrar.php');

$database = new Database();
$conn = $database->getConnection();

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

            $user->password_registro = $password;
            $user->rol_id = 1;
            $user->fecha_registro = date('Y-m-d H:i:s');

            if ($user->create()) {
                echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = '/sistema_agencia/login.php';</script>";
            } else {
                echo "<script>alert('Error en el registro. Inténtelo nuevamente.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos correctamente.'); window.location.href = '/sistema_agencia/registrar.php';</script>";
    }
}

require_once(PROCESOS_LOGIN_PATH . 'body_registrar.php');
require_once(TEMPLATES_PATH . 'footer.php');
?>
