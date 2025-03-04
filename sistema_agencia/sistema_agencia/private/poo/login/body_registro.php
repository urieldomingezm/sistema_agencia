<?php
class BodyRegistro {
    public function render() {
        echo '<div class="container mt-5">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h2 class="text-center">Registrar usuario</h2>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<form id="registerForm" method="POST">';
        echo '<div class="form-group">';
        echo '<label for="registro_usuario">Nombre de usuario</label>';
        echo '<input type="text" class="form-control" id="registro_usuario" name="registro_usuario" placeholder="Nombre de usuario" required>';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="registro_password">Contraseña</label>';
        echo '<input type="password" class="form-control" id="registro_password" name="registro_password" placeholder="Contraseña" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary btn-block">Registrarse</button>';
        echo '</form>';
        echo '</div>';
        echo '<div class="card-footer text-center">';
        echo '¿No tienes cuenta? <a href="login.php">Inicia session</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

$bodyRegistro = new BodyRegistro();
$bodyRegistro->render();
?>