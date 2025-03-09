<?php
// Incluir el archivo de configuración
require_once(__DIR__ . '/config.php');

// Definir la ruta raíz del proyecto (relativa al contenedor Docker)


require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_normal.php');

require_once(BODY_HOME_PATH . 'home_inicio.php');

require_once(TEMPLATES_PATH . 'footer.php');
?>