<?php
// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Verificar si el usuario está logueado
if (!isset($_SESSION["usuario"]) || !isset($_SESSION["rol"])) {
    header("Location: login.php");
    exit;
}

// ✅ Verificar si el rol es LECTOR (id_rol = 3)
if ($_SESSION["rol"] != 3) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel del Lector</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body {
    background: #f4f4f4;
    font-family: 'Segoe UI', sans-serif;
}

.header-bar {
    background: #6c757d;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

.card {
    margin-top: 40px;
    border-radius: 12px;
}
</style>
</head>

<body>

<div class="header-bar">
    Panel del Lector
</div>

<div class="container">
    <div class="card shadow p-4">
        <h3 class="mb-3">Bienvenido, <?php echo htmlspecialchars($usuario); ?></h3>

        <p class="lead">
            Accediste correctamente al panel exclusivo para Lectores.
        </p>

        <hr>

        <p>
            Aquí podés agregar las funciones que necesite el lector:
        </p>

        <ul>
            <li>Visualización de contenido</li>
            <li>Acceso de solo lectura</li>
            <li>Consultas sin edición</li>
        </ul>

        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</div>

</body>
</html>