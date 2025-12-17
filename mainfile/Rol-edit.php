<?php require_once "header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Rol</label> <span
            id="rol-info" class="info"></span><br /> <input type="text"
            name="rol" id="rol" class="demoInputBox"
            value="<?php echo $result[0]["rol"]; ?>">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Guardar" />
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#rol").val()) {
        $("#rol-info").html("(required)");
        $("#rol").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}
</script>
    </body>
    </html>