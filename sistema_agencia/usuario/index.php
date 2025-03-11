<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_bajos.php');?>

<br>
<br>
<br>
<?php
if (isset($_GET['page'])) {
    
    if ($_GET['page'] == 'Gestion de tiempo') { // ARCHIVO GESTION TIEMPOS ALTOS
        include 'gestion_tiempos_altos.php';
    } elseif ($_GET['page'] == 'inicio') { // ARCHIVO GESTION USUARIO
        include 'user.php';
    }elseif ($_GET['page'] == 'Gestion administrador') { // ARCHIVO GESTION TIEMPOS ADMIN
        include 'gestion_tiempos_admin.php'; 
    } elseif ($_GET['page'] == 'perfil_de_usuario') { // ARCHIVO PERFIL USUARIO
        include 'perfil_usuario.php'; 
    } elseif ($_GET['page'] == 'cerrar_session_usuario') { // ARCHIVO CERRAR SESSION
        include 'cerrar_session.php';
    } elseif ($_GET['page'] == 'Requisitos de paga') { // ARCHIVO HOME
        include 'requisitos_para_paga.php'; 
    } elseif ($_GET['page'] == 'GSP') { // ARCHIVO GESTION DE PAGAS
        include 'GSP.php'; 
    } elseif ($_GET['page'] == 'GVE') { // ARCHIVO GESTION VENTAS
        include 'GVE.php'; 
    } elseif ($_GET['page'] == 'GVP') { // ARCHIVO GESTION VENTAS PLACAS
        include 'GVP.php'; 
    }else {
        echo "<h1>Página no encontrada</h1>";
        echo "<p>Redirigiendo a la página principal...</p>";
        header("refresh:1;url=index.php");
        exit();
    }
} else {
    include 'user.php';
}
?>

<?php require_once(TEMPLATES_PATH . 'footer.php'); ?>