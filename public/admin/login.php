<?php
session_start();
require '../../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Datos incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <!-- LOGO -->
        <img src="../assets/img/LOGOOASIS.png" class="logo">

        <h2>Panel de Acceso</h2>

        <form method="POST">

            <div class="input-group">
                <input type="text" name="usuario" required>
                <label>Usuario</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>

            <button class="btn">Entrar</button>

            <?php if(isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>

        </form>

    </div>

</div>

</body>
</html>