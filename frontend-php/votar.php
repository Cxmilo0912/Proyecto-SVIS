<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emisión de Sufragio - SVIS</title>
    
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <!-- Navbar Superior unificada -->
    <header class="top-navbar">
        <div class="nav-brand">
            <h2>SVIS <span>Portal del Votante</span></h2>
        </div>
        <nav class="nav-links">
            <a href="votar-dashboard.html">Consultas Activas</a>
            <a href="#" class="active">Emisión de Sufragio</a>
        </nav>
        <div class="nav-actions">
            <span class="user-role-tag">Estudiante Votante</span>
            <a href="login.html" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="main-container">
        <section class="section-block" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header">
                <h2>Emisión de Sufragio Seguro</h2>
                <p>Seleccione su candidato preferido de acuerdo con las opciones habilitadas. Su voto garantiza el anonimato absoluto[cite: 1].</p>
            </div>
            
            <div class="card-creation" style="padding: 2.5rem;">
                <form action="#" method="POST" class="styled-form">
                    <!-- Información de la Encuesta -->
                    <div style="background-color: #f0fdf4; border: 1px solid var(--border); border-radius: 8px; padding: 1.25rem; margin-bottom: 2rem;">
                        <span class="badge active" style="margin-bottom: 0.5rem; display: inline-block;">ACTIVA</span>
                        <h3 style="margin: 0 0 0.5rem 0; color: #022c22; font-size: 1.2rem;">Elección Consejo Estudiantil 2026</h3>
                        <p style="margin: 0; color: var(--text-secondary); font-size: 0.9rem;">
                            Ejerza su derecho de forma transparente y secreta. Al enviar su voto, el token OTP ingresado sufrirá una quema atómica inmediata[cite: 1].
                        </p>
                    </div>

                    <!-- Opciones de Votación -->
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label style="font-size: 0.95rem; margin-bottom: 0.75rem;">Opciones de Elección Disponibles</label>
                        
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <label style="display: flex; align-items: center; background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 1rem; border-radius: 8px; cursor: pointer; transition: all 0.2s;">
                                <input type="radio" name="opcion_id" value="1" required style="width: 1.1rem; height: 1.1rem; margin-right: 1rem; accent-color: var(--primary);">
                                <div>
                                    <span style="display: block; font-weight: 600; color: #022c22;">Candidato Lista 1 - Innovación CIMM</span>
                                    <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Propuestas enfocadas en tecnología y desarrollo ágil.</span>
                                </div>
                            </label>

                            <label style="display: flex; align-items: center; background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 1rem; border-radius: 8px; cursor: pointer; transition: all 0.2s;">
                                <input type="radio" name="opcion_id" value="2" required style="width: 1.1rem; height: 1.1rem; margin-right: 1rem; accent-color: var(--primary);">
                                <div>
                                    <span style="display: block; font-weight: 600; color: #022c22;">Candidato Lista 2 - Liderazgo Activo</span>
                                    <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Propuestas orientadas al bienestar integral del aprendiz.</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Validación de Token OTP -->
                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for="token_otp">Token OTP de Un Solo Uso</label>
                        <input type="text" id="token_otp" name="token_otp" placeholder="Ej. A9F3-B28E-7C11" required autocomplete="off" style="text-align: center; font-family: monospace; font-size: 1.1rem; letter-spacing: 2px;">
                        <small>Ingrese el código único asignado para esta votación. El sistema rechazará de inmediato cualquier intento de doble voto o concurrencia[cite: 1].</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem; font-size: 1rem;">Emitir Voto Definitivo</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>