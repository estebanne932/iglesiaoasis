<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel Admin</title>

<link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>Panel Admin</h1>
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>

    <!-- TARJETAS -->
    <div class="cards">

        <a href="crear_invitado.php" class="card">
            <h3>Crear Invitado</h3>
            <p>Registrar nuevo acceso con QR</p>
        </a>

        <a href="index.php" class="card">
            <h3>Ver Invitados</h3>
            <p>Lista completa de registros</p>
        </a>

        <a href="scan.php" class="card">
            <h3>Escaner</h3>
            <p>Registrar visita</p>
        </a>

    </div>

</div>

</body>
</html>