<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');

require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_bajos.php');

//

require_once(POO_HOME_PATH . 'body_home.php');

// 

require_once(TEMPLATES_PATH . 'footer.php');
?>