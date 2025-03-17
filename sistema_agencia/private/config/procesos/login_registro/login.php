<?php
require_once(AUTH_DJ_PATH . 'auth.php');

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
        $query = "SELECT id, password_registro as password, rol_id FROM " . $this->table_name . " WHERE usuario_registro = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->execute();

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->rol_id = $row['rol_id'];

            // Corregir la comparación de contraseñas
            if ($this->password === $row['password']) {  // Cambiado de $this->password === $this->password
                $this->createUserSession();
                
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Inicio de sesión exitoso',
                        text: 'Redirigiendo...'
                    }).then(() => {
                        window.location.href = '/usuario/index.php';
                    });
                </script>";
                exit();
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contraseña incorrecta.'
                    }).then(() => {
                        window.location.href = '/login.php';
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Usuario no encontrado',
                    text: 'Por favor, verifique sus credenciales.'
                }).then(() => {
                    window.location.href = '/login.php';
                });
            </script>";
        }
    }

    private function createUserSession() {
        $_SESSION['user_id'] = $this->id;
        $_SESSION['username'] = $this->usuario;
        $_SESSION['rol_id'] = $this->rol_id;
        $_SESSION['logged_in'] = true;
    }

    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['rol_id']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }

    public function getCurrentUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    public function getCurrentUsername() {
        return $_SESSION['username'] ?? null;
    }

    public function getCurrentUserRole() {
        return $_SESSION['rol_id'] ?? null;
    }
}
?>
