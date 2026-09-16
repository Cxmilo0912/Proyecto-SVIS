<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';

$titulo = 'Crear Encuesta';
$msg = null;
$err = null;


require __DIR__ . '/includes/header.php';



?>
        <section class="section-block">
            <div class="section-header">
                <h2>Generación y Control del Padrón OTP</h2>
                <p>Dispara la creación masiva de tokens únicos (uno por cada aprendiz registrado) vinculados a la encuesta[cite: 1].</p>
            </div>
            
            <div class="card-creation">
                <form action="#" method="post" class="styled-form">
                    <div class="form-row">
                        <div class="form-group flex-2">
                            <label for="encuesta">Encuestas</label>
                <select name="encuesta" id="encuesta">
                    <option value="" disabled>Seleccione...</option>
                    <?php
                        $resEncuesta = api()->get('/api/encuestas');
                        if (!empty($resEncuesta['ok']) && !empty($resEncuesta['data'])) {
                            foreach ($resEncuesta['data'] as $e) {
                                $idEncuesta = h($e['id'] ?? $e['Id'] ?? '');
                                $idJornada  = h($e['idJornada'] ?? $e['IdJornada'] ?? ''); // Extraemos el ID de la jornada
                                $titulo     = h($e['titulo'] ?? $e['Titulo'] ?? '');
                                echo '<option value="' . $idEncuesta . '" data-jornada="' . $idJornada . '">' . $titulo . '</option>';                            }
                        } else {
                            echo '<option value="" disabled>Error cargando jornadas</option>';
                        }
                    ?>
                </select>
                        </div>
                        <div class="form-group flex-1">
                            <label for="ttl_horas">Tiempo de Expiración (TTL)</label>
                            <input type="number" id="diasVigencia" name="ttl_horas" value="7" required>
                            <small>Dias de vigencia para los códigos OTP.</small>
                        </div>
                    </div>
                    <div class="info-box">
                        <p>⚠️ Regla de Integridad: La base de datos aplicará una restricción <code>UNIQUE (encuesta_id, usuario_id)</code> para rechazar credenciales duplicadas[cite: 1].</p>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Disparar Generación Masiva de Tokens</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Tabla de Estado de Tokens -->
        <section class="card full-width" style="background: white; border-radius: 12px; padding: 1.75rem; border: 1px solid var(--border-card);">
            <div class="card-header">
                <h3>Estado Actual del Padrón</h3>
                <p>Monitoreo de tokens disponibles frente a tokens consumidos ("quema atómica").</p>
            </div>
            <div style="overflow-x: auto; margin-top: 1rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e2e8f0; color: #064e3b;">
                            <th style="padding: 0.75rem;">ID Encuesta</th>
                            <th style="padding: 0.75rem;">Total Asignados</th>
                            <th style="padding: 0.75rem;">Disponibles</th>
                            <th style="padding: 0.75rem;">Usados (Qu,ados)</th>
                            <th style="padding: 0.75rem;">Estado Lote</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 0.75rem;">1 - Consejo Estudiantil 2026</td>
                            <td style="padding: 0.75rem;">350</td>
                            <td style="padding: 0.75rem;">205</td>
                            <td style="padding: 0.75rem;">145</td>
                            <td style="padding: 0.75rem;"><span class="badge active">ACTIVO</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

       <script>
document.querySelector('.styled-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const btnGuardar = this.querySelector('button[type="submit"]');
    const textoOriginal = btnGuardar.textContent;
    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Generando...';

    const selectEncuesta = document.getElementById('encuesta');
    const optionSeleccionada = selectEncuesta.options[selectEncuesta.selectedIndex];
    const payload = {
        idEncuesta: parseInt(selectEncuesta.value, 10),
        idJornada: parseInt(optionSeleccionada.getAttribute('data-jornada'), 10),
        numeroDias: parseInt(document.getElementById('diasVigencia').value, 10)

    };

    try {
        const apiUrl = 'http://localhost:8080/backend-java/api/tokens';

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
            alert('¡Padron generado exitosamente!');
            window.location.href = 'admin-tokens.php';
        } else {
            alert('Error (' + response.status + '): ' + (resData.mensaje || resData.error || 'No se pudo generar el padron'));
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