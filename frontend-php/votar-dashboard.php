<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Votante - SVIS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <!-- Navbar Superior unificada -->
    <header class="top-navbar">
        <div class="nav-brand">
            <h2>SVIS <span>Portal del Votante</span></h2>
        </div>
        <nav class="nav-links">
            <a href="votar-dashboard.html" class="active">Consultas Activas</a>
            <a href="#">Historial y Recibos</a>
        </nav>
        <div class="nav-actions">
            <span class="user-role-tag">Estudiante Votante</span>
            <a href="login.html" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="main-container">
        <!-- Sección 1: Encuestas Activas Disponibles -->
        <section class="section-block">
            <div class="section-header">
                <h2>Votaciones y Consultas Vigentes</h2>
                <p>Visualice únicamente las encuestas habilitadas en las que tiene derecho a participar e ingrese su token OTP para sufragar[cite: 1].</p>
            </div>
            
            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <!-- Tarjeta de Encuesta Activa -->
                <div class="card" style="background-color: var(--bg-card);">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <span class="badge active" style="margin-bottom: 0.5rem; display: inline-block;">ACTIVA</span>
                            <h3>Elección Consejo Estudiantil 2026</h3>
                            <p>Seleccione su candidato de preferencia de forma segura, garantizando el secreto absoluto del sufragio[cite: 1].</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; border-top: 1px solid var(--border-card); padding-top: 1rem;">
                        <a href="votar.html" class="btn btn-primary" style="text-decoration: none; text-align: center; max-width: 200px; display: inline-block;">Ir a Votar &rarr;</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección 2: Historial o Procesos Anteriores -->
        <section class="section-block">
            <div class="section-header">
                <h2>Historial de Participación</h2>
                <p>Registro de procesos democráticos en los cuales su voto ya fue procesado de forma anónima.</p>
            </div>

            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <div class="card" style="background-color: #f8fafc; opacity: 0.85;">
                    <div class="card-header">
                        <span style="background: #cbd5e1; color: #475569; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;">FINALIZADA</span>
                        <h3 style="margin-top: 0.5rem;">Consulta Representante Jornada Nocturna</h3>
                        <p>Sufragio emitido exitosamente. Comprobante hash anónimo registrado.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>