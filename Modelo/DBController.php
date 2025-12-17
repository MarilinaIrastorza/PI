<?php
class DBController {
    // 🔐 Datos de conexión
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "c";
    private $conn;

    // 🔌 Constructor: establece conexión al instanciar
    function __construct() {
        $this->conn = $this->connectDB();
    }

    // 🔗 Método privado para conectar con MySQL
    public function connectDB() {
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);

    }
   
    // 📋 Consulta sin parámetros (SELECT simple)
    public function runBaseQuery($query) {
        $result = $this->conn->query($query);
        $resultset = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    // 📌 Consulta con parámetros (SELECT con WHERE, etc.)
    public function runQuery($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        $resultset = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    // 🧷 Enlaza parámetros a la consulta preparada
    private function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = &$param_type;
        foreach ($param_value_array as $key => $value) {
            $param_value_reference[] = &$param_value_array[$key];
        }
        call_user_func_array([$sql, 'bind_param'], $param_value_reference);
    }

    // ➕ Inserta registros
    public function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        return $sql->insert_id;
    }

    // ✏️ Actualiza registros
    public function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
    }

    // 🧪 Ejecuta consulta directa
    public function execute($query) {
        return $this->conn->query($query);
    }

    // 🔄 Devuelve conexión activa
    public function getConnection() {
        return $this->conn;
    }


}
?>