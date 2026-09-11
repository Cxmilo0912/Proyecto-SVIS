<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Encuesta - SVIS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <header class="top-navbar">
        <div class="nav-brand" style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="font-size: 1.4rem; background: rgba(52, 211, 153, 0.15); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">🛡️</span>
            <div>
                <h2 style="margin: 0; line-height: 1.2; font-size: 1rem;">Admin. Carlos Pérez</h2>
                <span style="font-size: 0.75rem; color: #34d399; font-weight: 500;">Gestión Electoral SVIS</span>
            </div>
        </div>
        
        <nav class="nav-links">
            <a href="dashboard.html">Métricas Generales</a>
            <a href="admin-encuestas.html" class="active">Encuestas</a>
            <a href="admin-usuarios.html">Usuarios</a>
            <a href="admin-tokens.html">Padrones OTP</a>
            <a href="admin-reportes.html">Reportes</a>
        </nav>
        
        <div class="nav-actions">
            <span class="user-role-tag">Administrador</span>
            <a href="login.html" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <main class="main-container">
        <section class="section-block" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header">
                <h2>Registrar o Modificar Encuesta</h2>
                <p>Configura los parámetros del proceso democrático, la jornada y las opciones de votación[cite: 1].</p>
            </div>
            
            <div class="card-creation" style="padding: 2.5rem;">
                <form action="admin-encuestas.html" method="POST" class="styled-form">
                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-2" style="margin-bottom: 0;">
                            <label for="titulo">Título de la Votación</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Ej. Elección Consejo Estudiantil 2026" required style="padding: 0.85rem;">
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="jornada">Jornada Institucional</label>
                            <select id="jornada" name="jornada" required style="padding: 0.85rem;">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="MAÑANA">Mañana</option>
                                <option value="TARDE">Tarde</option>
                                <option value="NOCHE">Noche</option>
                                <option value="MIXTA">Mixta / General</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="descripcion">Descripción Institucional</label>
                        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Detalles de la convocatoria y normativas vigentes..." required style="padding: 0.85rem;"></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for="opciones">Opciones de Elección</label>
                        <input type="text" id="opciones" name="opciones" placeholder="Opción A, Opción B, Opción C" required style="padding: 0.85rem;">
                        <small>Separe cada opción utilizando una coma. El contador se incrementará numéricamente para preservar el secreto absoluto del voto[cite: 1].</small>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1rem;">
                        <a href="admin-encuestas.html" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; padding: 0.85rem 1.5rem; width: auto; font-weight: 600;">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; width: auto;">Guardar Encuesta</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>