<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/sistema_agencia/config.php');

require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_normal.php');

require_once(BODY_HOME_PATH . 'home_inicio.php');

require_once(TEMPLATES_PATH . 'footer.php');
?>