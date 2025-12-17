<?php 
require_once ("../Modelo/DBController.php");
class Attendance {
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addAttendance($attendance_date, $student_id, $present, $absent) {
        $query = "INSERT INTO tbl_asistencia (asistencia_fecha,estudiante_id,presente,ausente) VALUES (?, ?, ?, ?)";
        $paramType = "siii";
        $paramValue = array(
            $attendance_date,
            $student_id,
            $present,
            $absent
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function deleteAttendanceByDate($attendance_date) {
        $query = "DELETE FROM tbl_asistencia WHERE asistencia_fecha = ?";
        $paramType = "s";
        $paramValue = array(
            $attendance_date
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getAttendanceByDate($attendance_date) {
        $query = "SELECT * FROM tbl_asistencia LEFT JOIN tbl_estudiante ON tbl_asistencia.estudiante_id = tbl_estudiante.id WHERE asistencia_fecha = ? ORDER By estudiante_id";
        $paramType = "s";
        $paramValue = array(
            $attendance_date
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAttendance() {
        $sql = "SELECT id, asistencia_fecha, sum(presente) as presente, sum(ausente) as ausente FROM tbl_asistencia GROUP By asistencia_fecha";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>