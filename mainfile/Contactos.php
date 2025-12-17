<?php
include_once('../php/includes/variables_globales.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet"  href="../mainfile/css/estilos_de_contenido.css">
   <link rel="stylesheet" href="../mainfile/css/formulario_contacto.css">
</head>
<body>
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

  <nav class="nav"><?= $nav_menu1 ?></nav>

  <?php
require_once "../Modelo/DBController.php";
require_once "../Modelo/Contacto.php";

// 🔌 Instancia de conexión y clase Docente
$db = new DBController();
$Contacto = new Contacto($db);

// ➕ Procesa formulario de alta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Email = $_POST["Email"];
    $Fecha = $_POST["Fecha"];
    $Comentario = $_POST["Comentario"];
    $Interes = $_POST["Interes"];
    $Nacionalidad = $_POST["Nacionalidad"];
    $Contacto->addContacto($Nombre, $Apellido, $Email, $Fecha, $Comentario, $Interes, $Nacionalidad);
    header("Location: Contactos.php");
    exit;
}
   
  ?>
  <section class="formulario_contacto">
  <h3>Formulario de contacto</h3>
  <form method="POST" action="">
    <label for="Nombre">Nombre:</label> </br>
    <input type="text" name="Nombre" id="Nombre" required>

    <label for="Apellido">Apellido:</label></br>
    <input type="text" name="Apellido" id="Apellido" required>

    <label for="Email">Email:</label></br>
    <input type="email" name="Email" id="Email" required>

    <label for="Fecha">Fecha de contacto:</label></br>
    <input type="date" name="Fecha" id="Fecha" required>

    <label for="Comentario">Comentario:</label></br>
    <textarea name="Comentario" id="Comentario" rows="4" required></textarea>

    <label for="Interes">Área de interés:</label></br>
    <input type="text" name="Interes" id="Interes">

    <label for="Nacionalidad">Nacionalidad:</label></br>
    <input type="text" name="Nacionalidad" id="Nacionalidad">

    <button type="submit">Enviar</button>
  </form>
</section>


  <footer><?= $footer ?></footer>
</body>
</html>