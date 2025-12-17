<?php
require_once ("../Modelo/DBController.php");
require_once ("../Modelo/Attendance.php");

class Student
{
    private $db_handle;

    function __construct() {
        $this->db_handle = new DBController();
    }

    function addStudent($name, $dob, $class, $id_materia) {
        $query = "INSERT INTO tbl_estudiante (nombres, fecha_estudiante, clase, id_materia) VALUES (?, ?, ?, ?)";
        $paramType = "sssi";
        $paramValue = array($name, $dob, $class, $id_materia);

        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }

    function editStudent($name, $dob, $class, $student_id, $id_materia, $rolUsuario) {
        if ($rolUsuario !== 'admin') {
            return [
                'success' => false,
                'message' => 'No tenés permisos para editar estudiantes.'
            ];
        }

        $query = "UPDATE tbl_estudiante SET nombres = ?, id_materia = ?, fecha_estudiante = ?, clase = ? WHERE id = ?";
        $paramType = "sissi";
        $paramValue = array($name, $id_materia, $dob, $class, $student_id);

        $this->db_handle->update($query, $paramType, $paramValue);

        return [
            'success' => true,
            'message' => 'Estudiante editado correctamente.'
        ];
    }

    function deleteStudent($student_id, $rolUsuario) {
        if ($rolUsuario !== 'admin') {
            return [
                'success' => false,
                'message' => 'No tenés permisos para eliminar estudiantes.'
            ];
        }

        // Validar si tiene materias asociadas
        $query = "SELECT COUNT(*) AS total FROM tbl_estudiante_materia WHERE estudiante_id = ?";
        $result = $this->db_handle->runQuery($query, "i", [$student_id]);

        if ($result && $result[0]['total'] > 0) {
            return [
                'success' => false,
                'message' => 'Este estudiante tiene materias asociadas. No se puede eliminar.'
            ];
        }

        $query = "DELETE FROM tbl_estudiante WHERE id = ?";
        $paramType = "i";
        $paramValue = array($student_id);

        $this->db_handle->update($query, $paramType, $paramValue);

        return [
            'success' => true,
            'message' => 'Estudiante eliminado correctamente.'
        ];
    }

    function getStudentById($student_id) {
        $query = "SELECT * FROM tbl_estudiante WHERE id = ?";
        $paramType = "i";
        $paramValue = array($student_id);

        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function getAllStudent() {
        $sql = "SELECT * FROM tbl_estudiante ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getEstudiantesPorMateria($materia_id) {
        $query = "SELECT e.* FROM tbl_estudiante e
                  INNER JOIN tbl_estudiante_materia em ON e.id = em.estudiante_id
                  WHERE em.materia_id = ?";
        $paramType = "i";
        $paramValue = array($materia_id);
        return $this->db_handle->runQuery($query, $paramType, $paramValue);
    }
}
?>