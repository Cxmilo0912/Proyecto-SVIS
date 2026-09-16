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
                <p>Dispara la creación masiva de tokens únicos (uno por cada aprendiz registrado) vinculados a la encuesta.</p>
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
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05); margin-top: 1.5rem;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
        <thead>
            <tr style="background-color: #f0fdf4; border-bottom: 2px solid #bbf7d0; color: #065f46;">
                <th style="padding: 1rem; font-weight: 600;">Encuesta / ID</th>
                <th style="padding: 1rem; font-weight: 600; text-align: center;">Total Asignados</th>
                <th style="padding: 1rem; font-weight: 600; text-align: center;">Disponibles</th>
                <th style="padding: 1rem; font-weight: 600; text-align: center;">Usados</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $resLotes = api()->get('/api/tokens'); 

            if (!empty($resLotes['ok']) && !empty($resLotes['data'])) {
                foreach ($resLotes['data'] as $lote) {
                    // Soportamos tanto mayúsculas como minúsculas por seguridad del JSON
                    $idEncuesta = $lote['IdEncuesta'] ?? $lote['idEncuesta'] ?? '';
                    $tituloEncuesta = $lote['TituloEncuesta'] ?? $lote['Encuesta'] ?? '';
                    $total = $lote['TotalAsignados'] ?? $lote['totalAsignados'] ?? 0;
                    $disponibles = $lote['Disponibles'] ?? $lote['disponibles'] ?? 0;
                    $usados = $lote['Usados'] ?? $lote['usados'] ?? 0;

                    echo '<tr style="border-bottom: 1px solid #f1f5f9;">';
                    echo '<td style="padding: 1rem; color: #1e293b; font-weight: 500;">' . h($idEncuesta) . ' - <span style="color: #64748b;">' . h($tituloEncuesta) . '</span></td>';
                    echo '<td style="padding: 1rem; text-align: center; color: #0f172a; font-weight: 600;">' . h($total) . '</td>';
                    
                    // Badge verde para disponibles
                    echo '<td style="padding: 1rem; text-align: center;"><span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.6rem; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">' . h($disponibles) . '</span></td>';
                    
                    // Badge rojo/suave para usados
                    echo '<td style="padding: 1rem; text-align: center;"><span style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.6rem; border-radius: 9999px; font-weight: 600; font-size: 0.85rem;">' . h($usados) . '</span></td>';
                    
                    echo '</tr>';
                }
            } else {
                // Corregido el colspan a 4 para que cuadre exacto con las columnas
                echo '<tr><td colspan="4" style="padding: 2rem; text-align: center; color: #64748b; font-style: italic;">No hay lotes de tokens generados todavía.</td></tr>';
            }
            ?>
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