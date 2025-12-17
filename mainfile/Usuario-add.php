<?php require_once __DIR__ . "/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Usuario</label> <span
            id="usuario-info" class="info"></span><br /> <input type="text"
            name="usuario" id="usuario" class="demoInputBox">
    </div>
    <div>
        <label>Contraseña</label> <span id="password-info" class="info"></span><br />
        <input type="password" name="password" id="password" class="demoInputBox">
    </div>
    <div>
        <label>Rol</label> <span id="rol-info" class="info"></span><br />
        <select name="id_rol" id="id_rol">
            <?php
            foreach ($result1 as $fila) {
                echo "<option value='" . $fila["id"] . "'";
                echo ">" . $fila["rol"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Agregar" />
    </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
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