<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';
require_once __DIR__ . '/includes/auth.php';

$titulo = 'Consultas Activas';
$msg = null;
$err = null;


$u = current_user();
$idJornadaUsuario = $u['Jornada']['Id'] ?? null;

$lista = $idJornadaUsuario
    ? api()->get('/api/encuestas?jornada=' . $idJornadaUsuario)
    : ['ok' => false, 'data' => []];

$mensajeExito = $_GET['exito'] ?? null;
require __DIR__ . '/includes/header.php';

?>
<?php if ($mensajeExito): ?>
            <div style="background-color: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 600; text-align: center;">
                ✓ <?= h($mensajeExito) ?>
            </div>
        <?php endif; ?>
        <section class="section-block">
            <div class="section-header">
                <h2>Votaciones y Consultas Vigentes</h2>
                <p>Visualice únicamente las encuestas habilitadas en las que tiene derecho a participar e ingrese su token OTP para sufragar.</p>
            </div>

            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <?php if (!empty($lista['ok']) && !empty($lista['data'])): ?>
                    <?php $hayActivas = false; ?>
                    <?php foreach ($lista['data'] as $encuesta): ?>
                        <?php if (($encuesta['Estado'] ?? '') === 'ACTIVA'): ?>
                            <?php $hayActivas = true; ?>
                            <div class="card" style="background-color: var(--bg-card);">
                                <div class="card-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                                    <div>
                                        <span class="badge active" style="margin-bottom: 0.5rem; display: inline-block;"><?= h($encuesta['Estado']) ?></span>
                                        <h3><?= h($encuesta['Titulo']) ?></h3>
                                        <p><?= h($encuesta['Descripcion']) ?></p>
                                    </div>
                                </div>
                                <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; border-top: 1px solid var(--border-card); padding-top: 1rem;">
                                    <a href="votar.php?id=<?= (int) $encuesta['Id'] ?>" class="btn btn-primary" style="text-decoration: none; text-align: center; max-width: 200px; display: inline-block;">Ir a Votar &rarr;</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!$hayActivas): ?>
                        <p>No hay encuestas activas para su jornada en este momento.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>No hay encuestas activas para su jornada en este momento.</p>
                <?php endif; ?>
            </div>
        </section>

    </main>
</body>
</html>