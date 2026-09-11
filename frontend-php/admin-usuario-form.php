<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuario - SVIS</title>
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
            <a href="admin-encuestas.html">Encuestas</a>
            <a href="admin-usuarios.html" class="active">Usuarios</a>
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
                <h2>Registrar o Modificar Usuario</h2>
                <p>Complete los datos personales, de contacto, contraseña y asignación de rol para el control electoral.</p>
            </div>
            
            <div class="card-creation" style="padding: 2.5rem;">
                <form action="admin-usuarios.html" method="POST" class="styled-form">
                    <!-- Fila 1: Documento y Teléfono -->
                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="documento">Número de Documento</label>
                            <input type="text" id="documento" name="documento" placeholder="Ej. 1053489210" required style="padding: 0.85rem;">
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="telefono">Teléfono / Celular</label>
                            <input type="tel" id="telefono" name="telefono" placeholder="Ej. 3104567890" required style="padding: 0.85rem;">
                        </div>
                    </div>

                    <!-- Fila 2: Nombre y Apellido (Separados) -->
                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Ej. Sofía" required style="padding: 0.85rem;">
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="apellido">Apellido</label>
                            <input type="text" id="apellido" name="apellido" placeholder="Ej. Gómez Ruiz" required style="padding: 0.85rem;">
                        </div>
                    </div>

                    <!-- Fila 3: Correo e Identificación de Contraseña -->
                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="correo">Correo Institucional</label>
                            <input type="email" id="correo" name="correo" placeholder="usuario@sena.edu.co" required style="padding: 0.85rem;">
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="password">Contraseña de Acceso</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" required style="padding: 0.85rem;">
                        </div>
                    </div>

                    <!-- Fila 4: Rol y Jornada -->
                    <div class="form-row" style="margin-bottom: 2rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="rol">Rol del Sistema</label>
                            <select id="rol" name="rol" required style="padding: 0.85rem;">
                                <option value="VOTANTE">Votante (Estudiante)</option>
                                <option value="ADMIN">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="jornada">Jornada Académica</label>
                            <select id="jornada" name="jornada" required style="padding: 0.85rem;">
                                <option value="MAÑANA">Mañana</option>
                                <option value="TARDE">Tarde</option>
                                <option value="NOCHE">Noche</option>
                                <option value="MIXTA">Mixta / General</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1rem;">
                        <a href="admin-usuarios.html" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; padding: 0.85rem 1.5rem; width: auto; font-weight: 600;">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; width: auto;">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>