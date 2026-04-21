<?php
session_start();
require '../../app/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$link = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $token = bin2hex(random_bytes(8));

    $stmt = $pdo->prepare("INSERT INTO invitados (nombre, telefono, token) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $telefono, $token]);

    $link = "http://localhost/invitacion-app/public/invitado.php?token=$token";

    $mensaje = urlencode("Hola $nombre 👋\n\nAquí está tu acceso al evento:\n$link\n\nPresenta este código el día del evento 🎟️");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nuevo Invitado</title>

<link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Nuevo Invitado</h1>
        <a href="dashboard.php" class="logout">← Volver</a>
    </div>

    <div class="form-card">

        <form method="POST">

            <div class="input-group">
                <input type="text" name="nombre" required>
                <label>Nombre completo</label>
            </div>

            <div class="input-group">
                <input type="text" name="telefono" required>
                <label>Teléfono</label>
            </div>

            <button class="btn">Guardar invitado</button>

        </form>

        <?php if($link): ?>

            <div class="result">

                <p>✅ Invitado creado</p>

                <a href="<?= $link ?>" target="_blank" class="link">
                    Ver invitación
                </a>

                <a href="https://wa.me/52<?= $telefono ?>?text=<?= $mensaje ?>" target="_blank" class="btn whatsapp">
                    Enviar por WhatsApp
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>