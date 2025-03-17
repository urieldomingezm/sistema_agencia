<?php
require_once(__DIR__ . '/config.php');
require_once(CONFIG_PATH . 'bd.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(PROCESOS_LOGIN_PATH . 'registrar.php');

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = isset($_POST['registro_usuario']) ? htmlspecialchars(trim($_POST['registro_usuario'])) : '';
    $password = isset($_POST['registro_password']) ? trim($_POST['registro_password']) : '';
    $ip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

    if (!empty($usuario) && !empty($password)) {
        $user = new User($conn);
        $user->usuario = $usuario;
        $user->password = $password;
        $user->ip_registro = $ip_usuario;

        if ($user->userExists()) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El usuario ya existe.'
                }).then(() => {
                    window.location.href = '/registrar.php';
                });
            </script>";
        } else {
            if ($user->ipRegistrations() >= 1) {
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Se han registrado más de 2 veces desde esta IP. Por favor, contacte al soporte.'
                    }).then(() => {
                        window.location.href = '/registrar.php';
                    });
                </script>";
                exit;
            }

            $user->rol_id = 1;
            $user->fecha_registro = date('Y-m-d H:i:s');

            if ($user->create()) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'Bienvenido, " . $usuario . "'
                    }).then(() => {
                        window.location.href = '/usuario/index.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en el registro. Inténtelo nuevamente.'
                    }).then(() => {
                        window.location.href = '/registrar.php';
                    });
                </script>";
            }
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'info',
                title: 'Atención',
                text: 'Por favor, complete todos los campos correctamente.'
            }).then(() => {
                window.location.href = '/registrar.php';
            });
        </script>";
    }
}

require_once(PROCESOS_LOGIN_PATH . 'body_registrar.php');
require_once(TEMPLATES_PATH . 'footer.php');
?>
