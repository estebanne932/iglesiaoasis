<?php
require __DIR__ . '/../../app/db.php';

header('Content-Type: application/json');

$token = $_GET['token'] ?? null;

if (!$token) {
    echo json_encode(["message" => "❌ Token inválido"]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM invitados WHERE token = ?");
$stmt->execute([$token]);
$inv = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inv) {
    echo json_encode(["message" => "❌ Invitado no encontrado"]);
    exit;
}

if (!empty($inv['asistio'])) {
    echo json_encode([
        "message" => "⚠️ {$inv['nombre']} ya ingresó"
    ]);
    exit;
}

$stmt = $pdo->prepare("
    UPDATE invitados 
    SET asistio = 1 
    WHERE token = ?
");
$stmt->execute([$token]);

echo json_encode([
    "message" => "✅ Bienvenido {$inv['nombre']}"
]);