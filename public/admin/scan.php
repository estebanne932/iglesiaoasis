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
<title>Escanear QR</title>

<script src="https://unpkg.com/html5-qrcode"></script>

<style>
body {
    background: #0f172a;
    color: #fff;
    text-align: center;
    font-family: sans-serif;
}

#reader {
    width: 300px;
    margin: 40px auto;
}

.result {
    margin-top: 20px;
    font-size: 18px;
}
</style>
</head>

<body>

<h1>Escanear invitación 🎟️</h1>

<div id="reader"></div>

<div class="result" id="result"></div>

<script>
let scanning = true;

function onScanSuccess(decodedText) {
    if (!scanning) return;
    scanning = false;

    document.getElementById("result").innerHTML = "Procesando...";

    // Extraer token correctamente
    let token = "";

    if (decodedText.includes("token=")) {
        token = decodedText.split("token=")[1];
    } else {
        token = decodedText;
    }

    if (!token) {
        document.getElementById("result").innerHTML = "❌ QR inválido";
        scanning = true;
        return;
    }

    fetch("checkin.php?token=" + token)
        .then(res => res.json())
        .then(data => {
            document.getElementById("result").innerHTML = data.message;
        })
        .catch((err) => {
            console.error(err);
            document.getElementById("result").innerHTML = "❌ Error al procesar";
        });

    setTimeout(() => scanning = true, 3000);
}

const html5QrCode = new Html5Qrcode("reader");

html5QrCode.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: 250 },
    onScanSuccess
);
</script>

</body>
</html>