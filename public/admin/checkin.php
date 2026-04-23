<?php
require '../../app/db.php';

header('Content-Type: application/json');

$token = $_GET['token'] ?? null;

if (!$token) {
    echo json_encode(["message" => "❌ Token inválido"]);
    exit;
}

// Buscar invitado
$stmt = $pdo->prepare("SELECT * FROM invitados WHERE token = ?");
$stmt->execute([$token]);
$inv = $stmt->fetch();

if (!$inv) {
    echo json_encode(["message" => "❌ Invitado no encontrado"]);
    exit;
}

// Si ya asistió
if ($inv['asistio']) {
    echo json_encode([
        "message" => "⚠️ {$inv['nombre']} ya ingresó"
    ]);
    exit;
}

// Marcar asistencia
$stmt = $pdo->prepare("
    UPDATE invitados 
    SET asistio = 1, hora_asistencia = NOW() 
    WHERE token = ?
");
$stmt->execute([$token]);

echo json_encode([
    "message" => "✅ Bienvenido {$inv['nombre']}"
]);