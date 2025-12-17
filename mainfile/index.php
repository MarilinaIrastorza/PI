<?php
/**
 * Archivo principal del sistema (Front Controller).
 *
 * Este archivo:
 * - Inicia la sesión si no está activa.
 * - Carga variables globales (nombre del sitio, menú, footer).
 * - Incluye los modelos necesarios.
 * - Determina la acción solicitada mediante $_GET["action"].
 * - Controla el flujo del sistema usando un switch centralizado.
 * - Carga las vistas correspondientes.
 */

include_once('../php/includes/variables_globales.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Hojas de estilo globales -->
  <link rel="stylesheet" href="../mainfile/css/estilos_de_contenido.css">
  <link rel="stylesheet" href="../mainfile/css/estilos_de_maquetas.css">
</head>

<body>

  <!-- Encabezado del sitio -->
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

<?php
/**
 * Iniciar sesión solo si no está activa.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Inclusión de modelos usando rutas absolutas seguras.
 * Esto evita errores por rutas relativas incorrectas.
 */
require_once(__DIR__ . '/../Modelo/DBController.php');
require_once(__DIR__ . '/../Modelo/Student.php');
require_once(__DIR__ . '/../Modelo/Attendance.php');
require_once(__DIR__ . '/../Modelo/Usuario.php');
require_once(__DIR__ . '/../Modelo/Rol.php');

/**
 * Instancia del controlador de base de datos.
 */
$db_handle = new DBController();

/**
 * Acción por defecto: login.
 * Si el usuario ya está autenticado, se permite cambiar la acción.
 */
$action = "login";
if (!empty($_GET["action"]) && isset($_SESSION["usuario"])) {
    $action = $_GET["action"];
}

/**
 * Controlador principal del sistema.
 * Cada "case" representa un módulo o acción del sistema.
 */
switch ($action) {

    /**
     * ---------------------------------------------------------
     * MÓDULO: AGREGAR ASISTENCIA
     * ---------------------------------------------------------
     */
    case "attendance-add":
        if (isset($_POST['add'])) {

            $attendance = new Attendance();

            // Conversión de fecha a formato Y-m-d
            $attendance_timestamp = strtotime($_POST["attendance_date"]);
            $attendance_date = date("Y-m-d", $attendance_timestamp);

            // Procesamiento de asistencia por estudiante
            if (!empty($_POST["student_id"])) {
                $attendance->deleteAttendanceByDate($attendance_date);

                foreach ($_POST["student_id"] as $k => $student_id) {
                    $present = ($_POST["attendance-$student_id"] == "present") ? 1 : 0;
                    $absent  = ($_POST["attendance-$student_id"] == "absent") ? 1 : 0;

                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            header("Location: index.php?action=attendance");
        }

        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once "attendance-add.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: EDITAR ASISTENCIA
     * ---------------------------------------------------------
     */
    case "attendance-edit":
        $attendance_date = $_GET["date"];
        $attendance = new Attendance();

        if (isset($_POST['add'])) {

            $attendance->deleteAttendanceByDate($attendance_date);

            if (!empty($_POST["student_id"])) {
                foreach ($_POST["student_id"] as $k => $student_id) {

                    $present = ($_POST["attendance-$student_id"] == "present") ? 1 : 0;
                    $absent  = ($_POST["attendance-$student_id"] == "absent") ? 1 : 0;

                    $attendance->addAttendance($attendance_date, $student_id, $present, $absent);
                }
            }

            header("Location: index.php?action=attendance");
        }

        $result = $attendance->getAttendanceByDate($attendance_date);

        $student = new Student();
        $studentResult = $student->getAllStudent();
        require_once "attendance-edit.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: ELIMINAR ASISTENCIA
     * ---------------------------------------------------------
     */
    case "attendance-delete":
        $attendance_date = $_GET["date"];
        $attendance = new Attendance();

        $attendance->deleteAttendanceByDate($attendance_date);

        $result = $attendance->getAttendance();
        require_once "attendance.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: LISTAR ASISTENCIA
     * ---------------------------------------------------------
     */
    case "attendance":
        $attendance = new Attendance();
        $result = $attendance->getAttendance();
        require_once "attendance.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: AGREGAR ESTUDIANTE
     * ---------------------------------------------------------
     */
    case "student-add":
        if (isset($_POST['add'])) {

            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];

            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }

            $class = $_POST['class'];

            $student = new Student();
            $insertId = $student->addStudent($name, $roll_number, $dob, $class);

            if (empty($insertId)) {
                $response = [
                    "message" => "Problema al agregar un nuevo registro",
                    "type" => "error"
                ];
            } else {
                header("Location: index.php?action=student");
            }
        }

        require_once "student-add.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: EDITAR ESTUDIANTE
     * ---------------------------------------------------------
     */
    case "student-edit":
        $student_id = $_GET["id"];
        $student = new Student();

        if (isset($_POST['add'])) {

            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];

            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }

            $class = $_POST['class'];

            $student->editStudent($name, $roll_number, $dob, $class, $student_id);

            header("Location: index.php?action=student");
        }

        $result = $student->getStudentById($student_id);
        require_once "student-edit.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: ELIMINAR ESTUDIANTE
     * ---------------------------------------------------------
     */
    case "student-delete":
        $student_id = $_GET["id"];
        $student = new Student();

        $student->deleteStudent($student_id);

        $result = $student->getAllStudent();
        require_once "student.php?action=student";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: LOGIN
     * ---------------------------------------------------------
     */
