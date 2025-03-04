<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');
require_once(CONFIG_PATH . 'db.php');
require_once(TEMPLATES_PATH . 'header.php');

class User {
    private $conn;
    private $table_name = "registro_usuario";

    public $id;
    public $usuario;
    public $password;
    public $rol_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $query = "SELECT id, password_registro, rol_id FROM " . $this->table_name . " WHERE usuario_registro = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->password = $row['password_registro'];
            $this->rol_id = $row['rol_id'];

            if (password_verify($this->password, $row['password_registro'])) {
                $_SESSION['id_usuario'] = $this->id;
                $_SESSION['usuario_registro'] = $this->usuario;
                $_SESSION['rol_id'] = $this->rol_id;

                header("Location: /sistema_agencia/usuario/index.php");
                exit();
            } else {
                echo "<script>
                        alert('Contraseña incorrecta.');
                        window.location.href = '/sistema_agencia/login.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Usuario no encontrado.');
                    window.location.href = '/sistema_agencia/login.php';
                  </script>";
        }
    }
}

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
?>


<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" method="POST">
            <input type="text" id="exampleInputUsername" name="login_usuario" placeholder="Nombre de usuario" required>
            <input type="password" id="exampleInputPassword" name="login_password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <div class="register-link">
            ¿No tienes cuenta? <a href="registrar.php">Regístrate gratis</a>
        </div>
    </div>
</body>