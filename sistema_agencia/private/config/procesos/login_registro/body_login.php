<?php
class BodyLogin {
    public function render() {
        $cssPath = CUSTOM_LOGIN_REGISTRO_CSS_PATH . 'style.css';
        if (file_exists($cssPath)) {
            echo '<style>' . file_get_contents($cssPath) . '</style>';
        }

        echo '<div class="container-fluid vh-100">'; // 100% altura ajustada
        echo '<div class="row h-100 justify-content-center align-items-center">';

        echo '<div class="col-md-6 d-flex align-items-center justify-content-center">';
        echo '<div class="login-container">';
        
        echo '<h2>Iniciar Sesión</h2>';
        echo '<form id="loginForm" method="POST">';
        echo '<div class="mb-3">';
        echo '<label for="exampleInputUsername" class="form-label">Nombre de usuario</label>';
        echo '<input type="text" class="form-control" id="exampleInputUsername" name="login_usuario" placeholder="Nombre de usuario" required>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="exampleInputPassword" class="form-label">Contraseña</label>';
        echo '<input type="password" class="form-control" id="exampleInputPassword" name="login_password" placeholder="Contraseña" required>';
        echo '</div>';
        echo '<button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>';
        echo '</form>';
        echo '<div class="text-center mt-3">';
        echo '¿No tienes cuenta? <a href="registrar.php">Regístrate gratis</a>';
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

$bodyLogin = new BodyLogin();
$bodyLogin->render();
?>
