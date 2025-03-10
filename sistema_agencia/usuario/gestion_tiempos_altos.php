<?php 
require_once(__DIR__ . '/config.php');
require_once(MODAL_GESTION_TIME_ALTOS_PATH . 'modal_acciones.php');?>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Gestión de tiempos</h2>
        <table id="tablaTiempos" class="table table-bordered table-borderless table-dark table-responsive-lg table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Restado</th>
                    <th>Acumulado</th>
                    <th>Total</th>
                    <th>Transcurrido</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Santidemg</td>
                    <td><span class="badge bg-success">Corriendo</span></td>
                    <td>2h</td>
                    <td>30m</td>
                    <td>1h 30m</td>
                    <td>4h</td>
                    <td>2025-03-08</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalAcciones">
                            Detalles
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Santidemg</td>
                    <td><span class="badge bg-warning text-dark">Ausente</span></td>
                    <td>3h</td>
                    <td>1h</td>
                    <td>2h</td>
                    <td>5h</td>
                    <td>2025-03-07</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalAcciones">
                            Detalles
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Carlos Gómez</td>
                    <td><span class="badge bg-secondary">Pausado</span></td>
                    <td>1h</td>
                    <td>45m</td>
                    <td>2h 15m</td>
                    <td>3h 30m</td>
                    <td>2025-03-06</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalAcciones">
                            Detalles
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ana Ramírez</td>
                    <td><span class="badge bg-danger">Parado</span></td>
                    <td>4h</td>
                    <td>2h</td>
                    <td>6h</td>
                    <td>7h</td>
                    <td>2025-03-05</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalAcciones">
                            Detalles
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Luis Fernández</td>
                    <td><span class="badge bg-purple">Completado</span></td>
                    <td>5h</td>
                    <td>3h</td>
                    <td>8h</td>
                    <td>10h</td>
                    <td>2025-03-04</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalAcciones">
                            Detalles
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new simpleDatatables.DataTable("#tablaTiempos");
        });
    </script>

    <style>
        .btn-morado, .bg-purple {
            background-color: #6f42c1;
            color: white;
        }
    </style>
</body>