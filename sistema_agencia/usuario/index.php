<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_admin.php');

echo '<br><br><br>';

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $query = strtolower(trim($_GET['q']));
    $pages = [
        'index.php' => 'Inicio',
        'GSTM.php' => 'Gestion de tiempo u time de paga',
        'USR.php' => 'Inicio Usuario',
        'PRUS.php' => 'perfil de usuario',
        'CRSS.php' => 'Cerrar sesión',
        'RQPG.php' => 'Requisitos de paga, ascensos, traslados ect',
        'GSAS.php' => 'Gestion de ascensos',
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

    echo '<h2>Resultados de búsqueda para: "' . htmlspecialchars($query) . '"</h2>';
    if (!empty($results)) {
        echo '<ul>';
        foreach ($results as $result) {
            echo '<li><a href="' . $result['url'] . '">' . ucfirst($result['title']) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No se encontraron resultados.</p>';
    }
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
            echo "<h1>Página no encontrada</h1>";
            echo "<p>Redirigiendo a la página principal...</p>";
            echo '<meta http-equiv="refresh" content="3;url=index.php">';
            exit();
        }
    } else {
        include 'USR.php';
    }
}
?>

<?php require_once(TEMPLATES_PATH . 'footer.php'); ?>
