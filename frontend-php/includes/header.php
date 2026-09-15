<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? h($titulo) : 'Gestion de Encuestas ' ?> · SVIS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <header class="top-navbar">
        <div class="nav-brand">
            <h2>SVIS <span>Gestión Electoral</span></h2>
        </div>
        <nav class="nav-links">
            <?php if(is_admin()):?>
                <a href="dashboard.php">Panel Principal</a>
                <a href="admin-encuestas.php">Encuestas</a>
                <a href="admin-usuarios.php">Usuarios</a>
                <a href="admin-tokens.php">Tokens</a>
                <a href="admin-reportes.php">Reportes</a>
            <?php else: ?>
                <a href="votar-dashboard.php">Consultas Activas</a>
            <?php endif; ?>
        </nav>
        <div class="nav-actions">
            
            <?php $u = current_user(); ?>
            <span class="user-role-tag">👤 <?= h($u['Nombre'] ?? $u['Rol']['Nombre']) ?></span>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <main class="main-container">