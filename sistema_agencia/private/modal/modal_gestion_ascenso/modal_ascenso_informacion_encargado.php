<!-- Modal Información Persona encargado -->
<div class="modal fade" id="modalInformacionPersonaEncargado" aria-labelledby="modalInformacionPersonaEncargadoLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-success text-white border-0">
                <h5 class="modal-title" id="modalInformacionPersonaEncargadoLabel">
                    <i class="fas fa-user-shield me-2"></i>Información del Encargado
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <!-- Columna Derecha - Imagen y Estado -->
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <div class="avatar-container position-relative">
                            <img src="https://www.habbo.es/habbo-imaging/avatarimage?user=goblinslayer88&amp;action=none&amp;direction=2&amp;head_direction=2&amp;gesture=&amp;size=sl&amp;headonly=2"
                                 class="img-fluid rounded-circle border border-3 border-success shadow-sm"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-2 border-white rounded-circle">
                                <span class="visually-hidden">Online</span>
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                <i class="fas fa-circle me-1 small"></i>En línea
                            </span>
                        </div>
                    </div>

                    <!-- Columna Izquierda - Información -->
                    <div class="col-md-8">
                        <div class="info-container">
                            <div class="info-item mb-3">
                                <label class="text-muted small mb-1">Nombre</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    <span class="fw-bold">Goblinslayer88</span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <label class="text-muted small mb-1">Rango</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-2"></i>
                                    <span class="fw-bold">Dueño</span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <label class="text-muted small mb-1">Misión Anterior</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-history text-info me-2"></i>
                                    <span class="fw-bold">ATN- Supervisor A -XDD -SDS</span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <label class="text-muted small mb-1">Misión Nueva</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-arrow-right text-success me-2"></i>
                                    <span class="fw-bold">ATN- Supervisor B -XDD -SDS</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <label class="text-muted small mb-1">Firma</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-signature text-secondary me-2"></i>
                                    <span class="fw-bold">XDD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #20c997);
}

.avatar-container img {
    transition: transform 0.3s ease;
}

.avatar-container img:hover {
    transform: scale(1.05);
}

.info-container {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
}

.info-item {
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 8px;
}

.info-item:hover {
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.modal-content {
    border-radius: 15px;
}

.modal-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}
</style>