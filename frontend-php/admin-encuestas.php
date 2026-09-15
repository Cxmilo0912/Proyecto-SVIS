<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Crear Encuesta';
$msg = null;
$err = null;


$lista = api()->get('/encuestas');
require __DIR__ . '/includes/header.php';

?>
        <section class="section-block">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div>
                    <h2>Directorio de Encuestas y Votaciones</h2>
                    <p>Listado de procesos democráticos creados para parametrizar el título, opciones y estado de apertura[cite: 1].</p>
                </div>
                <div>
                    <a href="admin-crear-encuesta.php" class="btn btn-primary" style="text-decoration: none; padding: 0.75rem 1.25rem; display: inline-block;">+ Crear Nueva Encuesta</a>
                </div>
            </div>
            
            <div class="card" style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border-card); margin-top: 1.5rem;">
                <?php if (!$lista['ok']): ?>
                    <div style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: 0.95rem;">
                        <?= h($lista['error'] ?? 'No se pudo cargar la lista') ?>
                    </div>
                <?php elseif (empty($lista['data'])): ?>
                    <p>Aún no hay encuestas programadas.</p>
                <?php else: ?>
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
                            <?php foreach ($lista['data']as $e): ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 0.85rem; font-weight: 600;"><?= (int) $e['Id'] ?></td>
                                <td style="padding: 0.85rem;"><?= h($e['Titulo']) ?></td>
                                <td style="padding: 0.85rem;"><?= h($e['Jornada']) ?></td>
                                <td style="padding: 0.85rem;"><span class="badge active"><?= h($e['Estado']) ?></span></td>
                                <td style="padding: 0.85rem; text-align: center;">
                                    <a href="admin-crear-encuesta.php?mode=edit&id=<?= (int) $e['Id'] ?>" style="background: #0284c7; color: white; padding: 0.35rem 0.75rem; border-radius: 6px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-right: 0.4rem;">Editar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</html>