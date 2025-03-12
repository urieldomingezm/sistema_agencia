<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');
require_once(MENU_PATH . 'menu_rango_altos.php'); ?>

<br>
<br>
<br>
<?php
if (isset($_GET['page'])) {

    if ($_GET['page'] == 'Gestion de tiempo') {             // ARCHIVO GESTION TIEMPOS ALTOS
        include 'GSTM.php';
    } elseif ($_GET['page'] == 'inicio') {                  // ARCHIVO HOME USUARIO
        include 'USR.php';
    } elseif ($_GET['page'] == 'perfil_de_usuario') {       // ARCHIVO PERFIL USUARIO
        include 'PRUS.php';
    } elseif ($_GET['page'] == 'cerrar_session_usuario') {  // ARCHIVO CERRAR SESSION
        include 'CRSS.php';
    } elseif ($_GET['page'] == 'Requisitos de paga') {      // ARCHIVO REQUISITOS PARA PAGA, ASCENSO, MISIONES
        include 'RQPG.php';
    } elseif ($_GET['page'] == 'gestion de ascensos') {     // ARCHIVO GESTION DE ASCENSOS
        include 'GSAS.php';
    } elseif ($_GET['page'] == 'GVE') {                     // PENDIENTE AUN
        include 'GVE.php';
    } elseif ($_GET['page'] == 'GVP') {                     // PENDIENTE AUN
        include 'GVP.php';
    } else {
        echo "<h1>Página no encontrada</h1>";
        echo "<p>Redirigiendo a la página principal...</p>";
        header("refresh:3;url=index.php");
        exit();
    }
} else {
    include 'USR.php';
}
?>

<?php require_once(TEMPLATES_PATH . 'footer.php'); ?>