<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Gestión de Usuarios';
$msg = null;
$err = null;

$listaUsuarios = api()->get('/api/usuarios');

require __DIR__ . '/includes/header.php';
?>

<style>
    .table-usuarios {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
    }
    .table-usuarios thead tr {
        border-bottom: 2px solid #e2e8f0;
        color: #064e3b;
    }
    .table-usuarios th {
        padding: 0.85rem 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.03em;
        color: #475569;
    }
    .table-usuarios tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.15s ease;
    }
    .table-usuarios tbody tr:hover {
        background-color: #f8fafc;
    }
    .table-usuarios td {
        padding: 0.85rem 0.75rem;
        vertical-align: middle;
    }
    .badge-rol {
        display: inline-block;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-rol.admin {
        background: #dcfce7;
        color: #166534;
    }
    .badge-rol.votante {
        background: #e0f2fe;
        color: #0369a1;
    }
    .btn-editar {
        background: #0284c7;
        color: white;
        border: none;
        cursor: pointer;
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .btn-editar:hover {
        background: #0369a1;
    }
    .empty-state {
        padding: 2.5rem 1rem;
        text-align: center;
        color: #64748b;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .modal-overlay.open {
        display: flex;
    }
    .modal-overlay.show {
        opacity: 1;
    }
    .modal-box {
        background: white;
        border-radius: 14px;
        width: 100%;
        max-width: 460px;
        padding: 1.75rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        transform: translateY(-24px) scale(0.96);
        opacity: 0;
        transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
    }
    .modal-overlay.show .modal-box {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
    .modal-box h3 {
        margin: 0 0 1.25rem;
        color: #064e3b;
    }
    .modal-field {
        margin-bottom: 1rem;
    }
    .modal-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.35rem;
    }
    .modal-field input,
    .modal-field select {
        width: 100%;
        padding: 0.55rem 0.7rem;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.9rem;
        box-sizing: border-box;
    }
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.6rem;
        margin-top: 1.5rem;
    }
    .modal-actions button {
        padding: 0.55rem 1.1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border: none;
    }
    .btn-cancelar {
        background: #e2e8f0;
        color: #334155;
    }
    .btn-guardar {
        background: #059669;
        color: white;
    }
</style>

<section class="section-block">
    <div class="section-header" style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h2>Directorio y Gestión de Usuarios</h2>
            <p>Listado general de aprendices votantes y administradores registrados en la plataforma.</p>
        </div>
        <div>
            <a href="admin-usuario-form.php" class="btn btn-primary" style="text-decoration: none; padding: 0.75rem 1.25rem; display: inline-block;">+ Registrar Nuevo Usuario</a>
        </div>
    </div>

    <div class="card" style="background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid var(--border-card); margin-top: 1.5rem;">
        <div style="overflow-x: auto;">
            <table class="table-usuarios">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>Nombre Completo</th>
                        <th>Correo Institucional</th>
                        <th>Rol</th>
                        <th>Jornada</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($listaUsuarios['data'])): ?>
                    <tr>
                        <td colspan="7" class="empty-state">No hay usuarios registrados todavía.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($listaUsuarios['data'] as $u): ?>
                        <?php $esAdmin = $u['Rol'] === 'Administrador'; ?>
                        <tr>
                            <td style="font-weight: 600;"><?= (int) $u['Id'] ?></td>
                            <td style="font-weight: 600;"><?= h($u['Documento']) ?></td>
                            <td style="font-weight: 600;"><?= h($u['Celular']) ?></td>
                            <td><?= h($u['Nombre'] . ' ' . $u['Apellido']) ?></td>
                            <td><?= h($u['Email']) ?></td>
                            <td>
                                <span class="badge-rol <?= $esAdmin ? 'admin' : 'votante' ?>"><?= h($u['Rol']) ?></span>
                            </td>
                            <td><?= h($u['Jornada']) ?></td>
                            <td style="text-align: center;">
                                <button
                                    type="button"
                                    class="btn-editar"
                                    onclick="abrirModalEditar(this)"
                                    data-id="<?= (int) $u['Id'] ?>"
                                    data-documento="<?= h($u['Documento']) ?>"
                                    data-nombre="<?= h($u['Nombre']) ?>"
                                    data-apellido="<?= h($u['Apellido']) ?>"
                                    data-email="<?= h($u['Email']) ?>"
                                    data-celular="<?= h($u['Celular'] ?? '') ?>"
                                    data-rol="<?= h($u['Rol']) ?>"
                                    data-jornada="<?= h($u['Jornada']) ?>"
                                >
                                    Editar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal de edición -->