case "login":

    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    $usuario = new Usuario();
    $result = $usuario->pwdVerify($user, $pass);

    if ($result) {

        // Guardar datos en sesión
        $_SESSION["usuario"] = $result[0]["usuario"];
        $_SESSION["rol"]     = $result[0]["id_rol"];

        // Redirección según rol
        if ($_SESSION["rol"] == 1) {
            header("Location: Usuario.php?action=student");
            exit;
        }

        if ($_SESSION["rol"] == 3) {
            header("Location: lector.php");
            exit;
        }

        // Si no coincide ningún rol
        header("Location: Usuario.php?action=student");
        exit;

    } else {
        $response = [
            "type" => "Error",
            "message" => "Usuario o contraseña incorrectos"
        ];
    }

    require_once "login.php";
    break;

/* ---------------------------------------------------------
 * MÓDULO: LISTAR USUARIOS
 * ---------------------------------------------------------
 */
case "usuario":
        $usuario = new Usuario();
        $result = $usuario->getAllUsuario();
        require_once "usuario.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: AGREGAR USUARIO
     * ---------------------------------------------------------
     */
    case "usuario-add":
        if (isset($_POST['add'])) {

            $name = $_POST['usuario'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $id_rol = $_POST['id_rol'];

            $usuario = new Usuario();
            $insertId = $usuario->addUsuario($name, $password, $id_rol);

            if (empty($insertId)) {
                $response = [
                    "message" => "Problema al agregar un nuevo registro",
                    "type" => "error"
                ];
            } else {
                header("Location: index.php?action=usuario");
            }
        }

        $rol = new Rol();
        $result1 = $rol->getAllRol();
        require_once "usuario-add.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: EDITAR USUARIO
     * ---------------------------------------------------------
     */
    case "usuario-edit":
        $usuario_id = $_GET["id"];
        $usuario = new Usuario();

        if (isset($_POST['add'])) {

            $name = $_POST['usuario'];
            $password = $_POST['password'];
            $id_rol = $_POST['id_rol'];

            $usuario->editUsuario($name, $password, $id_rol, $usuario_id);

            header("Location: index.php?action=usuario");
        }

        $rol = new Rol();
        $result1 = $rol->getAllRol();
        $result = $usuario->getUsuarioById($usuario_id);
        require_once "usuario-edit.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: ELIMINAR USUARIO
     * ---------------------------------------------------------
     */
    case "usuario-delete":
        $usuario_id = $_GET["id"];
        $usuario = new Usuario();

        $usuario->deleteUsuario($usuario_id);

        $result = $usuario->getAllUsuario();
        require_once "usuario.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: LISTAR ROLES
     * ---------------------------------------------------------
     */
    case "rol":
        $rol = new Rol();
        $result = $rol->getAllRol();
        require_once "rol.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: AGREGAR ROL
     * ---------------------------------------------------------
     */
    case "rol-add":
        if (isset($_POST['add'])) {

            $name = $_POST['rol'];

            $rol = new Rol();
            $insertId = $rol->addRol($name);

            if (empty($insertId)) {
                $response = [
                    "message" => "Problema al agregar un nuevo registro",
                    "type" => "error"
                ];
            } else {
                header("Location: index.php?action=rol");
            }
        }

        require_once "rol-add.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: EDITAR ROL
     * ---------------------------------------------------------
     */
    case "rol-edit":
        $rol_id = $_GET["id"];
        $rol = new Rol();

        if (isset($_POST['add'])) {

            $name = $_POST['rol'];
            $rol->editRol($name, $rol_id);

            header("Location: index.php?action=rol");
        }

        $result = $rol->getRolById($rol_id);
        require_once "rol-edit.php";
        break;

    /**
     * ---------------------------------------------------------
     * MÓDULO: ELIMINAR ROL
     * ---------------------------------------------------------
     */
    case "rol-delete":
        $rol_id = $_GET["id"];
        $rol = new Rol();

        $rol->deleteRol($rol_id);

        $result = $rol->getAllRol();
        require_once "rol.php";
        break;

    /**
     * ---------------------------------------------------------
     * ACCIÓN POR DEFECTO
     * ---------------------------------------------------------
     */
    default:
        $student = new Student();
        $result = $student->getAllStudent();
        require_once "student.php";
        break;
}
?>

<!-- Footer del sitio -->
<footer><?= $footer ?></footer>

</body>
</html>