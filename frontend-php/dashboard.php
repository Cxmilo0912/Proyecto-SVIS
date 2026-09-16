<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Dashboard Admin';
$msg = null;
$err = null;

$resIndicadores = api()->get('/api/dashboard');

$indicadores = $resIndicadores['ok'] ? $resIndicadores['data'] : [];

$encuestasActivas = $indicadores['EncuestaActivas'] ?? 0;
$votantesHabilitados = $indicadores['VotantesHabilitados'] ?? 0;
$sufragiosEmitidos = $indicadores['SufragiosEmitidos'] ?? 0;
$participacionGlobal = $indicadores['ParticipacionGlobal'] ?? 0;

require __DIR__ . '/includes/header.php';

?>
        <section class="section-block">
            <div class="section-header">
                <h2>Indicadores Generales del Sistema</h2>
                <p>Resumen métrico del estado actual de las elecciones institucionales y participación global.</p>
            </div>
            
            <div class="dashboard-grid" style="grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">ENCUESTAS ACTIVAS</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: var(--primary);"><?= (int) $encuestasActivas ?></h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">TOTAL VOTANTES HABILITADOS</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #022c22;"><?= (int) $votantesHabilitados ?></h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">SUFRAGIOS EMITIDOS</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #0d9488;"><?= (int) $sufragiosEmitidos ?></h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">PARTICIPACIÓN GLOBAL</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #059669;"><?= number_format((float) $participacionGlobal, 1) ?>%</h3>
                </div>
            </div>
        </section>

        <div class="dashboard-grid" style="grid-template-columns: 1fr;">
            <section class="card">
                <div class="card-header">
                    <h3>Accesos Rápidos</h3>
                    <p>Acciones frecuentes de administración electoral.</p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <a href="admin-crear-encuesta.php" class="btn btn-primary" style="text-decoration: none; text-align: center; display: block;">+ Crear Nueva Encuesta</a>
                    <a href="admin-usuario-form.php" class="btn" style="background: #0d9488; color: #ffffff; text-decoration: none; text-align: center; display: block;">+ Crear Usuario</a>
                    <a href="admin-tokens.php" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; display: block;">Gestionar Padrón de Tokens OTP</a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>