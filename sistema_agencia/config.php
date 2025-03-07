<?php
// Definir la ruta raíz del proyecto
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/sistema_agencia/');

// Rutas a carpetas privadas
define('PRIVATE_PATH', ROOT_PATH.'private/');
define('TEMPLATES_PATH', PRIVATE_PATH.'plantilla/'); 
define('CONFIG_PATH', PRIVATE_PATH.'config/'); 

// Checar si funciona carpeta de POO
define('POO_PATH', PRIVATE_PATH.'poo/login/'); 
define('MODELOS_PATH', PRIVATE_PATH.'modelos/login/'); 
define('POO_HOME_PATH', PRIVATE_PATH.'modelos/home/'); 

// Rutas para body de inicio, usuarios, ect
define('BODY_HOME_PATH', PRIVATE_PATH.'config/procesos/home/'); 
// define('BODY_HOME_PATH', PRIVATE_PATH.'config/procesos/home/'); 

// Rutas para procesos de login, registros, etc
define('PROCESOS_LOGIN_PATH', PRIVATE_PATH.'config/procesos/login_registro/'); 
// define('PROCESOS_LOGIN_PATH', PRIVATE_PATH.'config/procesos/login_registro/'); 

// Rutas de configuracion privadas
define('MENU_PATH', PRIVATE_PATH.'menus/');     
define('UPLOADS_PATH', PRIVATE_PATH.'uploads/');      
define('SCRIPTS_PATH', PRIVATE_PATH.'scripts/');     
define('SUBSCRIPTIONS_PATH', PRIVATE_PATH.'subscriptions/');      
define('MODAL_PATH', PRIVATE_PATH.'modals/');   

// Rutas a carpetas públicas como CSS, JS, IMG
define('PUBLIC_PATH', ROOT_PATH.'public/');
// Ruta para JS, IMAGE, CSS
define('CUSTOM_LOGIN_REGISTRO_PATH', PUBLIC_PATH.'custom/custom_login_registro/');
define('CUSTOM_LOGIN_REGISTRO_CSS_PATH', PUBLIC_PATH.'custom/custom_login_registro/css/');
define('CUSTOM_LOGIN_REGISTRO_JS_PATH', PUBLIC_PATH.'custom/custom_login_registro/js/');
define('CUSTOM_LOGIN_REGISTRO_IMAGE_PATH', PUBLIC_PATH.'custom/custom_login_registro/image/');
// Ruta para JS, IMAGE, CSS
define('CUSTOM_HOME_PATH', PUBLIC_PATH.'custom/custom_home/');
define('CUSTOM_HOME_CSS_PATH', PUBLIC_PATH.'custom/custom_home/css/');
define('CUSTOM_HOME_JS_PATH', PUBLIC_PATH.'custom/custom_home/js/');
define('CUSTOM_HOME_IMAGE_PATH', PUBLIC_PATH.'custom/custom_home/image/');

// Rutas a carpetas de usuarios
define('USUARIO_PATH', ROOT_PATH.'usuario/');
define('MI_CUENTA_PATH', USUARIO_PATH.'mi_cuenta/');
define('ACCIONES_PATH', USUARIO_PATH.'acciones/');

// Rutas a carpetas de administración
define('ADMIN_PATH', ROOT_PATH.'admin/');
define('MI_CUENTA__ADMIN_PATH', ADMIN_PATH.'mi_cuenta/');
define('DASHBOARD_PATH', ADMIN_PATH.'dashboard/');
define('ACCIONES_ADMIN_PATH', ADMIN_PATH.'acciones/');
?>
