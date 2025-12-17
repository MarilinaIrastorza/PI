<?php 
require_once ("DBController.php");
class Rol
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addRol($rol) {
        $query = "INSERT INTO roles (rol) VALUES (?)";
        $paramType = "s";
        $paramValue = array(
            $rol
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editRol($rol, $id) {
        $query = "UPDATE roles SET rol  = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
            $rol,
            $id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteRol($rol_id) {
        $query = "DELETE FROM roles WHERE id = ?
                    AND NOT EXISTS (Select 1 FROM usuario 
                    WHERE id_rol=roles.id)";
        $paramType = "i";
        $paramValue = array(
            $rol_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
        // verificar líneas afectadas
    }
    
    function getRolById($id) {
        $query = "SELECT * FROM roles WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllRol() {
        $sql = "SELECT * FROM roles ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>