<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Resultados - SVIS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <header class="top-navbar">
        <div class="nav-brand">
            <h2>SVIS <span>Gestión Electoral</span></h2>
        </div>
        <nav class="nav-links">
            <a href="dashboard.html">Panel Principal</a>
            <a href="admin-tokens.html">Padrones OTP</a>
            <a href="admin-reportes.html" class="active">Reportes</a>
        </nav>
        <div class="nav-actions">
            <span class="user-role-tag">Administrador</span>
            <a href="login.html" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <main class="main-container">
        <section class="section-block">
            <div class="section-header">
                <h2>Consolidado y Auditoría de Resultados</h2>
                <p>Visualización en tiempo real del conteo acumulado y porcentajes definitivos por cada opción[cite: 1].</p>
            </div>
            
            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <section class="card" style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid var(--border-card);">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3>Elección Consejo Estudiantil 2026</h3>
                            <p>Resultados oficiales auditados mediante control de concurrencia ACID.</p>
                        </div>
                        <span class="badge active">ACTIVA</span>
                    </div>

                    <div class="results-container" style="margin-top: 1.5rem;">
                        <div class="progress-bars" style="gap: 1.25rem;">
                            <div class="progress-item">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem;">
                                    <span style="font-weight: 600;">Opción A: Innovación CIMM</span>
                                    <span style="font-weight: 700; color: #059669;">145 votos (55%)</span>
                                </div>
                                <div class="progress-bar" style="height: 12px;"><div class="fill" style="width: 55%;"></div></div>
                            </div>

                            <div class="progress-item">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem;">
                                    <span style="font-weight: 600;">Opción B: Liderazgo Activo</span>
                                    <span style="font-weight: 700; color: #0d9488;">118 votos (45%)</span>
                                </div>
                                <div class="progress-bar" style="height: 12px;"><div class="fill secondary" style="width: 45%;"></div></div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">Total sufragios procesados: <strong>263 votos</strong></span>
                        <button type="button" class="btn btn-primary" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem;">Exportar Auditoría (JSON/CSV)</button>
                    </div>
                </section>
            </div>
        </section>
    </main>
</body>
</html>