<?php
class Footer {
    private $jsFiles = [];

    public function addJsFile($filePath) {
        $this->jsFiles[] = $filePath;
    }

    public function render() {
        echo '<footer class="bg-dark text-white text-center py-3">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<p>&copy; ' . date('Y') . ' Mi Proyecto. Todos los derechos reservados.</p>';
        echo '<div class="social-icons">';
        echo '<a href="#" class="text-white mr-2"><i class="fab fa-facebook-f"></i></a>';
        echo '<a href="#" class="text-white mr-2"><i class="fab fa-twitter"></i></a>';
        echo '<a href="#" class="text-white mr-2"><i class="fab fa-instagram"></i></a>';
        echo '<a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</footer>';

        // Bootstrap JS
        echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

        // SweetAlert2 JS
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>';

        // Just-validate JS
        echo '<script src="https://cdn.jsdelivr.net/npm/just-validate@1.5.0/dist/js/just-validate.min.js"></script>';

        // Chart.js JS
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>';

        // Archivos JS de tu proyecto
        foreach ($this->jsFiles as $file) {
            echo '<script src="' . $file . '"></script>';
        }

        echo '</body>';
        echo '</html>';
    }
}

$footer = new Footer();
$footer->addJsFile('/sistema_agencia/public/js/custom.js');
$footer->render();
?>