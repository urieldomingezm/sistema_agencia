<?php

if (isset($_GET['q'])) {
    $query = strtolower($_GET['q']); // Convertir a minúsculas para evitar problemas de mayúsculas
    $pages = [
        'index.php' => 'home',
        'GSAS.php' => 'informacion'
    ];

    $results = [];

    foreach ($pages as $file => $title) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            preg_match('/<meta name="keywords" content="([^"]+)"/', $content, $matches);

            if (!empty($matches[1])) {
                $keywords = explode(',', strtolower($matches[1]));
                if (in_array($query, $keywords)) {
                    $results[] = ['title' => $title, 'url' => $file];
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
}
