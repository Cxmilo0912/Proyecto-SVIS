<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

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

                    <!-- Validación de Token OTP -->
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for="token_otp">Token OTP de Un Solo Uso</label>
                        <input type="text" id="token_otp" name="token_otp" placeholder="Ej. A9F3-B28E-7C11" required autocomplete="off" style="text-align: center; font-family: monospace; font-size: 1.1rem; letter-spacing: 2px;">
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