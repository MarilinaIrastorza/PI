<?php
$css_contenido = 'css/estilos_de_contenido.css';
$css_maquetas = 'css/estilos_de_maquetas.css';

$nombre_sitio = " Colegio Secundario";

$nav_menu1 = "
  <a class='nav-enlace' href='/PI/mainfile/login.php'>LOGIN</a>
  <a class='nav-enlace' href='/PI//mainfile/Contactos.php'>CONTACTOS</a>
  
";

$nav_menu = "
  <a class='nav-enlace' href='../index.php'>Inicio</a>
  <a class='nav-enlace' href='/PI/mainfile/Alumnos.php'>ALUMNOS</a>
  <a class='nav-enlace' href='/PI/mainfile/Docentes.php'>DOCENTES</a>
   <a class='nav-enlace' href='/PI/mainfile/materias.php'>MATERIAS</a>
  <a class='nav-enlace' href='/PI//mainfile/Contactos.php'>CONTACTOS</a>

";

$nombre_secundario = "Bienvenidos";

$aside = "
<section class='contenedor-vertical'>
    <div class='caja-frida'>
        <h3>Historia del Colegio</h3>
        <p>Nació en Coyoacán, México. Su entorno familiar y cultural influyó profundamente en su obra.</p>
    </div>
    <div class='caja-frida'>
        <h3>Metodologia</h3>
        <p>.</p>
    </div>
    <div class='caja-frida'>
        <h3>Estilos</h3>
        <p>Su estilo único y sus ideas convierten en un ícono del arte latinoamericano.</p>
    </div>
</section>
";

$footer = "
<footer class='footer'>
  <div class='redes-sociales'>
    <a href='https://www.facebook.com' target='_blank'><i class='fa-brands fa-facebook-f'></i> Facebook</a>
    <a href='https://www.twitter.com' target='_blank'><i class='fa-brands fa-x-twitter'></i> Twitter</a>
  </div>
  <p class='copyright'>
    &copy; " . date('Y') . " Proyecto PI | Todos los derechos reservados.
  </p>
</footer>
";

$intereses = ['arte', 'tecnología', 'música', 'literatura'];
?>