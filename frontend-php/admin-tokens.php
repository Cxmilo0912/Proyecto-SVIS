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
                <form action="#" method="POST" class="styled-form">
                    <div class="form-row">
                        <div class="form-group flex-2">
                            <label for="encuesta_select">Seleccionar Encuesta Destino</label>
                            <select id="encuesta_select" name="encuesta_id" required>
                                <option value="1">Elección Consejo Estudiantil 2026</option>
                                <option value="2">Consulta Representante Jornada Nocturna</option>
                            </select>
                        </div>
                        <div class="form-group flex-1">
                            <label for="ttl_horas">Tiempo de Expiración (TTL)</label>
                            <input type="number" id="ttl_horas" name="ttl_horas" value="24" required>
                            <small>Horas de vigencia para los códigos OTP.</small>
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
</body>
</html>