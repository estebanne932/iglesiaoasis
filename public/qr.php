<?php

require '../app/db.php';

header('Content-Type: image/png');

$token = $_GET['token'] ?? '';

if (!$token) {
    exit;
}

$contenido = "http://localhost/invitacion-app/public/validar.php?token=" . $token;

require 'phpqrcode/qrlib.php';

QRcode::png($contenido, false, QR_ECLEVEL_L, 6);