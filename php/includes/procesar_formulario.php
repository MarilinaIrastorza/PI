<?php
include_once('variables_globales.php');

$recepcion_ok = true;
$no_hay_errores = true;

// Función para limpiar los valores (opcional)
function validarValor($valor) {
    return trim($valor);
}


$nombre = "";
if (isset($_POST["nombre"])) {
    $nombre = validarValor($_POST["nombre"]);
} else {
    $recepcion_ok = false;
}


$apellido = "";
if (isset($_POST["apellido"])) {
    $apellido = validarValor($_POST["apellido"]);
} else {
    $recepcion_ok = false;
}


$email = "";
if (isset($_POST["email"])) {
    $email = validarValor($_POST["email"]);
} else {
    $recepcion_ok = false;
}


$fecha = "";
if (isset($_POST["fecha"])) {
    $fecha = validarValor($_POST["fecha"]);
}


$comentario = "";
if (isset($_POST["comentario"])) {
    $comentario = validarValor($_POST["comentario"]);
} else {
    $recepcion_ok = false;
}


$interes = "";
if (isset($_POST["intereses"])) {
    $interes = validarValor($_POST["intereses"]);
} else {
    $recepcion_ok = false;
}


$nacionalidad = "";
if (isset($_POST["nacionalidad"])) {
    $nacionalidad = validarValor($_POST["nacionalidad"]);
} else {
    $recepcion_ok = false;
}

// VALIDACIONES
if ($nombre == "" || strlen($nombre) < 3 || strlen($nombre) > 30) {
    $no_hay_errores = false;
}
if ($apellido == "" || strlen($apellido) < 3 || strlen($apellido) > 30) {
    $no_hay_errores = false;
}
if ($email == "" || strlen($email) < 10 || strlen($email) > 50) {
    $no_hay_errores = false;
}
if ($comentario == "" || strlen($comentario) < 1) {
    $no_hay_errores = false;
}
if ($interes == "" || strlen($interes) < 1) {
    $no_hay_errores = false;
}
if ($nacionalidad == "" || strlen($nacionalidad) < 1) {
    $no_hay_errores = false;
}

//  Resultado 
if ($recepcion_ok && $no_hay_errores) {
    echo "<h2>Formulario procesado correctamente 🎉</h2>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Apellido:</strong> $apellido</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Fecha de nacimiento:</strong> $fecha</p>";
    echo "<p><strong>Comentario:</strong> $comentario</p>";
    echo "<p><strong>Interés:</strong> $interes</p>";
    echo "<p><strong>Nacionalidad:</strong> $nacionalidad</p>";
} else {
    echo "<h2>Hubo errores en el envío del formulario </h2>";
}
?>
