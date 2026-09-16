<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';
require_once __DIR__ . '/includes/auth.php';

$idEncuesta = (int) ($_POST['id_encuesta'] ?? 0);
$idOpcion = (int) ($_POST['opcion_id'] ?? 0);
$token = trim($_POST['token_otp'] ?? '');

if (!$idEncuesta || !$idOpcion || $token === '') {
    header('Location: votar.php?id=' . $idEncuesta . '&error=' . urlencode('Todos los campos son obligatorios.'));
    exit;
}

$resp = api()->post('/api/tokens/' . $idEncuesta . '/' . $token, [
    'idOpcion' => $idOpcion
]);

if (!empty($resp['ok'])) {
    header('Location: votar-dashboard.php?exito=' . urlencode('¡Tu voto fue registrado exitosamente!'));
} else {
    $mensajeError = $resp['data']['mensaje'] ?? $resp['data']['error'] ?? 'No se pudo registrar el voto.';
    header('Location: votar.php?id=' . $idEncuesta . '&error=' . urlencode($mensajeError));
}
exit;