<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - SVIS</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <!-- Navbar con Icono y Nombre del Administrador -->
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
            <a href="admin-crear-encuesta.html">Crear Encuesta</a>
            <a href="admin-tokens.html">Padrones OTP</a>
            <a href="admin-usuarios.html" class="active">Usuarios</a>
            <a href="admin-reportes.html">Reportes</a>
        </nav>
        
        <div class="nav-actions">
            <span class="user-role-tag">Administrador</span>
            <a href="login.html" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <main class="main-container">
        <section class="section-block">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <h2>Directorio y Gestión de Usuarios</h2>
                    <p>Listado general de aprendices votantes y administradores registrados en la plataforma[cite: 1].</p>
                </div>
                <div>
                    <!-- Botón para ir a la pantalla de creación -->
                    <a href="admin-usuario-form.html?mode=create" class="btn btn-primary" style="text-decoration: none; padding: 0.75rem 1.25rem; display: inline-block;">+ Registrar Nuevo Usuario</a>
                </div>
            </div>
            
            <!-- Tabla de Listado -->
            <div class="card" style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border-card); margin-top: 1.5rem;">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0; color: #064e3b;">
                                <th style="padding: 0.75rem;">Documento</th>
                                <th style="padding: 0.75rem;">Nombre Completo</th>
                                <th style="padding: 0.75rem;">Correo Institucional</th>
                                <th style="padding: 0.75rem;">Rol</th>
                                <th style="padding: 0.75rem;">Jornada</th>
                                <th style="padding: 0.75rem; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.85rem; font-weight: 600;">1053489210</td>
                                <td style="padding: 0.85rem;">Sofía Gómez R.</td>
                                <td style="padding: 0.85rem;">sgomez@sena.edu.co</td>
                                <td style="padding: 0.85rem;"><span class="badge active" style="background: #e0f2fe; color: #0369a1;">VOTANTE</span></td>
                                <td style="padding: 0.85rem;">Mañana</td>
                                <td style="padding: 0.85rem; text-align: center;">
                                    <a href="admin-usuario-form.html?mode=edit&id=1053489210" style="background: #0284c7; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-right: 0.4rem;">Editar</a>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.85rem; font-weight: 600;">1053412998</td>
                                <td style="padding: 0.85rem;">Andrés Felipe Torres</td>
                                <td style="padding: 0.85rem;">atorres@sena.edu.co</td>
                                <td style="padding: 0.85rem;"><span class="badge active">ADMIN</span></td>
                                <td style="padding: 0.85rem;">Mixta</td>
                                <td style="padding: 0.85rem; text-align: center;">
                                    <a href="admin-usuario-form.html?mode=edit&id=1053412998" style="background: #0284c7; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-right: 0.4rem;">Editar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</html>