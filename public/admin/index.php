<?php
session_start();
require '../../app/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM invitados ORDER BY created_at DESC");
$invitados = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invitados</title>

<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<style>
    .table-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(12px);
    border-radius: 16px;
    padding: 20px;
    margin-top: 20px;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.table-header h2 {
    color: #fff;
    font-size: 18px;
}

.count {
    font-size: 13px;
    opacity: 0.7;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
}

.styled-table thead th {
    text-align: left;
    padding: 12px;
    font-size: 13px;
    opacity: 0.7;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.styled-table tbody tr {
    transition: 0.2s;
}

.styled-table tbody tr:hover {
    background: rgba(255,255,255,0.05);
}

.styled-table td {
    padding: 14px 12px;
    font-size: 14px;
}

.name {
    font-weight: 600;
}

.date {
    font-size: 12px;
    opacity: 0.6;
}

/* badges */
.badge {
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 12px;
}

.success {
    background: rgba(40, 167, 69, 0.2);
    color: #4ade80;
}

.pending {
    background: rgba(255, 193, 7, 0.2);
    color: #facc15;
}
</style>

<body>

<div class="container">

    <div class="header">
        <h1>Invitados</h1>
        <div>
            <a href="create.php" class="btn">+ Nuevo invitado</a>
            <br>
            <a href="dashboard.php" class="logout">← Volver</a>
        </div>
    </div>

    <div class="table-card">

        <div class="table-header">
            <h2>Lista de invitados</h2>
            <span class="count"><?= count($invitados) ?> registros</span>
        </div>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Iglesia</th>
                    <th>Asistencia</th>
                    <th>Fecha</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($invitados as $inv): ?>
                    <tr>
                        <td class="name"><?= htmlspecialchars($inv['nombre']) ?></td>

                        <td><?= htmlspecialchars($inv['telefono']) ?></td>

                        <td>
                            <?= htmlspecialchars($inv['iglesia'] ?? '-') ?>
                        </td>

                        <td>
                            <?php if($inv['asistio']): ?>
                                <span class="badge success">✔ Asistió</span>
                            <?php else: ?>
                                <span class="badge pending">⏳ Pendiente</span>
                            <?php endif; ?>
                        </td>

                        <td class="date"><?= $inv['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>