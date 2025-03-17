<div class="modal fade" id="modal_ascender" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header bg-gradient-success border-0">
                <h5 class="modal-title text-white">
                    <i class="fas fa-arrow-up me-2"></i>Registrar ascenso
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="promotion-indicator text-center mb-4">
                    <div class="rank-change">
                        <i class="fas fa-user-circle current-rank"></i>
                        <i class="fas fa-arrow-up arrow-up"></i>
                        <i class="fas fa-user-circle new-rank"></i>
                    </div>
                </div>

                <form id="promotionForm">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user text-success me-2"></i>Usuario
                                </label>
                                <input type="text" class="form-control" name="ascenso_usuario">
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-history text-success me-2"></i>Misión Anterior
                                </label>
                                <input class="form-control" id="mision-anterior">
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-tasks text-success me-2"></i>Misión Nueva
                                </label>
                                <input class="form-control" name="ascenso_mision_nueva" required>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-signature text-success me-2"></i>Firma
                                </label>
                                <input class="form-control" name="ascenso_firma" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-star text-success me-2"></i>Nuevo Rango
                                </label>
                                <select class="form-select" name="ascenso_rango" required>
                                    <option value="" disabled selected>Seleccionar rango...</option>
                                    <option value="Agente">Agente</option>
                                    <option value="Seguridad">Seguridad</option>
                                    <option value="Tecnico">Técnico</option>
                                    <option value="Logistica">Logística</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Director">Director</option>
                                    <option value="Presidente">Presidente</option>
                                    <option value="Operativo">Operativo</option>
                                    <option value="Junta directiva">Junta directiva</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-info-circle text-success me-2"></i>Estado
                                </label>
                                <input class="form-control" name="ascenso_status" required>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-user-shield text-success me-2"></i>Encargado
                                </label>
                                <input class="form-control" name="ascenso_encargado_usuario" 
                                       value="<?php echo htmlspecialchars($_SESSION['username']); ?>" 
                                       readonly required>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label">
                                    <i class="fas fa-clock text-success me-2"></i>Tiempo de Espera
                                </label>
                                <select class="form-select" name="ascenso_hora_proxima" required>
                                    <option value="" disabled selected>Seleccionar tiempo...</option>
                                    <option value="00:30:00">30 minutos</option>
                                    <option value="02:00:00">2 horas</option>
                                    <option value="24:00:00">1 día</option>
                                    <option value="48:00:00">2 días</option>
                                    <option value="72:00:00">3 días</option>
                                    <option value="120:00:00">5 días</option>
                                    <option value="168:00:00">1 semana</option>
                                    <option value="240:00:00">10 días</option>
                                    <option value="360:00:00">15 días</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-success" form="promotionForm">
                    <i class="fas fa-arrow-up me-2"></i>Confirmar Promoción
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #169b6b);
}

.modal-content {
    border-radius: 15px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.promotion-indicator {
    padding: 1rem;
    background: #f8f9fc;
    border-radius: 10px;
}

.rank-change {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    font-size: 2rem;
}

.current-rank {
    color: #858796;
}

.arrow-up {
    color: #1cc88a;
    font-size: 1.5rem;
    animation: bounce 1s infinite;
}

.new-rank {
    color: #4e73df;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.form-control, .form-select {
    border: 1px solid #e3e6f0;
    padding: 0.75rem;
    font-size: 0.9rem;
}

.form-control:focus, .form-select:focus {
    border-color: #1cc88a;
    box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25);
}

.form-label {
    font-weight: 500;
    color: #5a5c69;
}

.btn-success {
    background: linear-gradient(45deg, #1cc88a, #169b6b);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(45deg, #169b6b, #147d55);
}
</style>