<?php require_once(__DIR__ . '/header.php'); ?>


<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Nombres</label> <span
            id="name-info" class="info"></span><br /> <input type="text"
            name="name" id="name" class="demoInputBox"
            value="<?php echo $result[0]["nombres"]; ?>">
    </div>
    <div>
        <label>F. Nacimiento</label> <span id="dob-info" class="info"></span><br />
        <input type="text" name="dob" id="dob" class="demoInputBox"
            value="<?php echo $result[0]["fecha_estudiante"]; ?>">
    </div>
    <div>
        <label>Clase</label> <span id="class-info" class="info"></span><br />
        <input type="text" name="class" id="class" class="demoInputBox"
            value="<?php echo $result[0]["clase"]; ?>">
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
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#roll_number").val()) {
        $("#roll-number-info").html("(required)");
        $("#roll_number").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dob").val()) {
        $("#dob-info").html("(required)");
        $("#dob").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#class").val()) {
        $("#class-info").html("(required)");
        $("#class").css('background-color','#FFFFDF');
        valid = false;
    }   
    return valid;
}
</script>
    </body>
    </html>