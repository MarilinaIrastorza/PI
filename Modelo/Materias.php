<?php

require_once("DBController.php");

class Materia {
    private $db_handle;

    function __construct() {
        $this->db_handle = new DBController();
    }

    function getAllMaterias() {
        $query = "SELECT * FROM tbl_materia ORDER BY nombre_materia";
        return $this->db_handle->runBaseQuery($query);
    }

    function getMateriasByEstudiante($estudiante_id) {
        $query = "SELECT m.* FROM tbl_materia m
                  INNER JOIN tbl_estudiante_materia em ON m.id = em.materia_id
                  WHERE em.estudiante_id = ?";
        $paramType = "i";
        $paramValue = array($estudiante_id);
        return $this->db_handle->runQuery($query, $paramType, $paramValue);
    }

    function asignarMateriaAEstudiante($estudiante_id, $materia_id) {
        $query = "INSERT INTO tbl_estudiante_materia (estudiante_id, materia_id) VALUES (?, ?)";
        $paramType = "ii";
        $paramValue = array($estudiante_id, $materia_id);
        return $this->db_handle->insert($query, $paramType, $paramValue);
    }

    
    function incrementarInscriptos($materia_id) {
        $query = "UPDATE tbl_materia SET inscriptos = inscriptos + 1 WHERE id = ?";
        $paramType = "i";
        $paramValue = array($materia_id);
        return $this->db_handle->update($query, $paramType, $paramValue);
    }
}
?>