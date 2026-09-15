<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Dashboard Admin';
$msg = null;
$err = null;


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
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: var(--primary);">2</h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">TOTAL VOTANTES HABILITADOS</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #022c22;">850</h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">SUFRAGIOS EMITIDOS</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #0d9488;">412</h3>
                </div>
                <div class="card" style="padding: 1.25rem; text-align: center;">
                    <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">PARTICIPACIÓN GLOBAL</span>
                    <h3 style="font-size: 2rem; margin: 0.5rem 0 0 0; color: #059669;">48.4%</h3>
                </div>
            </div>
        </section>

        <!-- Sección de Monitoreo Rápido de Procesos -->
        <div class="dashboard-grid">
            <section class="card">
                <div class="card-header">
                    <h3>Estado de Concurrencia ACID</h3>
                    <p>Monitoreo de bloqueos de fila y peticiones concurrentes resueltas en el backend[cite: 1].</p>
                </div>
                <div style="background: #f8fafc; border: 1px solid var(--border-card); border-radius: 8px; padding: 1rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <span>Peticiones HTTP 200 (Éxito):</span>
                        <strong style="color: #059669;">412</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <span>Conflictos de Concurrencia (HTTP 409):</span>
                        <strong style="color: #dc2626;">3</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                        <span>Tokens Quemados de Forma Atómica:</span>
                        <strong style="color: #022c22;">412</strong>
                    </div>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <h3>Accesos Rápidos</h3>
                    <p>Acciones frecuentes de administración electoral.</p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <a href="admin-crear-encuesta.html" class="btn btn-primary" style="text-decoration: none; text-align: center; display: block;">+ Crear Nueva Encuesta</a>
                    <a href="admin-tokens.html" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; display: block;">Gestionar Padrón de Tokens OTP</a>
                </div>
            </section>
        </div>
    </main>
</body>
</html>