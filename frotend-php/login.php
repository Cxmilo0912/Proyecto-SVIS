<?php 


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema - SVIS</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h2>SVIS</h2>
                <p>Sistema de Votaciones Institucionales Seguras</p>
            </div>
            <form action="dashboard.html" method="post" class="login-form">
                <div class="form-group">
                    <label for="usuario">Correo Electronico</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese su correo " required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña de Acceso</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            <div class="login-footer">
                <p>Plataforma de Autenticación Cifrada</p>
            </div>
        </div>
    </div>
</body>
</html>