<!-- TABLA DE GESTION DE TIEMPOS -->

<!-- INFORMACION DE PERFIL DE USUARIO -->
<meta name="keywords" content="Gestion de tiempo de paga, tiempo de paga o time de paga">

<body>
    <div class="container mt-4">
        <h2 class="mb-3" style="text-align: center;">Gestion de tiempos</h2>
        <table id="tablaTiempos"
            class="table table-bordered table-borderless table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estatus</th>
                    <th>Restado</th>
                    <th>Acumulado</th>
                    <th>Total</th>
                    <th>inicio</th>
                    <th>encargado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaBody">
                <tr>
                    <td>1</td>
                    <td><button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#modalInformacionPersona">Santidemg</button></td>
                    <td><span class="badge bg-success">Corriendo</span></td>
                    <td>2h</td>
                    <td>30m</td>
                    <td>1h 30m</td>
                    <td>4h</td>
                    <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#modalInformacionPersonaEncargado">goblin</button></td>
                    <td>2025-03-08</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="accionesMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="accionesMenu">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_ascender"
                                        href="#">Iniciar tiempo</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modal_despedir_persona" href="#">Ausente</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango"
                                        href="#">Pausar</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango"
                                        href="#">Parar</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango"
                                        href="#">Completado</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalModificar"
                                        href="#">Modificar</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                        href="#">Eliminar</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODALES PARA ACCIONES -->
    <?php
    require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_eliminar.php');
    require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_informacion_encargado.php');
    require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_informacion_persona.php');
    require_once(MODAL_GESTION_TIEMPO_PATH . 'modal_tiempo_modificar.php');
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#tablaTiempos");
        });
    </script>


</body>