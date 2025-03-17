<?php
session_start();

require_once(__DIR__ . '/config.php');
require_once(CONFIG_PATH . 'bd.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(PROCESOS_LOGIN_PATH . 'login.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->usuario = isset($_POST['login_usuario']) ? htmlspecialchars($_POST['login_usuario']) : '';
    $user->password = isset($_POST['login_password']) ? htmlspecialchars($_POST['login_password']) : '';

    if (!empty($user->usuario) && !empty($user->password)) {
        $user->login();
    } else {
        echo "<script>
                alert('Por favor, complete todos los campos.');
                window.location.href = '/sistema_agencia/login.php';
              </script>";
    }
}

require_once(PROCESOS_LOGIN_PATH . 'body_login.php');
require_once(TEMPLATES_PATH . 'footer.php');
?>