<?php
session_start();
require_once "header.php";

// Validación de acceso: solo usuarios con rol 1 o 2 pueden editar
if (!isset($_SESSION["id_rol"]) || ($_SESSION["id_rol"] != 1 && $_SESSION["id_rol"] != 2)) {
    echo "<div style='color:red; font-weight:bold;'>Acceso denegado. No tenés permisos para editar usuarios.</div>";
    exit;
}
?>

<!-- Formulario para editar usuario -->
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div id="mail-status"></div>

    <!-- Campo de entrada para el nombre de usuario -->
    <div>
        <label style="padding-top: 20px;">Usuario</label>
        <span id="usuario-info" class="info"></span><br />
        <input type="text" name="usuario" id="usuario" class="demoInputBox"
            value="<?php echo $result[0]["usuario"]; ?>">
    </div>

    <!-- Campo de entrada para la contraseña -->
    <div>
        <label>Contraseña</label>
        <span id="password-info" class="info"></span><br />
        <input type="password" name="password" id="password" class="demoInputBox"
            value="<?php echo $result[0]["password"]; ?>">
    </div>

    <!-- Selector desplegable para elegir el rol del usuario -->
    <div>
        <label>Rol</label>
        <span id="rol-info" class="info"></span><br />
        <select name="id_rol" id="id_rol">
            <?php
            foreach ($result1 as $fila) {
                echo "<option value='" . $fila["id"] . "'";
                if ($fila["id"] == $result[0]["id_rol"]) {
                    echo " selected";
                }
                echo ">" . $fila["rol"] . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- Botón para guardar cambios -->
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Guardar" />
    </div>
</form>

<!-- Validación visual con jQuery -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function validate() {
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    if (!$("#usuario").val()) {
        $("#usuario-info").html("(requerido)");
        $("#usuario").css('background-color', '#FFFFDF');
        valid = false;
    }
    if (!$("#password").val()) {
        $("#password-info").html("(requerido)");
        $("#password").css('background-color', '#FFFFDF');
        valid = false;
    }

    return valid;
}
</script>

</body>
</html>