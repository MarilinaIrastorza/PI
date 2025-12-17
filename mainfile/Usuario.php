<?php 
// 🔧 Incluye variables globales como nombre del sitio, menú y pie de página
include_once ('../php/includes/variables_globales.php'); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 🎨 Estilos visuales para contenido y maquetación -->
  <link rel="stylesheet" href="../mainfile/css/estilos_de_contenido.css">
 
</head>
<body>

  <!-- 🧩 Encabezado del sitio con nombre principal y secundario -->
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

  <!-- 📌 Menú de navegación dinámico -->
  <nav class="nav">
    <?= $nav_menu ?>
  </nav>

<?php require_once(__DIR__ . '/header.php'); ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=usuario-add"><img src="image/icon-add.png" />Agregar Usuario</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Usuario</strong></th>
                    <th><strong>Rol</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (! empty($result)) {
                    foreach ($result as $k => $v) {
                ?>
                <tr>
                    <td><?php echo $result[$k]["usuario"]; ?></td>
                    <td><?php echo $result[$k]["rol"]; ?></td>
                    <td><a class="btnEditAction"
                        href="index.php?action=usuario-edit&id=<?php echo $result[$k]["id"]; ?>">
                        <img src="image/icon-edit.png" />
                        </a>
                        <?php
                    if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1) {
                        ?>
                        <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction" 
                        href="index.php?action=usuario-delete&id=<?php echo $result[$k]["id"]; ?>">
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