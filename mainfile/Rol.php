<?php require_once "header.php"; ?>
<div style="text-align: right; margin: 20px 0px 10px;">
    <a id="btnAddAction" href="index.php?action=rol-add"><img src="image/icon-add.png" />Agregar Rol</a>
</div>
<div id="toys-grid">
    <table cellpadding="10" cellspacing="1">
        <thead>
            <tr>
                <th><strong>Rol</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (! empty($result)) {
                foreach ($result as $k => $v) {
            ?>
                    <tr>
                        <td><?php echo $result[$k]["rol"]; ?></td>
                        <td><a class="btnEditAction"
                                href="index.php?action=rol-edit&id=<?php echo $result[$k]["id"]; ?>">
                                <img src="image/icon-edit.png" />
                            </a>
                            <?php
                            if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
                            ?>
                                <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction"
                                    href="index.php?action=rol-delete&id=<?php echo $result[$k]["id"]; ?>">
                                    <img src="image/icon-delete.png" />
                                </a><?php
                            }
                            ?>
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