<?php
require '../app/db.php';

$token = $_GET['token'] ?? null;

$stmt = $pdo->prepare("SELECT * FROM invitados WHERE token = ?");
$stmt->execute([$token]);
$invitado = $stmt->fetch();

if (!$invitado) {
    die("Invitación no válida");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invitación</title>

<link rel="stylesheet" href="assets/css/style.css">
</head>
<style>
    
.powered{
    width:100%;
    margin-top:20px;
    padding:15px 10px;
    background:#000;
    text-align:center;
    border-radius:15px;
}

.powered p{
    font-size:12px;
    color:#aaa;
    margin-bottom:8px;
}

.powered img{
    width:120px;
    opacity:0.9;
}
</style>

<body>

<div class="container">

    <div class="card">

        <!-- LOGO -->
        <img src="assets/img/LOGOECOS.png" class="logo-top">
        <br>
        <p class="tag">✨ INVITACIÓN ESPECIAL</p>

        <h1>¡Bienvenido!</h1>

        <!-- NOMBRE DINÁMICO -->
        <p class="nombre"><?php echo htmlspecialchars($invitado['nombre']); ?></p>

        <!-- CONTADOR -->
        <div class="countdown">
            <div><span id="dias">00</span><small>Días</small></div>
            <div><span id="horas">00</span><small>Horas</small></div>
            <div><span id="min">00</span><small>Min</small></div>
            <div><span id="seg">00</span><small>Seg</small></div>
        </div>

        <!-- INFO -->
        <div class="info">
            <p>📅 Sábado, 12 de Septiembre 2026</p>
            <p>📍 En el salón Fenrys</p>
        </div>

        <!-- ESTADO -->
        <div class="estado <?= $invitado['estado'] ?>">
            <?= $invitado['estado'] === 'activo' ? 'Acceso válido ✅' : 'Ya utilizado ❌' ?>
        </div>

        <!-- QR -->
        <div class="qr">
            <img src="qr.php?token=<?= $token ?>">
        </div>


    </div>

        <!-- FOOTER -->
<div class="powered">
    <p>Powered by</p>
    <img src="public/assets/img/logo.png" alt="Tu logo">
</div>
  

</div>

<script src="assets/js/app.js"></script>

</body>
</html>