<?php include_once('php/includes/variables_globales.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="mainfile/css/estilos_de_contenido.css">
  <link rel="stylesheet" href="mainfile/css/estilos_de_maquetas.css">
  
</head>
<body>
  <header>
    <h1 class="nombre_sitio"><?= $nombre_sitio ?></h1>
    <h2 class="nombre_secundario"><?= $nombre_secundario ?></h2>
  </header>

  <nav class="nav"><?= $nav_menu1 ?></nav>


  <section>
    <!-- SECCIÓN 1: Imagen representativa -->
    <section class="seccion-imagen">
      <img src="mainfile/image/imagenes/index/ImagColegio.jpg" alt="Representación visual de Frida Kahlo">
    </section>

    <!-- SECCIÓN 2: Descripción del proyecto -->
    <section class="seccion-descripcion">
      <h2>¿De qué trata este proyecto?</h2>
      <p>El Colegio fue fundado en 1985 por un grupo de docentes comprometidos con la educación integral de niños y jóvenes. Comenzó como una pequeña institución con apenas dos aulas y una matrícula de 40 alumnos, pero con el tiempo fue creciendo gracias al esfuerzo de la comunidad educativa y el apoyo de las familias.
Durante los años 90, se incorporaron nuevos niveles educativos, incluyendo el secundario, y se ampliaron las instalaciones con laboratorios, biblioteca y espacios deportivos. El colegio se destacó por su enfoque en valores, el trabajo colaborativo y la innovación pedagógica.

.</p>
      <p>Hoy, el Colegio es reconocido por su trayectoria, su compromiso con la formación académica y humana, y por ser un espacio donde se cultivan el respeto, la creatividad y el pensamiento crítico.</p>
    </section>

    <!-- SECCIÓN 3: Objetivos -->
    <section class="seccion-objetivos">
      <h2>Objetivos del proyecto</h2>
      <ul>
        <li>Dar a conocer la obra de Frida Kahlo de forma visual y accesible</li>
        <li>Explorar su pensamiento a través de frases destacadas</li>
        <li>Reflexionar sobre su impacto en la cultura contemporánea</li>
        <li>Fomentar el interés por el arte latinoamericano</li>
      </ul>
    </section>
  </section>



  <footer><?= $footer ?></footer>
</body>
</html>