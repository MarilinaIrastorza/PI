<?php require_once(__DIR__ . '/header.php');?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="Alumnos.php?action=attendance-add"><img src="../image/icon-add.png" />Agregar Asistencia</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1" class="attendance_table">
            <thead>
                <tr>
                    <th><strong>Fecha</strong></th>
                    <th><strong>Presente</strong></th>
                    <th><strong>Ausente</strong></th>
                    <th><strong>Accion</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
                    <td><?php 
                    $attendance_date = "";
                    if(!empty($result[$k]["asistencia_fecha"])) {
                        $attendance_timestamp = strtotime($result[$k]["asistencia_fecha"]);
                        $attendance_date = date("m-d-Y", $attendance_timestamp);
                    }
                    echo $attendance_date; ?></td>
                    <td><?php echo $result[$k]["presente"]; ?></td>
                    <td><?php echo $result[$k]["ausente"]; ?></td>
                    <td><a class="btnEditAction"
                        href="Alumnos.php?action=attendance-edit&date=<?php echo $result[$k]["asistencia_fecha"]; ?>">
                        <img src="../image/icon-edit.png" />
                        </a>
                        <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction" 
                        href="Alumnos.php?action=attendance-delete&date=<?php echo $result[$k]["asistencia_fecha"]; ?>">
                        <img src="../image/icon-delete.png" />
                        </a>
                    </td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                
            
            
            <tbody>
        
        </table>
    </div>
</body>
</html>