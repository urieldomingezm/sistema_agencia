<?php
require_once(AUTH_DJ_PATH . 'auth.php');

class User {
    private $conn;
    private $table_name = "registro_usuario";

    public $id;
    public $usuario;
    public $password;
    public $rol_id;
    public $fecha_registro;
    public $ip_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function userExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE usuario_registro = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function ipRegistrations() {
        $query = "SELECT COUNT(*) AS total_registros FROM " . $this->table_name . " WHERE ip_registro = :ip";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ip', $this->ip_registro);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (usuario_registro, password_registro, rol_id, fecha_registro, ip_registro) 
                 VALUES (:usuario, :password, :rol_id, :fecha, :ip)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':rol_id', $this->rol_id);
        $stmt->bindParam(':fecha', $this->fecha_registro);
        $stmt->bindParam(':ip', $this->ip_registro);
        
        $success = $stmt->execute();
        
        if ($success) {
            $this->id = $this->conn->lastInsertId();
            $this->createUserSession();
        }
        
        return $success;
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
