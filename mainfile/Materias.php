<?php 
// 🔧 Incluye variables globales como nombre del sitio, menú y pie de página
include_once ('../php/includes/variables_globales.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 🎨 Estilos visuales para contenido y maquetación -->
  <link rel="stylesheet" href="../mainfile/css/estilos_de_contenido.css">
 
</head>
<body>

  <!-- 🧩 Encabezado del sitio con nombre principal y secundario -->
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

  <!-- 📌 Menú de navegación dinámico -->
  <nav class="nav">
    <?= $nav_menu ?>
  </nav>

<?php
require_once '../Modelo/Materias.php'; 
require_once '../Modelo/Student.php';

$materiaModel = new Materia();
$listado = $materiaModel->getAllMaterias();

// Procesamiento del formulario
if (isset($_POST["add"])) {
    $studentModel = new Student();

    $name = $_POST["name"];
    $roll_number = $_POST["roll_number"];
    $dob = !empty($_POST["dob"]) ? date("Y-m-d", strtotime($_POST["dob"])) : "";
    $class = $_POST["class"];
    $materiaId = $_POST["materia_id"];

    // 1. Agregar estudiante
    $studentId = $studentModel->addStudent($name, $roll_number, $dob, $class);

    // 2. Asignar materia
    $materiaModel->asignarMateriaAEstudiante($studentId, $materiaId);

    // 3. Actualizar inscriptos
    $materiaModel->incrementarInscriptos($materiaId);

    echo "<div style='color: green;'>✅ Estudiante agregado y materia asignada correctamente.</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Materias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }

        h3 {
            color: #333;
            margin-bottom: 10px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-bottom: 30px;
        }

        form label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #444;
        }

        form input[type="text"],
        form input[type="date"],
        form select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            margin-top: 15px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>


<h3>Listado de materias</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cupos Totales</th>
        <th>Inscriptos</th>
        <th>Vacantes</th>
    </tr>
    <?php
    foreach ($listado as $materia) {
        $vacantes = $materia['cuposTotales'] - $materia['inscriptos'];
        echo "<tr>
                <td>{$materia['id']}</td>
                <td>{$materia['nombre_materia']}</td>
                <td>{$materia['cuposTotales']}</td>
                <td>{$materia['inscriptos']}</td>
                <td>{$vacantes}</td>
              </tr>";
    }
    ?>
</table>
<!-- 📎 Pie de página dinámico -->
<footer>
  <?= $footer ?>
</footer>
</body>
</html>

