<?php require_once "header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div>
        <input type="date" name="attendance_date" id="attendance_date" class="demoInputBox"> <span id="attendance_date-info" class="info"></span>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Estudiante</strong></th>
                    <th><strong>Presente</strong></th>
                    <th><strong>Ausente</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php 
            if (! empty($studentResult)) {
                foreach ($studentResult as $k => $v) {
            ?>
          <tr>
                    <td><input type="hidden"
            name="student_id[]" id="student_id" value = "<?php echo $studentResult[$k]["id"]; ?>">
            <?php echo $studentResult[$k]["nombres"]; ?></td>
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="present" checked /></td>
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="absent" /></td>
                </tr>
                    <?php
                        }
                    }
                    ?>
            <tbody>
        
        </table>
        
    </div>
   <div>
        <input type="submit" name="add" id="btnSubmit" value="Agregar" />
    </div> 
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#attendance_date").val()) {
        $("#attendance_date-info").html("(required)");
        $("#attendance_date").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid;
}
</script>
</body>
</html>