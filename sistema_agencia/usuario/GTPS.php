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
            <div class="charts-grid">
                <div class="chart-box">
                    <h3>Pagos Diarios</h3>
                    <div id="dailyChart" class="chart-container"></div>
                </div>
                <div class="chart-box">
                    <h3>Distribución por Usuario</h3>
                    <div id="userChart" class="chart-container"></div>
                </div>
                <div class="chart-box">
                    <h3>Total Acumulado</h3>
                    <div id="accumulatedChart" class="chart-container"></div>
                </div>
                <div class="chart-box">
                    <h3>Distribución por Motivo</h3>
                    <div id="motivoChart" class="chart-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add amCharts scripts -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
am5.ready(function() {
    const pagasData = <?php echo json_encode($pagas); ?>;

    // Process data
    const processData = () => {
        const dailyData = {};
        const userData = {};
        const motivoData = {};
        let accumulatedData = [];
        let totalAccumulated = 0;

        pagasData.forEach(paga => {
            const fecha = paga.pagas_fecha_registro.split(' ')[0];
            const monto = parseFloat(paga.pagas_recibio);

            // Daily data
            dailyData[fecha] = (dailyData[fecha] || 0) + monto;

            // User data
            userData[paga.pagas_usuario] = (userData[paga.pagas_usuario] || 0) + monto;

            // Motivo data
            motivoData[paga.pagas_motivo] = (motivoData[paga.pagas_motivo] || 0) + monto;

            // Accumulated data
            totalAccumulated += monto;
            accumulatedData.push({
                date: new Date(fecha).getTime(),
                value: totalAccumulated
            });
        });

        return {
            daily: Object.entries(dailyData).map(([date, value]) => ({
                date: new Date(date).getTime(),
                value: value
            })),
            users: Object.entries(userData).map(([name, value]) => ({
                category: name,
                value: value
            })),
            motivos: Object.entries(motivoData).map(([name, value]) => ({
                category: name,
                value: value
            })),
            accumulated: accumulatedData
        };
    };

    const data = processData();

    // Create root elements
    const dailyRoot = am5.Root.new("dailyChart");
    const userRoot = am5.Root.new("userChart");
    const accumulatedRoot = am5.Root.new("accumulatedChart");
    const motivoRoot = am5.Root.new("motivoChart");

    // Set themes
    dailyRoot.setThemes([am5themes_Animated.new(dailyRoot)]);
    userRoot.setThemes([am5themes_Animated.new(userRoot)]);
    accumulatedRoot.setThemes([am5themes_Animated.new(accumulatedRoot)]);
    motivoRoot.setThemes([am5themes_Animated.new(motivoRoot)]);

    // Daily Payments Chart (Column Chart)
    const dailyChart = dailyRoot.container.children.push(
        am5xy.XYChart.new(dailyRoot, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none"
        })
    );

    const dailyXAxis = dailyChart.xAxes.push(
        am5xy.DateAxis.new(dailyRoot, {
            maxDeviation: 0,
            baseInterval: { timeUnit: "day", count: 1 },
            renderer: am5xy.AxisRendererX.new(dailyRoot, {}),
            tooltip: am5.Tooltip.new(dailyRoot, {})
        })
    );

    const dailyYAxis = dailyChart.yAxes.push(
        am5xy.ValueAxis.new(dailyRoot, {
            renderer: am5xy.AxisRendererY.new(dailyRoot, {})
        })
    );

    const dailySeries = dailyChart.series.push(
        am5xy.ColumnSeries.new(dailyRoot, {
            name: "Pagos",
            xAxis: dailyXAxis,
            yAxis: dailyYAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(dailyRoot, {
                labelText: "{valueY} créditos"
            })
        })
    );
    dailySeries.data.setAll(data.daily);

    // User Distribution Chart (Pie Chart)
    const userChart = userRoot.container.children.push(
        am5percent.PieChart.new(userRoot, {
            radius: am5.percent(90),
            innerRadius: am5.percent(50)
        })
    );

    const userSeries = userChart.series.push(
        am5percent.PieSeries.new(userRoot, {
            name: "Users",
            valueField: "value",
            categoryField: "category",
            alignLabels: false
        })
    );
    userSeries.data.setAll(data.users);

    // Accumulated Payments Chart (Line Chart)
    const accumulatedChart = accumulatedRoot.container.children.push(
        am5xy.XYChart.new(accumulatedRoot, {
            panX: false,
            panY: false,
            wheelX: "none",
            wheelY: "none"
        })
    );

    const accumulatedXAxis = accumulatedChart.xAxes.push(
        am5xy.DateAxis.new(accumulatedRoot, {
            maxDeviation: 0,
            baseInterval: { timeUnit: "day", count: 1 },
            renderer: am5xy.AxisRendererX.new(accumulatedRoot, {}),
            tooltip: am5.Tooltip.new(accumulatedRoot, {})
        })
    );

    const accumulatedYAxis = accumulatedChart.yAxes.push(
        am5xy.ValueAxis.new(accumulatedRoot, {
            renderer: am5xy.AxisRendererY.new(accumulatedRoot, {})
        })
    );

    const accumulatedSeries = accumulatedChart.series.push(
        am5xy.LineSeries.new(accumulatedRoot, {
            name: "Total",
            xAxis: accumulatedXAxis,
            yAxis: accumulatedYAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(accumulatedRoot, {
                labelText: "{valueY} créditos"
            })
        })
    );
    accumulatedSeries.strokes.template.setAll({
        strokeWidth: 3
    });
    accumulatedSeries.data.setAll(data.accumulated);

    // Motivo Distribution Chart (Donut Chart)
    const motivoChart = motivoRoot.container.children.push(
        am5percent.PieChart.new(motivoRoot, {
            radius: am5.percent(90),
            innerRadius: am5.percent(50)
        })
    );

    const motivoSeries = motivoChart.series.push(
        am5percent.PieSeries.new(motivoRoot, {
            name: "Motivos",
            valueField: "value",
            categoryField: "category",
            alignLabels: false
        })
    );
    motivoSeries.data.setAll(data.motivos);

    // Add legends
    userChart.children.push(am5.Legend.new(userRoot, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        layout: userRoot.horizontalLayout
    }));

    motivoChart.children.push(am5.Legend.new(motivoRoot, {
        centerX: am5.percent(50),
        x: am5.percent(50),
        layout: motivoRoot.horizontalLayout
    }));

    // Animate charts
    dailySeries.appear(1000);
    userSeries.appear(1000);
    accumulatedSeries.appear(1000);
    motivoSeries.appear(1000);

    // Clean up on dispose
    dailyRoot._logo.dispose();
    userRoot._logo.dispose();
    accumulatedRoot._logo.dispose();
    motivoRoot._logo.dispose();
});
</script>

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
