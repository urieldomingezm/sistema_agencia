<?php
class BodyHome {
    public function render() {
        echo '<div class="container mt-5">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h2 class="text-center">Iniciar Sesión</h2>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<form id="loginForm" method="POST">';
        echo '<div class="form-group">';
        echo '<label for="exampleInputUsername">Nombre de usuario</label>';
        echo '<input type="text" class="form-control" id="exampleInputUsername" name="login_usuario" placeholder="Nombre de usuario" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="exampleInputPassword">Contraseña</label>';
        echo '<input type="password" class="form-control" id="exampleInputPassword" name="login_password" placeholder="Contraseña" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>';
        echo '</form>';
        echo '</div>';
        echo '<div class="card-footer text-center">';
        echo '¿No tienes cuenta? <a href="registrar.php">Regístrate gratis</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

$bodyHome = new BodyHome();
$bodyHome ->render();
?>