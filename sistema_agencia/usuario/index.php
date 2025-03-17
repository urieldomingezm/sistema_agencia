<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_admin.php');

// Add session check here
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '/login.php';</script>";
    exit;
}
?>

<body>
    <div class="page-container">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <?php
                    if (isset($_GET['q']) && !empty($_GET['q'])) {
                        $query = strtolower(trim($_GET['q']));
                        $pages = [
                            'index.php' => 'Inicio',
                            'GSTM.php' => 'Gestion de tiempo',
                            'USR.php' => 'inicio',
                            'PRUS.php' => 'perfil de usuario',
                            'CRSS.php' => 'cerrar_session',
                            'RQPG.php' => 'Requisitos de paga',
                            'GSAS.php' => 'gestion de ascensos',
                            'GVE.php' => 'Pendiente',
                            'GVP.php' => 'Pendiente',
                            'MEMS.php' => 'membresias',
                            'GTPS.php' => 'grafico total paga',
                            'GEPS.php' => 'grafico de pagas',
                            'VTM.php' => 'Venta de membresias',
                            'VTR.php' => 'venta de rangos',
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

                        echo '<div class="search-results-container">';
                        echo '<div class="card shadow-lg border-0 rounded-lg">';
                        echo '<div class="card-header bg-gradient-primary">';
                        echo '<h4 class="text-dark mb-0"><i class="fas fa-search me-2"></i>Resultados para: "' . htmlspecialchars($query) . '"</h4>';
                        echo '</div>';
                        echo '<div class="card-body">';

                        if (!empty($results)) {
                            echo '<div class="results-list">';
                            foreach ($results as $result) {
                                echo '<a href="' . $result['url'] . '" class="result-item">';
                                echo '<div class="d-flex align-items-center p-3 border-bottom transition-hover">';
                                echo '<i class="fas fa-link me-3 text-primary"></i>';
                                echo '<div>';
                                echo '<h5 class="mb-0">' . ucfirst($result['title']) . '</h5>';
                                echo '</div>';
                                echo '<i class="fas fa-chevron-right ms-auto text-muted"></i>';
                                echo '</div>';
                                echo '</a>';
                            }
                            echo '</div>';
                        } else {
                            echo '<div class="text-center p-4">';
                            echo '<i class="fas fa-search-minus fa-3x text-muted mb-3"></i>';
                            echo '<div class="alert alert-warning mb-0">';
                            echo '<h5 class="alert-heading">No se encontraron resultados</h5>';
                            echo '<p class="mb-0">Intenta con otros términos de búsqueda</p>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div></div></div>';
                    } else {
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            $validPages = [
                                'Gestion de tiempo' => 'GSTM.php',
                                'inicio' => 'USR.php',
                                'perfil de usuario' => 'PRUS.php',
                                'cerrar_session' => 'CRSS.php',
                                'Requisitos de paga' => 'RQPG.php',
                                'gestion de ascensos' => 'GSAS.php',
                                'grafico total paga' => 'GTPS.php',
                                'grafico de pagas' => 'GEPS.php',
                                'venta de membresias' => 'VTM.php',
                                'venta de rangos' => 'VTR.php'
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
    </div>

    <style>
        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .page-container {
            min-height: calc(100vh - 400px);
            padding: 2rem 0;
        }

        .search-results-container {
            animation: fadeIn 0.3s ease-in-out;
        }

        body {
            background-color: #F3F0FF;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%);
            padding: 1.5rem;
        }

        .result-item {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .result-item:hover {
            background-color: rgba(0, 123, 255, 0.05);
            color: inherit;
        }

        .transition-hover {
            transition: all 0.3s ease;
        }

        .transition-hover:hover {
            transform: translateX(5px);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header h4 {
            font-weight: 600;
        }

        .results-list {
            border-radius: 10px;
            overflow: hidden;
        }

        .border-bottom {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .border-bottom:last-child {
            border-bottom: none !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 1rem 0;
            }
        }
    </style>

</body>

<?php require_once(TEMPLATES_PATH . 'footer.php'); ?>