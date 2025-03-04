<?php
// Definir la ruta raíz del proyecto
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/sistema_agencia/');

// Rutas a carpetas privadas
define('PRIVATE_PATH', ROOT_PATH.'private/');
define('TEMPLATES_PATH', PRIVATE_PATH.'plantilla/'); 
define('CONFIG_PATH', PRIVATE_PATH.'config/'); 

// Checar si funciona carpeta de POO
define('POO_PATH', PRIVATE_PATH.'poo/login/'); 
define('MODELOS_PATH', PRIVATE_PATH.'modelos/login'); 
define('POO_HOME_PATH', PRIVATE_PATH.'modelos/home'); 

define('MENU_PATH', CONFIG_PATH.'menus/');
define('PROCESOS_PATH', CONFIG_PATH.'procesos/');    
define('UPLOADS_PATH', PRIVATE_PATH.'uploads/');      
define('SCRIPTS_PATH', PRIVATE_PATH.'scripts/');     
define('SUBSCRIPTIONS_PATH', PRIVATE_PATH.'subscriptions/');      
define('MODAL_PATH', PRIVATE_PATH.'modals/');   

// Rutas a carpetas públicas
define('PUBLIC_PATH', ROOT_PATH.'public/');
define('CSS_PATH', PUBLIC_PATH.'css/');
define('JS_PATH', PUBLIC_PATH.'js/');
define('IMG_PATH', PUBLIC_PATH.'img/');

// Rutas a carpetas de clientes
define('USUARIO_PATH', ROOT_PATH.'usuario/');
define('MI_CUENTA_PATH', USUARIO_PATH.'mi-cuenta/');
define('MIS_BOLETOS_PATH', USUARIO_PATH.'mis-boletos/');
define('SUSCRIPCION_PATH', USUARIO_PATH.'suscripcion/');

// Rutas a carpetas de administración
define('ADMIN_PATH', ROOT_PATH.'admin/');
define('GESTIONAR_SORTEOS_PATH', ADMIN_PATH.'gestionar-sorteos/');
define('GESTIONAR_USUARIOS_PATH', ADMIN_PATH.'gestionar-usuarios/');
define('GESTIONAR_PAGOS_PATH', ADMIN_PATH.'gestionar-pagos/');
define('INFORMES_PATH', ADMIN_PATH.'informes/');
define('CONFIGURACION_PATH', ADMIN_PATH.'configuracion/');
?>
