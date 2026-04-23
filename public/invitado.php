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
    <img src="assets/img/logo.png" alt="Tu logo">
</div>
  

</div>

<script>
     // 🔥 CONFIGURACIÓN
const fechaEvento = new Date(2026, 8, 12, 19, 0, 0).getTime();

// 🔍 DEBUG (puedes quitar después)
console.log("Fecha evento:", new Date(2026, 8, 12, 19, 0, 0));
console.log("Fecha actual:", new Date());

setInterval(() => {

    try {

        const ahora = new Date().getTime();
        let diferencia = fechaEvento - ahora;

        // 🚨 Si ya pasó el evento
        if (diferencia <= 0) {
            document.getElementById("dias").innerText = "00";
            document.getElementById("horas").innerText = "00";
            document.getElementById("min").innerText = "00";
            document.getElementById("seg").innerText = "00";
            return;
        }

        // 🔢 CÁLCULO CORRECTO (progresivo)
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        diferencia -= dias * (1000 * 60 * 60 * 24);

        const horas = Math.floor(diferencia / (1000 * 60 * 60));
        diferencia -= horas * (1000 * 60 * 60);

        const min = Math.floor(diferencia / (1000 * 60));
        diferencia -= min * (1000 * 60);

        const seg = Math.floor(diferencia / 1000);

        // 🎯 ACTUALIZAR UI
        document.getElementById("dias").innerText = dias;
        document.getElementById("horas").innerText = horas;
        document.getElementById("min").innerText = min;
        document.getElementById("seg").innerText = seg;

    } catch (error) {

        console.error("Error en contador:", error);

        // fallback visual
        document.getElementById("dias").innerText = "--";
        document.getElementById("horas").innerText = "--";
        document.getElementById("min").innerText = "--";
        document.getElementById("seg").innerText = "--";
    }

}, 1000);

function abrirModal(e){
    e.preventDefault();
    document.getElementById("modalInfo").style.display = "flex";
}

function cerrarModal(){
    document.getElementById("modalInfo").style.display = "none";
}

// cerrar tocando fuera
window.onclick = function(e){
    const modal = document.getElementById("modalInfo");
    if(e.target === modal){
        modal.style.display = "none";
    }
}
</script>

</body>
</html>