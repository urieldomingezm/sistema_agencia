<?php
class GestionAscTime {
    private $conn;
    private $table_name = "gestion_asc_time";

    public $id_gestion;
    public $codigo_usuario;
    public $id_usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function codigoExists($codigo_usuario) {
        $query = "SELECT id_gestion FROM " . $this->table_name . " WHERE codigo_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo_usuario]);
        return $stmt->rowCount() > 0;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (codigo_usuario, id_usuario) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->codigo_usuario, $this->id_usuario]);
    }
}
?>