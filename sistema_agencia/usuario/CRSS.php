<!-- INFORMACION DE CERRAR SESSION -->
<meta name="keywords" content="Cerrar cuenta, session">

<?php
session_start();
session_unset();
session_destroy();
header("Location: /index.php");
exit();
?>
