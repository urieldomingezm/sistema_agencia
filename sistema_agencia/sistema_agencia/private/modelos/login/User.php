<?php
class User {
    private $conn;
    private $table_name = "registro_usuario";

    public $id;
    public $usuario_registro;
    public $password_registro;
    public $rol_id;
    public $fecha_registro;
    public $ip_registro;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function userExists() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE usuario_registro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->usuario_registro]);
        return $stmt->rowCount() > 0;
    }

    public function ipRegistrations() {
        $query = "SELECT COUNT(*) AS total_registros FROM " . $this->table_name . " WHERE ip_registro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->ip_registro]);
        return $stmt->fetchColumn();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (usuario_registro, password_registro, rol_id, fecha_registro, ip_registro) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->usuario_registro, $this->password_registro, $this->rol_id, $this->fecha_registro, $this->ip_registro]);
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>