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
                        // Funcion de buscar
                        $pages = [
                            'GSTM.php' => 'gestion_de_tiempo',
                            'USR.php' => 'inicio',
                            'PRUS.php' => 'ver_perfil',
                            'CRSS.php' => 'cerrar_session',
                            'RQPG.php' => 'Requisitos_paga',
                            'GSAS.php' => 'gestion_ascenso',
                            'GVE.php' => 'Pendiente',
                            'GVP.php' => 'Pendiente',
                            'MEMS.php' => 'membresias',
                            'GTPS.php' => 'gestion_de_pagas',
                            'GEPS.php' => 'grafico de pagas',
                            'VTM.php' => 'ventas_membresias',
                            'VTR.php' => 'venta_rangos',
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
                            echo '<br>';
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
                                'gestion_de_tiempo' => ['file' => 'GSTM.php', 'roles' => ['Supervisor', 'Director', 'Presidente', 'Junta directiva']],
                                'inicio' => ['file' => 'USR.php', 'roles' => ['Agente', 'Seguridad', 'Tecnico', 'Logistica', 'Supervisor', 'Director', 'Presidente', 'Operativo', 'Junta directiva']],
                                'ver_perfil' => ['file' => 'PRUS.php', 'roles' => ['Agente', 'Seguridad', 'Tecnico', 'Logistica', 'Supervisor', 'Director', 'Presidente', 'Operativo', 'Junta directiva']],
                                'cerrar_session' => ['file' => 'CRSS.php', 'roles' => ['Agente', 'Seguridad', 'Tecnico', 'Logistica', 'Supervisor', 'Director', 'Presidente', 'Operativo', 'Junta directiva']],
                                'Requisitos_paga' => ['file' => 'RQPG.php', 'roles' => ['Supervisor', 'Director', 'Presidente', 'Junta directiva']],
                                'gestion_ascenso' => ['file' => 'GSAS.php', 'roles' => ['Director', 'Presidente', 'Junta directiva']],
                                'gestion_de_pagas' => ['file' => 'GTPS.php', 'roles' => ['Director', 'Presidente', 'Junta directiva']],
                                'grafico de pagas' => ['file' => 'GEPS.php', 'roles' => ['Director', 'Presidente', 'Junta directiva']],
                                'ventas_membresias' => ['file' => 'VTM.php', 'roles' => ['Supervisor', 'Director', 'Presidente', 'Junta directiva']],
                                'venta_rangos' => ['file' => 'VTR.php', 'roles' => ['Director', 'Presidente', 'Junta directiva']]
                            ];

                            // Al inicio del archivo, después de las verificaciones de sesión
                            // Verificación de rango usando la clase Database
                            $userRango = '';
                            if (isset($_SESSION['user_id'])) {
                                require_once(CONFIG_PATH . 'bd.php');
                                $database = new Database();
                                $conn = $database->getConnection();
                                
                                try {
                                    $query = "SELECT rango FROM registro_usuario WHERE id = :user_id";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bindParam(':user_id', $_SESSION['user_id']);
                                    $stmt->execute();
                                    
                                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $userRango = $row['rango'];
                                        $_SESSION['rango'] = $userRango;
                                    }
                                } catch(PDOException $e) {
                                    error_log("Error en la consulta: " . $e->getMessage());
                                    echo '<div class="alert alert-danger">Error al verificar permisos</div>';
                                    exit();
                                }
                            }

                            // Resto del código de validación
                            if (array_key_exists($page, $validPages) && in_array($userRango, $validPages[$page]['roles'])) {
                                include $validPages[$page]['file'];
                            } else {
                                echo '<div class="alert alert-danger text-center mt-5">';
                                echo '<h4 class="alert-heading">Acceso Denegado</h4>';
                                echo '<p>No tienes los permisos necesarios para acceder a esta página.</p>';
                                echo '<p>Tu rango actual es: ' . htmlspecialchars($userRango) . '</p>';
                                echo '<p>Redirigiendo a la página principal...</p>';
                                echo '</div>';
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
            padding: 4rem 0; /* Aumentado el padding vertical */
        }

        .search-results-container {
            animation: fadeIn 0.3s ease-in-out;
            margin-top: 80px; /* Añadido margen superior */
        }

        .card-header {
            padding: 1.5rem !important;
        }

        .card-body {
            padding: 2rem !important;
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