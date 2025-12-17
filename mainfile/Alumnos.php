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
// 🧠 Carga Modelo necesarias desde PI/Modelo/
require_once ("../Modelo/DBController.php");
require_once ("../Modelo/Student.php");
require_once ("../Modelo/Attendance.php");
require_once ("../Modelo/Materias.php");

// 🔌 Instancia controlador de base de datos
$db_handle = new DBController();

// 🔍 Determina la acción a ejecutar según el parámetro GET
$action = !empty($_GET["action"]) ? $_GET["action"] : "default";

// 🔄 Controlador principal de acciones
switch ($action) {

    // ➕ Agregar asistencia
    case "attendance-add":
        if (isset($_POST['add'])) {
            $attendance = new Attendance();
            $attendance_date = date("Y-m-d", strtotime($_POST["attendance_date"]));

            // 🧾 Si hay estudiantes seleccionados, elimina registros previos y guarda nuevos
            if (!empty($_POST["student_id"])) {
                $attendance->deleteAttendanceByDate($attendance_date);
                foreach ($_POST["student_id"] as $student_id) {
                    $present = ($_POST["attendance-$student_id"] == "present") ? 1 : 0;
                    $absent = ($_POST["attendance-$student_id"] == "absent") ? 1 : 0;
                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            // 🔁 Redirige al listado de asistencias
         header("Location: ../Alumnos.php?action=attendance");
        }

        // 📋 Carga listado de estudiantes para el formulario
        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once __DIR__ . "/attendance-add.php";
        break;

    // ✏️ Editar asistencia
    case "attendance-edit":
        $attendance_date = $_GET["date"];
        $attendance = new Attendance();

        if (isset($_POST['add'])) {
            $attendance->deleteAttendanceByDate($attendance_date);
            if (!empty($_POST["student_id"])) {
                foreach ($_POST["student_id"] as $student_id) {
                    $present = ($_POST["attendance-$student_id"] == "present") ? 1 : 0;
                    $absent = ($_POST["attendance-$student_id"] == "absent") ? 1 : 0;
                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            // 🔁 Redirige al listado de asistencias
            header("Location: ../Alumnos.php?action=attendance");
            
        }

        // 📋 Carga asistencia existente y listado de estudiantes
        $result = $attendance->getAttendanceByDate($attendance_date);
        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once __DIR__ . "/attendance-edit.php";
        break;

    // 🗑️ Eliminar asistencia
    case "attendance-delete":
        $attendance_date = $_GET["date"];
        $attendance = new Attendance();
        $attendance->deleteAttendanceByDate($attendance_date);

        // 📋 Muestra listado actualizado
        $result = $attendance->getAttendance();
        require_once __DIR__ . "/attendance.php";
        break;

    // 📋 Mostrar listado de asistencias
    case "attendance":
        $attendance = new Attendance();
        $result = $attendance->getAttendance();
        require_once __DIR__ . "/attendance.php";
        break;

   // ➕ Agregar estudiante
case "student-add":
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $dob = !empty($_POST["dob"]) ? date("Y-m-d", strtotime($_POST["dob"])) : "";
        $class = $_POST['class'];
        $materia_id = $_POST['materia_id']; // ✅ Captura la materia seleccionada

        $student = new Student();
        $materiaModel = new Materia();

        // 1. Agregar estudiante
        $insertId = $student->addStudent($name, $dob, $class,$materia_id);

        // 2. Verifica si se insertó correctamente
        if (empty($insertId)) {
            $response = array("message" => "Problema al agregar un nuevo registro", "type" => "error");
        } else {
            // 3. Asignar materia al estudiante
            $materiaModel->asignarMateriaAEstudiante($insertId, $materia_id);

            // 4. Actualizar inscriptos en la materia
            $materiaModel->incrementarInscriptos($materia_id);

            // 5. Redirigir
            header("Location: ../Alumnos.php");
        }
    }

        require_once __DIR__ . "/student-add.php";
        break;

    // ✏️ Editar estudiante
    case "student-edit":
        $student_id = $_GET["id"];
        $student = new Student();

        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $materia_id = $_POST['materia_id'];
            $dob = !empty($_POST["dob"]) ? date("Y-m-d", strtotime($_POST["dob"])) : "";
            $class = $_POST['class'];

            $student->editStudent($name,  $dob, $class, $student_id, $materia_id);
            header("Location: ../Alumnos.php");
        }

        // 📋 Carga datos del estudiante
        $result = $student->getStudentById($student_id);
        require_once __DIR__ . "/student-edit.php";
        break;

    // 🗑️ Eliminar estudiante
case "student-delete":
    $student_id = $_GET["id"];
    $student = new Student();

    // ✅ Obtener rol del usuario desde la sesión
    $rolUsuario = $_SESSION['rol'] ?? 'consultor';

    // ✅ Llamada correcta con los 2 parámetros
    $student->deleteStudent($student_id, $rolUsuario);

    // 📋 Muestra listado actualizado
    $result = $student->getAllStudent();
    require_once __DIR__ . "/student.php";
    break;
    // 🧾 Acción por defecto: muestra listado de estudiantes
    default:
        $student = new Student();
        $result = $student->getAllStudent();
        require_once __DIR__ . "/student.php";
        break;
}
?>

<!-- 📎 Pie de página dinámico -->
<footer>
  <?= $footer ?>
</footer>
</body>
</html>