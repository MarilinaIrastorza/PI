<?php
// 🔧 Variables globales (nombre del sitio, menú, etc.)
include_once ('../php/includes/variables_globales.php');

// 🧩 Modelo necesarias
require_once "../Modelo/DBController.php";
require_once "../Modelo/Docente.php";

// 🔌 Instancia de conexión y clase Docente
$db = new DBController();
$docente = new Docente($db);

// ➕ Procesa formulario de alta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $legajo = $_POST["legajo"];
    $especialidad = $_POST["especialidad"];
    $email = $_POST["email"];
    $docente->addDocente($nombre, $legajo, $especialidad, $email);
    header("Location: docentes.php");
    exit;
}

// 📋 Carga listado de docentes
$lista = $docente->getAllDocentes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado de Docentes</title>

  <!-- 🎨 Estilos visuales -->
  <link rel="stylesheet" href="../mainfile/css/estilos_de_contenido.css">
 
  <style>
    body { font-family: Arial; margin: 2em; }
    table { border-collapse: collapse; width: 100%; margin-top: 1em; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    form { margin-top: 2em; }
    input[type="text"], input[type="email"] { width: 100%; padding: 6px; margin: 4px 0; }
    input[type="submit"] { padding: 8px 16px; background-color: #4CAF50; color: white; border: none; }
  </style>
</head>
<body>

  <!-- 🧩 Encabezado -->
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

  <!-- 📌 Menú -->
  <nav class="nav">
    <?= $nav_menu ?>
  </nav>

  <!-- 📋 Tabla de docentes -->
  <h3>Listado de Docentes</h3>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Legajo</th>
      <th>Especialidad</th>
      <th>Email</th>
    </tr>
    <?php foreach ($lista as $doc): ?>
    <tr>
      <td><?= htmlspecialchars($doc["nombre"]) ?></td>
      <td><?= htmlspecialchars($doc["legajo"]) ?></td>
      <td><?= htmlspecialchars($doc["especialidad"]) ?></td>
      <td><?= htmlspecialchars($doc["email"]) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

  <!-- ➕ Formulario de alta -->
  <form method="POST">
    <h3>Agregar nuevo docente</h3>
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Legajo:</label>
    <input type="text" name="legajo" required>
    <label>Especialidad:</label>
    <input type="text" name="especialidad" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <input type="submit" value="Agregar">
  </form>

</body>
</html>