<?php require_once "header.php"; ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="Alumnos.php?action=student-add"><img src="image/icon-add.png" />Agregar Estudiante</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Nombre Estudiante</strong></th>
                    <th><strong>Numero Materia</strong></th>
                    <th><strong>F. Nacimiento</strong></th>
                    <th><strong>Clase</strong></th>
                    <th><strong>Accion</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
                    <td><?php echo $result[$k]["nombres"]; ?></td>
                    <td><?php echo $result[$k]["id_materia"]; ?></td>
                    <td><?php echo $result[$k]["fecha_estudiante"]; ?></td>
                    <td><?php echo $result[$k]["clase"]; ?></td>
                    <td><a class="btnEditAction"
                        href="Alumnos.php?action=student-edit&id=<?php echo $result[$k]["id"]; ?>">
                        <img src="image/icon-edit.png" />
                        </a>
                        <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction" 
                        href="Alumnos.php?action=student-delete&id=<?php echo $result[$k]["id"]; ?>">
                        <img src="image/icon-delete.png" />
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