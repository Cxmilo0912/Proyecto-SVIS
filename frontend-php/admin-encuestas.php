<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Encuestas - SVIS</title>
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
        <section class="section-block">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <h2>Directorio de Encuestas y Votaciones</h2>
                    <p>Listado de procesos democráticos creados para parametrizar el título, opciones y estado de apertura[cite: 1].</p>
                </div>
                <div>
                    <a href="admin-encuesta-form.html?mode=create" class="btn btn-primary" style="text-decoration: none; padding: 0.75rem 1.25rem; display: inline-block;">+ Crear Nueva Encuesta</a>
                </div>
            </div>
            
            <div class="card" style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border-card); margin-top: 1.5rem;">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0; color: #064e3b;">
                                <th style="padding: 0.75rem;">ID</th>
                                <th style="padding: 0.75rem;">Título de la Votación</th>
                                <th style="padding: 0.75rem;">Jornada</th>
                                <th style="padding: 0.75rem;">Estado</th>
                                <th style="padding: 0.75rem; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.85rem; font-weight: 600;">1</td>
                                <td style="padding: 0.85rem;">Elección Consejo Estudiantil 2026</td>
                                <td style="padding: 0.85rem;">Mixta</td>
                                <td style="padding: 0.85rem;"><span class="badge active">ACTIVA</span></td>
                                <td style="padding: 0.85rem; text-align: center;">
                                    <a href="admin-encuesta-form.html?mode=edit&id=1" style="background: #0284c7; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-right: 0.4rem;">Editar</a>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.85rem; font-weight: 600;">2</td>
                                <td style="padding: 0.85rem;">Consulta Representante Jornada Nocturna</td>
                                <td style="padding: 0.85rem;">Noche</td>
                                <td style="padding: 0.85rem;"><span class="badge" style="background: #e2e8f0; color: #475569;">CERRADA</span></td>
                                <td style="padding: 0.85rem; text-align: center;">
                                    <a href="admin-encuesta-form.html?mode=edit&id=2" style="background: #0284c7; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-right: 0.4rem;">Editar</a>
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