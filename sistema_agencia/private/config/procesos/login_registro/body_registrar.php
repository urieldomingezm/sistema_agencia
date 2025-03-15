<?php
class BodyRegistro {
    public function render() {
        ?>
        <div class="container-fluid vh-100">
            <div class="row h-100">
                <!-- Left Section: Registration Form -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center position-relative">
                    <div class="registration-container">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-plus display-4 text-primary mb-3"></i>
                            <h2 class="fw-bold">Crear Cuenta</h2>
                            <p class="text-muted">Únete a nuestro equipo</p>
                        </div>

                        <form id="registerForm" class="was-validated" method="POST">
                            <div class="form-floating mb-4">
                                <input type="text" 
                                       class="form-control" 
                                       maxlength="16" 
                                       id="registro_usuario" 
                                       name="registro_usuario" 
                                       placeholder="Usuario"
                                       required>
                                <label for="registro_usuario">
                                    <i class="fas fa-user text-primary me-2"></i>Nombre de usuario
                                </label>
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-2"></i>Ingresa tu nombre de usuario de Habbo
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" 
                                       class="form-control" 
                                       maxlength="10" 
                                       id="registro_password" 
                                       name="registro_password" 
                                       placeholder="Contraseña"
                                       required>
                                <label for="registro_password">
                                    <i class="fas fa-lock text-primary me-2"></i>Contraseña
                                </label>
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-2"></i>Ingresa una contraseña fácil de recordar
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 mb-4">
                                <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                            </button>

                            <div class="text-center">
                                <p class="mb-2">
                                    ¿Ya tienes cuenta? 
                                    <a href="login.php" class="text-primary text-decoration-none">
                                        <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                                    </a>
                                </p>
                                <a href="#" onclick="window.history.back()" class="text-muted text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i>Regresar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Section: Background Image -->
                <div class="col-lg-6 d-none d-lg-block registration-image">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>

        <style>
        .registration-container {
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .registration-image {
            background-image: url('/public/custom/custom_login_registro/img/hb.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            }

        .form-floating > label {
            padding-left: 1.75rem;
        }

        .form-control {
            border: 2px solid #e3e6f0;
            padding: 1rem 0.75rem;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.2);
        }

        .invalid-feedback {
            font-size: 80%;
        }

        @media (max-width: 991.98px) {
            .registration-container {
                max-width: 100%;
                box-shadow: none;
            }
        }
        </style>
        <?php
    }
}

$bodyRegistro = new BodyRegistro();
$bodyRegistro->render();
?>
