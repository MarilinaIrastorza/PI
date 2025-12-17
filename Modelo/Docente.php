<?php
require_once "DBController.php";

class Docente {
    private $db_handle;

    // 🧩 Recibe instancia de DBController
    public function __construct($db) {
        $this->db_handle = $db;
    }

    // 📋 Devuelve todos los docentes
    public function getAllDocentes() {
        $query = "SELECT * FROM docentes";
        return $this->db_handle->runBaseQuery($query);
    }

    // ➕ Agrega un nuevo docente
    public function addDocente($nombre, $legajo, $especialidad, $email) {
        $query = "INSERT INTO docentes (nombre, legajo, especialidad, email) VALUES (?, ?, ?, ?)";
        $param_type = "ssss";
        $param_value_array = [$nombre, $legajo, $especialidad, $email];
        return $this->db_handle->insert($query, $param_type, $param_value_array);
    }
}
?>