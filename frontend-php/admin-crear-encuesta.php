<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/ApiClient.php';
require __DIR__ . '/includes/header.php';


$titulo = 'Crear o Modificar Encuesta';
$msg = null;
$err = null;

$idEditar = isset($_GET['id']) ? (int) $_GET['id']:null;
$encuestaActual = null;

if ($idEditar) {
    $resOne = api()->get('/api/encuestas/' . $idEditar);
    if (!empty($resOne['ok']) && !empty($resOne['data']) && is_array($resOne['data'])) {
        $encuestaActual = $resOne['data'][0] ?? null;  
    }
}

$valTitulo = h($encuestaActual['Titulo'] ?? '');
$valJornada = h($encuestaActual['Jornada']  ?? '');
$valEstado = h($encuestaActual['Estado'] ?? 'ACTIVA');
$valDescripcion = h($encuestaActual['Descripcion'] ?? '');

$rawOpciones = $encuestaActual['opciones'] ?? $encuestaActual['Opciones'] ?? '';
if (is_array($rawOpciones)) {
    $valOpciones = h(implode(', ', array_map(function($o) {
        return is_array($o) ? ($o['opcion'] ?? $o['Opcion'] ?? '') : $o;
    }, $rawOpciones)));
} else {
    $valOpciones = h($rawOpciones);
}

$esEdicion = !empty($idEditar) && !empty($encuestaActual);



?>

        <section class="section-block" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header">
                <h2><?= $esEdicion ? 'Modificar Encuesta (ID: ' . $idEditar . ')' : 'Registrar Nueva Encuesta' ?></h2>
                <p>Configura los parámetros del proceso democrático, la jornada y las opciones de votación[cite: 1].</p>
            </div>
            
            <div class="card-creation" style="padding: 2.5rem;">
                <form id="formEncuesta" class="styled-form">
                    <input type="hidden" id="encuestaId" value="<?= $idEditar ?? '' ?>">
                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-2" style="margin-bottom: 0;">
                            <label for="titulo">Título de la Votación</label>
                            <input type="text" id="titulo" name="titulo" value="<?= $valTitulo ?>" placeholder="Ej. Elección Consejo Estudiantil 2026" required style="padding: 0.85rem;">
                        </div>
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="jornada">Jornada Institucional</label>
                            <select id="jornada" name="jornada" required style="padding: 0.85rem;">
                                <option value="" disabled <?= empty($valJornada) ? 'selected' : '' ?>>Seleccione...</option>                                
                                <?php
                                $resJornadas = api()->get('/api/jornadas');
                                if(!empty($resJornadas['ok']) && !empty($resJornadas['data'])){
                                    foreach($resJornadas['data'] as $j){
                                        $idJ = h($j['id'] ?? $j['Id'] ?? '');
                                        $nomJ= h($j['nombre'] ?? $j['Nombre'] ?? '');
                                        $comparador = $nomJ !== '' ? $nomJ : $idJ;
                                        $isSel = ((string)$comparador === (string)$valJornada || (string)$idJ === (string)$valJornada) ? 'selected' : '';
                                        echo '<option value="'. $idJ . '">'. $nomJ . '</option>';    
                                    }

                                }else {
                                    echo '<option value="" disabled>Error cargando jornadas</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-row" style="margin-bottom: 1.5rem;">
                        <div class="form-group flex-1" style="margin-bottom: 0;">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" required style="padding: 0.85rem;">
                                <option value="ACTIVA" <?= $valEstado === 'ACTIVA' ? 'selected' : '' ?>>Activa</option>
                                <option value="INACTIVA" <?= $valEstado === 'INACTIVA' ? 'selected' : '' ?>>Inactiva</option>
                                <option value="CERRADA" <?= $valEstado === 'CERRADA' ? 'selected' : '' ?>>Cerrada</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="descripcion">Descripción Institucional</label>
                        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Detalles de la convocatoria y normativas vigentes..." required style="padding: 0.85rem;"><?= $valDescripcion ?></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label for="opciones">Opciones de Elección</label>
                        <input type="text" id="opciones" name="opciones" value="<?= $valOpciones ?>" placeholder="Opción A, Opción B, Opción C" required style="padding: 0.85rem;">
                        <small>Separe cada opción utilizando una coma. El contador se incrementará numéricamente para preservar el secreto absoluto del voto.</small>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1rem;">
                        <a href="admin-encuestas.php" class="btn" style="background: #e2e8f0; color: #0f172a; text-decoration: none; text-align: center; padding: 0.85rem 1.5rem; width: auto; font-weight: 600;">Cancelar</a>
                        <button type="submit" class="btn btn-primary" style="padding: 0.85rem 2rem; width: auto;"><?= $esEdicion ? 'Actualizar Encuesta' : 'Guardar Encuesta' ?></button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>
document.getElementById('formEncuesta').addEventListener('submit', async function(e) {
    e.preventDefault();

    const idEdit = document.getElementById('encuestaId').value;
    const esEdicion = idEdit !== '';

    const payload = {
        Titulo: document.getElementById('titulo').value.trim(),
        Descripcion: document.getElementById('descripcion').value.trim(),
        IdJornada: parseInt(document.getElementById('jornada').value, 10),
        Estado: document.getElementById('estado').value,
        Opciones: document.getElementById('opciones').value.trim()
    };

    if (esEdicion) {
        payload.Id = parseInt(idEdit, 10);
    }

    try {
        const apiUrl = 'http://localhost:8080/backend-java/api/encuestas'; 
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
            alert(esEdicion ? '¡Encuesta actualizada exitosamente!' : '¡Encuesta creada y habilitada exitosamente!');
            window.location.href = 'admin-encuestas.php';
        } else {
            alert('Error (' + response.status + '): ' + (resData.mensaje || resData.error || 'No se pudo guardar la encuesta'));
        }
    } catch (err) {
        console.error('Error de red:', err);
        alert('Ocurrió un error al conectar con el servidor Java (Tomcat).');
    }
});
</script>
</body>
</html>