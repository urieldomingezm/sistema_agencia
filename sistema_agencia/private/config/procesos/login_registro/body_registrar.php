<?php

class BodyRegistro {
    public function render() {
        $cssPath = CUSTOM_LOGIN_REGISTRO_CSS_PATH . 'style.css';
        if (file_exists($cssPath)) {
            echo '<style>' . file_get_contents($cssPath) . '</style>';
        }

        echo '<div class="container-fluid vh-100">';
        echo '<div class="row h-100 justify-content-center align-items-center">';

        // Sección izquierda: Formulario de registro
        echo '<div class="col-md-6 d-flex align-items-center justify-content-center">';
        echo '<div class="login-container">';

        echo '<h2 class="text-center">Registrar usuario</h2>';
        echo '<form id="registerForm" class="was-validated" method="POST">';
        echo '<div class="mb-3">';
        echo '<label for="registro_usuario" class="form-label">Nombre de usuario</label>';
        echo '<input type="text" class="form-control" maxlength="16" id="registro_usuario" name="registro_usuario" placeholder="Nombre de usuario" required>';
        echo '<div class="invalid-feedback">Nombre de usuario de habbo</div>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="registro_password" class="form-label">Contraseña</label>';
        echo '<input type="password" class="form-control" maxlength="10" id="registro_password" name="registro_password" placeholder="Contraseña" required>';
        echo '<div class="invalid-feedback">Poner contraseña facil de recordar</div>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary w-100">Registrarse</button>';
        echo '</form>';
        echo '<div class="text-center mt-3">';
        echo '¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>';
        echo '</div>';
        echo '<div class="text-center mt-3">';
        echo '¿Quieres regresar? <a href="#" onclick="window.history.back()">Regresar</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="col-md-6 d-none d-md-block login-image"></div>';

        echo '</div>';
        echo '</div>';
    }
}

$bodyRegistro = new BodyRegistro();
$bodyRegistro->render();
?>
