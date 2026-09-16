<?php
require_once __DIR__ . '/../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db()
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

function current_user()
{
    return $_SESSION['usuario'] ?? null;
}

function is_logged_in()
{
    return !empty($_SESSION['usuario']);
}
function is_admin()
{
    $u = current_user();
    return $u && (($u['Rol']['Nombre'] ?? '') === 'Administrador');
}

function logout()
{
    $_SESSION['usuario'] = null;
    unset($_SESSION['usuario']);
    session_destroy();
}
