<?php
require_once "header.php";
require_once("../Modelo/Student.php");
require_once("../Modelo/Materias.php");

// Procesamiento del formulario
if (isset($_POST["add"])) {
    $studentModel = new Student();
    $materiaModel = new Materia();

    $name = $_POST["name"];
    $roll_number = $_POST["roll_number"];
    $dob = $_POST["dob"];
    $class = $_POST["class"];
    $materia_id = $_POST["materia_id"];

    // 1. Agregar estudiante
    $studentId = $studentModel->addStudent($name, $roll_number, $dob, $class);

    // 2. Registrar relación estudiante-materia
    $materiaModel->asignarMateriaAEstudiante($studentId, $materia_id);

    // 3. Actualizar inscriptos
    $materiaModel->incrementarInscriptos($materia_id);

    echo "<div id='mail-status'>✅ Estudiante agregado y materia asignada correctamente.</div>";
}
?>

<form name="frmAdd" method="post" action="Alumnos.php?action=student-add" id="frmAdd" onsubmit="return validate();">
    <div id="mail-status"></div>

    <div>
        <label style="padding-top: 20px;">Nombre</label>
        <span id="name-info" class="info"></span><br />
        <input type="text" name="name" id="name" class="demoInputBox">
    </div>


    <div>
        <label>F. Nacimiento</label>
        <span id="dob-info" class="info"></span><br />
        <input type="date" name="dob" id="dob" class="demoInputBox">
    </div>

    <div>
        <label>Clase</label>
        <span id="class-info" class="info"></span><br />
        <input type="text" name="class" id="class" class="demoInputBox">
    </div>

    <div>
    <label>Materias</label><br />
    <?php
require_once '../Modelo/Materias.php'; 
require_once '../Modelo/Student.php';

$materiaModel = new Materia();
$listado = $materiaModel->getAllMaterias();

?>
    <select name="materia_id" required>
        <option value="">Seleccionar materia</option>
        <?php
        foreach ($listado as $materia) {
            $vacantes = $materia['cuposTotales'] - $materia['inscriptos'];
            echo "<option value='{$materia['id']}'>{$materia['nombre_materia']} ({$vacantes} vacantes)</option>";
        }
        ?>
    </select>
</div>

    <div>
        <input type="submit" name="add" id="btnSubmit" value="Agregar" />
    </div>
</form>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    if (!$("#name").val()) {
        $("#name-info").html("(requerido)");
        $("#name").css('background-color', '#FFFFDF');
        valid = false;
    }
    
    if (!$("#dob").val()) {
        $("#dob-info").html("(requerido)");
        $("#dob").css('background-color', '#FFFFDF');
        valid = false;
    }
    if (!$("#class").val()) {
        $("#class-info").html("(requerido)");
        $("#class").css('background-color', '#FFFFDF');
        valid = false;
    }
    return valid;
}
</script>
</body>
</html>