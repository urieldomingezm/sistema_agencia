<!-- grafico total paga -->

<?php
require_once(CONFIG_PATH . 'bd.php');
$db = new Database();
$conn = $db->getConnection();

// Obtener datos de la tabla pagas
$query = "SELECT pagas_usuario, pagas_recibio, pagas_motivo, pagas_completo, pagas_descripcion, pagas_fecha_registro FROM gestion_pagas ORDER BY pagas_fecha_registro DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$pagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body class="p-6 bg-gray-100">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Dashboard de Pagas</h1>
        
        <!-- Tabla de Pagas -->
        <div class="overflow-x-auto">
            <table id="pagasTable" class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Usuario</th>
                        <th class="border px-4 py-2">Recibió</th>
                        <th class="border px-4 py-2">Motivo</th>
                        <th class="border px-4 py-2">Completo</th>
                        <th class="border px-4 py-2">Descripción</th>
                        <th class="border px-4 py-2">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagas as $paga): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_usuario']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_recibio']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_motivo']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_completo']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_descripcion']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($paga['pagas_fecha_registro']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Gráfico de Pagas Recibidas -->
        <div class="mt-6">
            <canvas id="pagasChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#pagasTable");
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
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
