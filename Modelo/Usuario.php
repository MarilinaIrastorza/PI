<?php
require_once(__DIR__ . '/DBController.php');

class Usuario
{
    private $db_handle;

    public function __construct() {
        $this->db_handle = new DBController();
    }

    // Agregar usuario
    public function addUsuario($usuario, $password, $rol) {
        $query = "INSERT INTO usuario (usuario, password, id_rol) VALUES (?, ?, ?)";
        $paramType = "ssi";
        $paramValue = [$usuario, $password, $rol];
        return $this->db_handle->insert($query, $paramType, $paramValue);
    }

    // Editar usuario
    public function editUsuario($usuario, $password, $rol, $id) {
        $query = "UPDATE usuario SET usuario = ?, password = ?, id_rol = ? WHERE id = ?";
        $paramType = "ssii";
        $paramValue = [$usuario, $password, $rol, $id];
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    // Eliminar usuario
    public function deleteUsuario($usuario_id) {
        $query = "DELETE FROM usuario WHERE id = ?";
        $paramType = "i";
        $paramValue = [$usuario_id];
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    // Obtener usuario por ID
    public function getUsuarioById($usuario_id) {
        $query = "SELECT * FROM usuario WHERE id = ?";
        $paramType = "i";
        $paramValue = [$usuario_id];
        return $this->db_handle->runQuery($query, $paramType, $paramValue);
    }

    // Verificar contraseña
    public function pwdVerify($name, $password) {
        $query = "SELECT * FROM usuario WHERE usuario = ?";
        $paramType = "s";
        $paramValue = [$name];
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);

        if ($result && count($result) === 1) {
            if (password_verify($password, $result[0]["password"])) {
                return $result;
            }
        }
        return false;
    }

    // Obtener nombre del rol por ID
    public function getNombreRol($id_rol) {
        $query = "SELECT rol FROM roles WHERE id = ?";
        $paramType = "i";
        $paramValue = [$id_rol];
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result ? $result[0]["rol"] : null;
    }

    // Obtener nombre del rol por ID de usuario
    public function obtenerRol($idUsuario) {
        $query = "SELECT roles.rol 
                  FROM usuario 
                  INNER JOIN roles ON usuario.id_rol = roles.id 
                  WHERE usuario.id = ?";
        $paramType = "i";
        $paramValue = [$idUsuario];
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result ? $result[0]["rol"] : null;
    }

    // Obtener todos los usuario con su rol
    public function getAllUsuario() {
        $sql = "SELECT usuario.*, roles.rol
                FROM usuario
                INNER JOIN roles ON usuario.id_rol = roles.id
                ORDER BY usuario.id";
        return $this->db_handle->runBaseQuery($sql);
    }
}
?>