<?php
require_once(CONFIG_PATH . 'bd.php');
$db = new Database();
$conn = $db->getConnection();

$query = "SELECT pagas_usuario, pagas_recibio, pagas_motivo, pagas_completo, pagas_descripcion, pagas_fecha_registro FROM gestion_pagas ORDER BY pagas_fecha_registro DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$pagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>
            <i class="fas fa-chart-line"></i>
            Dashboard de Pagas
        </h1>
    </div>

    <div class="dashboard-grid">
        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Usuarios</h3>
                    <p><?php echo count(array_unique(array_column($pagas, 'pagas_usuario'))); ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pagado</h3>
                    <p><?php echo array_sum(array_column($pagas, 'pagas_recibio')); ?> créditos</p>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="table-header">
                <h2><i class="fas fa-table"></i> Registro de Pagas</h2>
            </div>
            <div class="table-container">
                <table id="pagasTable" class="display-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Recibió</th>
                            <th>Motivo</th>
                            <th>Completo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagas as $paga): ?>
                            <tr>
                                <td><i class="fas fa-user"></i> <?php echo htmlspecialchars($paga['pagas_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($paga['pagas_recibio']); ?> c</td>
                                <td><?php echo htmlspecialchars($paga['pagas_motivo']); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $paga['pagas_completo'] ? 'complete' : 'incomplete'; ?>">
                                        <?php echo $paga['pagas_completo'] ? 'Completo' : 'Pendiente'; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($paga['pagas_descripcion']); ?></td>
                                <td><?php echo htmlspecialchars($paga['pagas_fecha_registro']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-section">
            <div class="chart-header">
                <h2><i class="fas fa-chart-bar"></i> Análisis de Pagas</h2>
            </div>
            <div class="chart-container">
                <canvas id="pagasChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.dashboard-header {
    margin-bottom: 2rem;
    text-align: center;
}

.dashboard-header h1 {
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 600;
}

.dashboard-grid {
    display: grid;
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%);
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-info h3 {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
}

.stat-info p {
    color: #2c3e50;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

.table-section, .chart-section {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.table-header, .chart-header {
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 1rem;
}

.table-header h2, .chart-header h2 {
    color: #2c3e50;
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.display-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.display-table th {
    background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%);
    color: white;
    padding: 1rem;
    font-weight: 500;
}

.display-table td {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-badge.complete {
    background: #d4edda;
    color: #155724;
}

.status-badge.incomplete {
    background: #f8d7da;
    color: #721c24;
}

.chart-container {
    height: 400px;
    position: relative;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .stats-container {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const table = new simpleDatatables.DataTable("#pagasTable", {
        searchable: true,
        fixedHeight: true,
        perPage: 10
    });

    const ctx = document.getElementById('pagasChart').getContext('2d');
    const pagasData = <?php echo json_encode($pagas); ?>;
    
    const usuarios = pagasData.map(paga => paga.pagas_usuario);
    const cantidades = pagasData.map(paga => paga.pagas_recibio);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: usuarios,
            datasets: [{
                label: 'Pagas Recibidas',
                data: cantidades,
                backgroundColor: 'rgba(0, 198, 251, 0.5)',
                borderColor: 'rgba(0, 91, 234, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribución de Pagas por Usuario'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>
