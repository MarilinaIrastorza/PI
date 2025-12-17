 
 <?php
/**
 * Página de inicio de sesión del sistema.
 *
 * Este archivo muestra el formulario de login y procesa la respuesta
 * enviada desde el controlador (index.php?action=login).
 *
 * Funcionalidades:
 * - Inicia sesión si aún no está iniciada.
 * - Recibe $result cuando el login es exitoso.
 * - Recibe $response cuando hay error de autenticación.
 * - Redirige al panel correspondiente según el rol.
 */

// Iniciar sesión solo si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Si $result existe y contiene datos, significa que el usuario fue autenticado.
 * Se guardan los datos en la sesión y se redirige al panel correspondiente.
 *
 * @var array $result Resultado de la consulta de login
 */
if (isset($result) && $result) {

    /**
     * Guardamos datos del usuario autenticado
     * @var string $_SESSION["usuario"] Nombre del usuario
     * @var int    $_SESSION["rol"]     Rol del usuario
     */
    $_SESSION["usuario"] = $result[0]["usuario"];
    $_SESSION["rol"]     = $result[0]["id_rol"];

    // Redirección al panel de usuario
    header("Location: Usuario.php?action=student");
    exit;
}

/**
 * Si existe un mensaje de error ($response), se muestra en pantalla.
 *
 * @var array $response Contiene ["type"] y ["message"]
 */
if (isset($response)) {
    echo "<div class='mensaje-error'>{$response['type']}: {$response['message']}</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar sesión</title>

<style>
/* Fondo general */
body {
  background: linear-gradient(to right, #e7c7a3ff, #dfb6a4ff);
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  padding: 0;
}

/* Contenedor del login */
.login-container {
  max-width: 400px;
  margin: 80px auto;
  padding: 30px;
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
}

/* Título */
.login-container h2 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
  color: #333;
}

/* Campos */
.login-container input[type="text"],
.login-container input[type="password"] {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  font-size: 18px;
  border: 1px solid #ccc;
  border-radius: 8px;
}

/* Botón */
.login-container input[type="submit"] {
  width: 100%;
  padding: 12px;
  font-size: 18px;
  background-color: #4e54c8;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-container input[type="submit"]:hover {
  background-color: #3b3fc1;
}

/* Mensaje de error */
.mensaje-error {
  background-color: #ffdddd;
  border-left: 4px solid #d9534f;
  padding: 10px;
  margin-bottom: 15px;
  color: #a94442;
  font-size: 16px;
  border-radius: 6px;
}
</style>
</head>

<body>

<div class="login-container">
  <h2>Iniciar sesión</h2>

  <!--
    Formulario de login.
    Envia los datos mediante POST a index.php?action=login
    La función validate() evita enviar campos vacíos.
  -->
  <form name="frmAdd" method="post" action="index.php?action=login" id="frmAdd" onsubmit="return validate();">

    <label>Usuario</label>
    <span id="usuario-info" class="info"></span><br />
    <input type="text" name="usuario" id="usuario" class="demoInputBox">

    <label>Contraseña</label>
    <span id="password-info" class="info"></span><br />
    <input type="password" name="password" id="password" class="demoInputBox">

    <input type="submit" name="ingresar" id="btnSubmit" value="Ingresar" />
  </form>
</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script>
/**
 * validate()
 *
 * Valida que los campos usuario y contraseña no estén vacíos.
 * Si falta alguno, muestra un mensaje y marca el campo en amarillo.
 *
 * @returns {boolean} true si el formulario es válido, false si no.
 */
function validate() {
    var valid = true;

    // Limpia estilos previos
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    // Validación del usuario
    if (!$("#usuario").val()) {
        $("#usuario-info").html("(requerido)");
        $("#usuario").css('background-color', '#FFFFDF');
        valid = false;
    }

    // Validación de la contraseña
    if (!$("#password").val()) {
        $("#password-info").html("(requerido)");
        $("#password").css('background-color', '#FFFFDF');
        valid = false;
    }

    return valid;
}
</script>

</body>
</html>
 
 
 
 