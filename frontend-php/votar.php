<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/ApiClient.php';

$u = current_user();
$idUsuario = $u['Id'] ?? null;
$titulo = 'Votar';
$msg = null;
$err = null;

$idEncuesta = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$idEncuesta) {
    header('Location: votar-dashboard.php');
    exit;
}

$resEncuesta = api()->get('/api/encuestas/' . $idEncuesta);
$encuesta = null;

$resTokenVotar = api()->get('/api/tokens?idEncuesta=' . $idEncuesta . '&idUsuario=' . $idUsuario);

$token = null;
// Extraemos el texto del token desde la llave 'data' si la petición fue exitosa
if (!empty($resTokenVotar['ok']) && !empty($resTokenVotar['data'])) {
    $token = $resTokenVotar['data'];
}

if (!empty($resEncuesta['ok']) && !empty($resEncuesta['data']) && is_array($resEncuesta['data'])) {
    $encuesta = $resEncuesta['data'][0] ?? null; 
}

if (!$encuesta || ($encuesta['Estado'] ?? '') !== 'ACTIVA') {
    $err = 'Esta encuesta no está disponible o ya no se encuentra activa.';
}

$errorVoto = $_GET['error'] ?? null;

require __DIR__ . '/includes/header.php';
?>
        <section class="section-block" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header">
                <h2>Emisión de Sufragio Seguro</h2>
            </div>

            <div class="card-creation" style="padding: 2.5rem;">
                <?php if ($err): ?>
                    <div style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 1rem; border-radius: 6px;">
                        <?= h($err) ?>
                    </div>
                <?php else: ?>

                <?php if ($errorVoto): ?>
                    <div style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-weight: 600;">
                        ⚠ <?= h($errorVoto) ?>
                    </div>
                <?php endif; ?>

                <form action="votar-procesar.php" method="POST" class="styled-form">
                    <input type="hidden" name="id_encuesta" value="<?= (int) $encuesta['Id'] ?>">

                    <!-- Información de la Encuesta -->
                    <div style="background-color: #f0fdf4; border: 1px solid var(--border); border-radius: 8px; padding: 1.25rem; margin-bottom: 2rem;">
                        <span class="badge active" style="margin-bottom: 0.5rem; display: inline-block;"><?= h($encuesta['Estado']) ?></span>
                        <h3 style="margin: 0 0 0.5rem 0; color: #022c22; font-size: 1.2rem;"><?= h($encuesta['Titulo']) ?></h3>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem;">
                            <?= h($encuesta['Descripcion']) ?>
                        </p>
                    </div>

                    <!-- Opciones de Votación -->
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label style="font-size: 0.95rem; margin-bottom: 0.75rem;">Opciones de Elección Disponibles</label>

                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <?php foreach ($encuesta['opciones'] ?? [] as $opcion): ?>
                            <label style="display: flex; align-items: center; background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 1rem; border-radius: 8px; cursor: pointer; transition: all 0.2s;">
                                <input type="radio" name="opcion_id" value="<?= (int) $opcion['Id'] ?>" required style="width: 1.1rem; height: 1.1rem; margin-right: 1rem; accent-color: var(--primary);">
                                <div>
                                    <span style="display: block; font-weight: 600; color: #022c22;"><?= h($opcion['Opcion']) ?></span>
                                </div>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if (!empty($token)) : ?>
<div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid #10b981; padding: 1.25rem 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05); margin: 0 0 2rem 0; width: 100%; box-sizing: border-box;">
    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
        <svg style="width: 20px; height: 20px; color: #059669; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4v-1m18-11V5a2 2 0 00-2-2h-.098a4.99 4.99 0 00-4.004 2M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        <span style="font-weight: 600; color: #065f46; font-size: 0.95rem;">Token de Uso Único</span>
    </div>
    
    <p style="color: #047857; font-size: 0.875rem; margin: 0 0 0.75rem 0;">
        Utiliza el siguiente código para ejercer tu votación de forma segura (si ya votaste omite este mensaje 👻)
    </p>
    
    <div style="background-color: #ffffff; border: 1px dashed #86efac; padding: 0.75rem; border-radius: 6px; text-align: center;">
        <span style="font-family: monospace; font-size: 1.25rem; font-weight: 700; color: #065f46; letter-spacing: 2px;">
            <?php echo h($token); ?>
        </span>
    </div>
</div>
<?php else : ?>
<div style="background: #fffbeb; border: 1px solid #fde68a; border-left: 4px solid #f59e0b; padding: 1.25rem 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05); margin: 0 0 2rem 0; width: 100%; box-sizing: border-box;">
    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
        <svg style="width: 20px; height: 20px; color: #d97706; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <span style="font-weight: 600; color: #b45309; font-size: 0.95rem;">Token Pendiente</span>
    </div>
    
    <p style="color: #b45309; font-size: 0.875rem; margin: 0;">
        Aún no te han asignado tu código de uso único para esta votación.
    </p>
</div>
<?php endif; ?>

                    <!-- Validación de Token OTP -->
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for="token_otp">Token OTP de Un Solo Uso</label>
                        <input type="text" id="token_otp" name="token_otp" placeholder="Ej. 986AB45Z" required autocomplete="off" style="text-align: center; font-family: monospace; font-size: 1.1rem; letter-spacing: 2px;">
                        <small>Ingrese el código único asignado para esta votación. El sistema rechazará de inmediato cualquier intento de doble voto o concurrencia.</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem; font-size: 1rem;">Emitir Voto Definitivo</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>