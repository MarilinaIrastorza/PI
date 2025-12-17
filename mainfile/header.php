<html>
<head>
    <!-- Título que aparece en la pestaña del navegador -->
    <title>Colegio Secundario</title>

    <!-- Enlace al archivo de estilos CSS para aplicar diseño visual -->
    <!-- La ruta ../css/style.css indica que sube un nivel y entra a css -->
    <link href="../mainfile/css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>

    <!-- Encabezado principal visible en la página -->
    <h2>Registro de Asistencia</h2>

    <!-- Contenedor del menú de navegación -->
    <div>
        <ul class="menu-list">
            <!-- Enlace al módulo de estudiantes -->
            <!-- Apunta a Alumnos.php dentro de la carpeta 'paginas' -->
            <li><a href="Alumnos.php">Estudiante</a></li>

            <!-- Enlace al módulo de asistencia con parámetro GET 'action=attendance' -->
            <!-- Esto activa el controlador para mostrar la vista de asistencia -->
            <li><a href="Alumnos.php?action=attendance">Asistencia</a></li>
        </ul>
    </div>

</body>
</html>