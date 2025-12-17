<?php
class Contacto {
  private $db; 

  public function __construct($dbController) {
    $this->db = $dbController->connectDB(); 
  }

  public function addContacto($nombre, $apellido, $email, $fecha, $comentario, $interes, $nacionalidad) {
    $stmt = $this->db->prepare("INSERT INTO contacto (nombre, apellido, email, fecha, comentario, interes, nacionalidad) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellido, $email, $fecha, $comentario, $interes, $nacionalidad);
    $stmt->execute();
    $stmt->close();
  }
}
?>

