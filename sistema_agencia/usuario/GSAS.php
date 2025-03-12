<!-- INFORMACION DE PERFIL DE USUARIO -->
<meta name="keywords" content="Gestion de tiempo de ascenso, tiempo de ascenso y ascensos">

<!-- GESTIO DE ASCENSO -->

<body>
    <div class="container mt-4">
        <h2 class="mb-3" style="text-align: center;">Gestion de ascensos</h2>
        <table id="tabla_ascenso" class="table table-bordered table-dark table-borderless table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Status</th>
                    <th>Motivo</th>
                    <th>Encargado</th>
                    <th>Proximo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#modalInformacionPersona">Santidemg</button></td>
                    <td>Proceso</td>
                    <td>Despedido</td>
                    <td><button class="btn btn-primary text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#modalInformacionPersonaEncargado">goblin</button></td>
                    <td>01:00:00</td>
                    <td>03/08/2024 9:17 pm</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="accionesMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="accionesMenu">
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_ascender"
                                        href="#">Ascender</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#modal_despedir_persona" href="#">Despedir</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_bajar_rango"
                                        href="#">Bajar rango</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- MODALES -->
    <?php
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_ascender.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_baja.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_despedir.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_informacion_encargado.php');
    require_once(MODAL_GESTION_ASCENSO_PATH . 'modal_ascenso_informacion_persona.php');
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new simpleDatatables.DataTable("#tabla_ascenso");
        });
    </script>

</body>