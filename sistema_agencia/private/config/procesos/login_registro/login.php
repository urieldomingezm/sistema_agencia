<?php
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

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // Importar SweetAlert2

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->password = $row['password_registro'];
            $this->rol_id = $row['rol_id'];

            if ($this->password === $row['password_registro']) { 
                $_SESSION['id_usuario'] = $this->id;
                $_SESSION['usuario_registro'] = $this->usuario;
                $_SESSION['rol_id'] = $this->rol_id;

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
}
?>
