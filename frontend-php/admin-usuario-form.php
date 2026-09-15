<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Crear Encuesta';
$msg = null;
$err = null;



require __DIR__ . '/includes/header.php';

?>
        <section class="section-block" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header">
                <h2>Registrar o Modificar Usuario</h2>
                <p>Complete los datos personales, de contacto, contraseña y asignación de rol para el control electoral.</p>
            </div>
            
            <div class="card-creation" style="padding: 2.5rem;">
                <form action="admin-usuarios.html" method="post" class="styled-form">
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
                            <input type="text" id="password" name="password" placeholder="••••••••" required style="padding: 0.85rem;">
                        </div>
                    </div>

                    <!-- Fila 4: Rol y Jornada -->
                    <div class="form-row" style="margin-bottom: 2rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="rol">Roles del sistema</label>
    <select name="rol" id="rol">
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
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="jornada">Jornada</label>
                <select name="jornada" id="jornada">
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
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1rem;">
                        <a href="admin-usuarios.php" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; padding: 0.85rem 1.5rem; width: auto; font-weight: 600;">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; width: auto;">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
document.querySelector('.styled-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const btnGuardar = this.querySelector('button[type="submit"]');
    const textoOriginal = btnGuardar.textContent;
    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';

    const payload = {
        Documento: document.getElementById('documento').value.trim(),
        Celular: document.getElementById('telefono').value.trim(),
        Nombre: document.getElementById('nombre').value.trim(),
        Apellido: document.getElementById('apellido').value.trim(),
        Email: document.getElementById('correo').value.trim(),
        Contrasena: document.getElementById('password').value,
        idRol: parseInt(document.getElementById('rol').value, 10),
        idJornada: parseInt(document.getElementById('jornada').value, 10)
    };

    try {
        const apiUrl = 'http://localhost:8080/backend-java/api/usuarios';

        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const resData = await response.json().catch(() => ({}));

        if (response.ok) {
            alert('¡Usuario creado exitosamente!');
            window.location.href = 'admin-usuarios.php';
        } else {
            alert('Error (' + response.status + '): ' + (resData.mensaje || resData.error || 'No se pudo crear el usuario'));
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
</body>
</html>