<div class="modal-overlay" id="modalEditar">
    <div class="modal-box">
        <h3>Editar Usuario</h3>
        <form id="formEditarUsuario" method="post" action="admin-usuario-update.php">
            <input type="hidden" name="id" id="edit-id">

            <div class="modal-field">
                <label for="edit-documento">Documento</label>
                <input type="text" name="documento" id="edit-documento" required>
            </div>
            <div class="modal-field">
                <label for="edit-nombre">Nombre</label>
                <input type="text" name="nombre" id="edit-nombre" required>
            </div>
            <div class="modal-field">
                <label for="edit-apellido">Apellido</label>
                <input type="text" name="apellido" id="edit-apellido" required>
            </div>
            <div class="modal-field">
                <label for="edit-email">Correo</label>
                <input type="email" name="email" id="edit-email" required>
            </div>
            <div class="modal-field">
                <label for="edit-celular">Celular</label>
                <input type="text" name="celular" id="edit-celular">
            </div>
            <div class="modal-field">
                <label for="edit-rol">Rol</label>
                <select name="rol" id="edit-rol">
                    <option value="" disabled>Seleccione...</option>
                    <?php
                        $resRol = api()->get('/api/roles');
                        if (!empty($resRol['ok']) && !empty($resRol['data'])) {
                            foreach ($resRol['data'] as $r) {
                                $idR = h($r['id'] ?? $r['Id'] ?? '');
                                $nomR = h($r['nombre'] ?? $r['Nombre'] ?? '');
                                echo '<option value="' . $idR . '">' . $nomR . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>Error cargando roles</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="modal-field">
                <label for="edit-jornada">Jornada</label>
                <select name="jornada" id="edit-jornada">
                    <option value="" disabled>Seleccione...</option>
                    <?php
                        $resJornada = api()->get('/api/jornadas');
                        if (!empty($resJornada['ok']) && !empty($resJornada['data'])) {
                            foreach ($resJornada['data'] as $j) {
                                $idJ = h($j['id'] ?? $j['Id'] ?? '');
                                $nomJ = h($j['nombre'] ?? $j['Nombre'] ?? '');
                                echo '<option value="' . $idJ . '">' . $nomJ . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>Error cargando jornadas</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancelar" onclick="cerrarModalEditar()">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
    function seleccionarPorTexto(selectEl, textoBuscado) {
        const opciones = Array.from(selectEl.options);
        const match = opciones.find(
            opt => opt.textContent.trim().toLowerCase() === (textoBuscado || '').trim().toLowerCase()
        );
        selectEl.value = match ? match.value : '';
    }

    function abrirModalEditar(btn) {
        document.getElementById('edit-id').value = btn.dataset.id;
        document.getElementById('edit-documento').value = btn.dataset.documento;
        document.getElementById('edit-nombre').value = btn.dataset.nombre;
        document.getElementById('edit-apellido').value = btn.dataset.apellido;
        document.getElementById('edit-email').value = btn.dataset.email;
        document.getElementById('edit-celular').value = btn.dataset.celular;

        seleccionarPorTexto(document.getElementById('edit-rol'), btn.dataset.rol);
        seleccionarPorTexto(document.getElementById('edit-jornada'), btn.dataset.jornada);

        const overlay = document.getElementById('modalEditar');
        overlay.classList.add('open');
        requestAnimationFrame(() => {
            requestAnimationFrame(() => overlay.classList.add('show'));
        });
    }

    function cerrarModalEditar() {
        const overlay = document.getElementById('modalEditar');
        overlay.classList.remove('show');
        setTimeout(() => overlay.classList.remove('open'), 250);
    }

    document.getElementById('modalEditar').addEventListener('click', function (e) {
        if (e.target === this) cerrarModalEditar();
    });

    document.getElementById('formEditarUsuario').addEventListener('submit', async function (e) {
        e.preventDefault();

        const btnGuardar = this.querySelector('.btn-guardar');
        const textoOriginal = btnGuardar.textContent;
        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        const idUsuario = parseInt(document.getElementById('edit-id').value, 10);
        const payload = {
            Documento: document.getElementById('edit-documento').value.trim(),
            Nombre: document.getElementById('edit-nombre').value.trim(),
            Apellido: document.getElementById('edit-apellido').value.trim(),
            Email: document.getElementById('edit-email').value.trim(),
            Celular: document.getElementById('edit-celular').value.trim(),
            IdRol: parseInt(document.getElementById('edit-rol').value, 10),
            IdJornada: parseInt(document.getElementById('edit-jornada').value, 10)
        };
        console.log('Payload completo:', payload);


        try {
            const apiUrl = 'http://localhost:8080/backend-java/api/usuarios/' + idUsuario;
            const methodHttp = 'POST';

            const response = await fetch(apiUrl, {
                method: methodHttp,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const resData = await response.json().catch(() => ({}));

            if (response.ok) {
                alert('¡Usuario actualizado exitosamente!');
                window.location.href = 'admin-usuarios.php';
            } else {
                alert('Error (' + response.status + '): ' + (resData.mensaje || resData.error || 'No se pudo actualizar el usuario'));
            }
        } catch (err) {
            console.error('Error de red:', err);
            alert('Ocurrió un error al conectar con el servidor Java (Tomcat).');
        } finally {
            btnGuardar.disabled = false;
            btnGuardar.textContent = textoOriginal;
        }
    });
</script>

</main>
</body>
</html>