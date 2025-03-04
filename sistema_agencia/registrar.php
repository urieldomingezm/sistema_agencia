<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');
require_once(CONFIG_PATH . 'db.php');
require_once(TEMPLATES_PATH . 'header.php');

function generarCodigoUnico($conn)
{
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 6;
    $codigo_unico = '';

    do {
        $codigo_unico = '';
        for ($i = 0; $i < $longitud; $i++) {
            $codigo_unico .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        $sql_verificar = "SELECT id_gestion FROM gestion_asc_time WHERE codigo_usuario = ?";
        $stmt_verificar = $conn->prepare($sql_verificar);
        $stmt_verificar->bind_param("s", $codigo_unico);
        $stmt_verificar->execute();
        $stmt_verificar->store_result();
    } while ($stmt_verificar->num_rows > 0);

    $stmt_verificar->close();
    return $codigo_unico;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = isset($_POST['registro_usuario']) ? htmlspecialchars(trim($_POST['registro_usuario'])) : '';
    $password = isset($_POST['registro_password']) ? trim($_POST['registro_password']) : '';
    $ip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

    if (!empty($usuario) && !empty($password)) {
        $sql = "SELECT id FROM registro_usuario WHERE usuario_registro = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El usuario ya existe.'); window.location.href = '/agenciaunica/register.php';</script>";
        } else {
            $sql_ip = "SELECT COUNT(*) AS total_registros FROM registro_usuario WHERE ip_registro = ?";
            $stmt_ip = $conn->prepare($sql_ip);
            $stmt_ip->bind_param("s", $ip_usuario);
            $stmt_ip->execute();
            $stmt_ip->store_result();
            $stmt_ip->bind_result($total_registros);
            $stmt_ip->fetch();

            if ($total_registros >= 1) {
                echo "<script>alert('Se han registrado más de 2 veces desde esta IP. Por favor, contacte al soporte.'); window.location.href = '/agenciaunica/register.php';</script>";
                exit;
            }

            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $rol_id = 1;
            $rango_asignado = 1;
            $fecha_registro = date('Y-m-d H:i:s');

            $sql_insert = "INSERT INTO registro_usuario (usuario_registro, password_registro, rol_id, fecha_registro, ip_registro, Rango_asignado) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ssisss", $usuario, $password_hashed, $rol_id, $fecha_registro, $ip_usuario, $rango_asignado);

            if ($stmt_insert->execute()) {
                $id_persona = $stmt_insert->insert_id;
                $codigo_usuario = generarCodigoUnico($conn);

                $sql_insert_codigo = "INSERT INTO gestion_asc_time (codigo_usuario, id_usuario) VALUES (?, ?)";
                $stmt_insert_codigo = $conn->prepare($sql_insert_codigo);
                $stmt_insert_codigo->bind_param("si", $codigo_usuario, $id_persona);

                if ($stmt_insert_codigo->execute()) {
                    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = '/agenciaunica/login.php';</script>";
                } else {
                    echo "<script>alert('Error al generar el código único. Inténtelo nuevamente.'); window.location.href = '/agenciaunica/register.php';</script>";
                }
                $stmt_insert_codigo->close();
            } else {
                echo "<script>alert('Error en el registro. Inténtelo nuevamente.'); window.location.href = '/agenciaunica/register.php';</script>";
            }
        }
        $stmt->close();
        $stmt_ip->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos correctamente.'); window.location.href = '/agenciaunica/register.php';</script>";
    }
}

$conn->close();
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