<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_admin.php');
?>

<body class="bg-light">
    <br>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- <h2 class="text-center text-primary mb-4">Buscar en el sistema</h2> -->

                <?php
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                    $query = strtolower(trim($_GET['q']));
                    $pages = [
                        'index.php' => 'Inicio',
                        'GSTM.php' => 'Gestión de tiempo y pagos',
                        'USR.php' => 'Inicio Usuario',
                        'PRUS.php' => 'perfil de usuario',
                        'CRSS.php' => 'Cerrar sesión',
                        'RQPG.php' => 'Requisitos de paga, ascensos, traslados, etc.',
                        'GSAS.php' => 'Gestión de ascensos',
                        'GVE.php' => 'Pendiente',
                        'GVP.php' => 'Pendiente'
                    ];

                    $results = [];

                    foreach ($pages as $file => $title) {
                        if (file_exists($file)) {
                            $content = file_get_contents($file);
                            preg_match('/<meta name="keywords" content="([^"]+)"/', $content, $matches);

                            if (!empty($matches[1])) {
                                $keywords = explode(',', strtolower($matches[1]));
                                foreach ($keywords as $keyword) {
                                    similar_text($query, $keyword, $percentage);
                                    if ($percentage > 60 || strpos($keyword, $query) !== false) {
                                        $results[] = ['title' => $title, 'url' => 'index.php?page=' . urlencode($title)];
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    echo '<div class="card shadow p-3">';
                    echo '<h4 class="text-center">Resultados de búsqueda para: "<strong>' . htmlspecialchars($query) . '</strong>"</h4>';

                    if (!empty($results)) {
                        echo '<ul class="list-group mt-3">';
                        foreach ($results as $result) {
                            echo '<li class="list-group-item"><a href="' . $result['url'] . '" class="text-decoration-none">' . ucfirst($result['title']) . '</a></li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<div class="alert alert-warning mt-3 text-center">No se encontraron resultados.</div>';
                    }
                    echo '</div>';
                } else {
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $validPages = [
                            'Gestion de tiempo' => 'GSTM.php',
                            'inicio' => 'USR.php',
                            'perfil de usuario' => 'PRUS.php',
                            'cerrar_session_usuario' => 'CRSS.php',
                            'Requisitos de paga' => 'RQPG.php',
                            'gestion de ascensos' => 'GSAS.php',
                            'GVE' => 'GVE.php',
                            'GVP' => 'GVP.php'
                        ];

                        if (array_key_exists($page, $validPages)) {
                            include $validPages[$page];
                        } else {
                            echo '<div class="alert alert-danger text-center"><h4>Página no encontrada</h4>';
                            echo '<p>Redirigiendo a la página principal...</p></div>';
                            echo '<meta http-equiv="refresh" content="3;url=index.php">';
                            exit();
                        }
                    } else {
                        include 'USR.php';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <br>

</body>


<?php require_once(TEMPLATES_PATH . 'footer.php'); ?>