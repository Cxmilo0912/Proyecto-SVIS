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
            <div class="section-header">
                <h2>Consolidado y Auditoría de Resultados</h2>
                <p>Visualización en tiempo real del conteo acumulado y porcentajes definitivos por cada opción[cite: 1].</p>
            </div>
            
            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <?php if(!$lista['ok']): ?>
                    <section class="card" style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid var(--border-card);">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p><?= h($lista['error'] ?? 'No se pudo cargar la lista') ?></p>
                        </div>
                    
                    </div>
                </section>
                <?php elseif(empty($lista['data'])): ?>
                    <section class="card" style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid var(--border-card);">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p>Aun no hay encuestas programadas</p>
                        </div>
                    
                    </div>
                </section>

                

                <?php else: ?>
                <?php foreach($lista['data']as $e): ?>
                    <?php 
                            $tituloEnc = h($e['titulo'] ?? $e['Titulo'] ?? 'Sin Título');
                            $estadoEnc = h($e['estado'] ?? $e['Estado'] ?? 'ACTIVA');
                            $opcionesEnc = $e['opciones'] ?? $e['Opciones'] ?? [];
                            
                            
                            $totalVotosEncuesta = 0;
                            if (is_array($opcionesEnc)) {
                                foreach($opcionesEnc as $op) {
                                    $totalVotosEncuesta += (int)($op['votosAcumulados'] ?? $op['VotosAcumulados'] ?? 0);
                                }
                            }
                        ?>
                <section class="card" style="background: white; border-radius: 12px; padding: 2rem; border: 1px solid var(--border-card);">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3><?= $tituloEnc ?></h3>
                            <p>Resultados oficiales auditados mediante control de concurrencia ACID.</p>
                        </div>
                        <span class="badge active"><?= $estadoEnc ?></span>
                    </div>

                    <div class="results-container" style="margin-top: 1.5rem;">
                        <div class="progress-bars" style="display: flex; flex-direction: column; gap: 1.25rem;">
                                    <?php if(is_array($opcionesEnc) && !empty($opcionesEnc)): ?>
                                        <?php foreach($opcionesEnc as $op): ?>
                                            <?php 
                                                $nombreOp = h($op['opcion'] ?? $op['Opcion'] ?? '');
                                                $votosOp = (int)($op['votosAcumulados'] ?? $op['VotosAcumulados'] ?? 0);
                                                
                                                $porcentaje = $totalVotosEncuesta > 0 ? round(($votosOp / $totalVotosEncuesta) * 100) : 0;
                                            ?>
                                            <div class="progress-item">
                                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem;">
                                                    <span style="font-weight: 600;"><?= $nombreOp ?></span>
                                                    <span style="font-weight: 700; color: #059669;"><?= $votosOp ?> votos (<?= $porcentaje ?>%)</span>
                                                </div>
                                                <div class="progress-bar" style="height: 12px; background: #e2e8f0; border-radius: 6px; overflow: hidden;">
                                                    <div class="fill" style="width: <?= $porcentaje ?>%; background: #059669; height: 100%; transition: width 0.3s ease;"></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p style="color: #64748b; font-size: 0.9rem;">No hay opciones registradas para esta encuesta.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.85rem; color: var(--text-muted);">Total sufragios procesados: <strong><?= $totalVotosEncuesta ?> votos</strong></span>
                            </div>
                        </section>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>