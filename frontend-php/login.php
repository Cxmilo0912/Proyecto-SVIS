<?php 

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';
require_once __DIR__ . '/includes/auth.php';

if(is_logged_in()){
    header('location: ' . (is_admin() ? 'admin-reportes.php' : 'votar-dashboard.php'));
    exit;
}

$error = null;
$mensaje = null;


function login($usuario, $password){
    $resp = api()->post('/api/login',[
        'Email' => $usuario,
        'Contrasena' => $password
    ]);

    if($resp['ok']){

    $_SESSION['usuario'] = $resp['data'];
    return ['ok' => true];
    }

    $mensajeError = $resp['data']['error'] ?? 'Credenciales inválidas o error de conexión.';
    return ['ok' => false, 'error' => $mensajeError];
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario === '' || $password === '') {
        $error = 'Por favor ingresa tu correo y contraseña.';
    } else {
        $res = login($usuario, $password);
        if ($res['ok']) {

            if (is_admin()) {
                header('Location: dashboard.php'); 
            } else {
                header('Location: votar-dashboard.php'); 
            }
            exit;
        } else {
            $error = $res['error'];
        }
    }
}


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
            <?php if (!empty($error)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; text-align: center;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form  method="post" class="login-form">
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