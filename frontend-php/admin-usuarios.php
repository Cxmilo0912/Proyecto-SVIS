<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Crear Encuesta';
$msg = null;
$err = null;


require __DIR__ . '/includes/header.php';

?>
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