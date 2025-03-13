
<?php
class Footer
{
    private $jsFiles = [];

    public function addJsFile($filePath)
    {
        $this->jsFiles[] = $filePath;
    }

    public function render()
    {
        echo '<footer style="background: linear-gradient(45deg, #d91960, #e0487c, #f07fa2, #d91960);" class="text-white text-center py-3 mt-auto">'; 
        echo '<div class="container">'; 
        echo '<div class="row">'; 
        echo '<div class="col-md-12">'; 
        echo '<p>&copy; ' . date('Y') . ' Agencia Atenas. Todos los derechos reservados para Ing. Medina.</p>';
        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
        echo '</footer>'; 

        // Botón de flecha hacia arriba
        echo '<button id="scrollTopBtn" class="btn rounded-circle" style="position:  fixed; bottom: 20px; right: 20px; display: none; z-index: 1000; background: linear-gradient(45deg, #d91960, #e0487c, #f07fa2, #d91960);" onclick="scrollToTop()">';
        echo '<i class="bi bi-arrow-up text-whiter"></i>'; 
        echo '</button>';

        // // Bootstrap JS
        // echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
        // echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>';
        // echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

        // // SweetAlert2 JS
        // echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>';

        // // Just-validate JS
        // echo '<script src="https://cdn.jsdelivr.net/npm/just-validate@1.5.0/dist/js/just-validate.min.js"></script>';

        // // Chart.js JS
        // echo '<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>';

        // // Archivos JS de tu proyecto
        // foreach ($this->jsFiles as $file) {
        //     echo '<script src="' . $file . '"></script>';
        // }

        // Script para mostrar el botón de la flecha al hacer scroll y la función de ir arriba
        echo '<script>
        // Mostrar el botón de flecha al hacer scroll
        window.onscroll = function() {toggleScrollTopBtn()};

        function toggleScrollTopBtn() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("scrollTopBtn").style.display = "block";
            } else {
                document.getElementById("scrollTopBtn").style.display = "none";
            }
        }

        // Función para ir arriba de la página
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }
        </script>';

        echo '</body>';
        echo '</html>';
    }
}

// Uso de la clase Footer
$footer = new Footer();
// $footer->addJsFile('/public/custom/custom/js/script.js');
$footer->render();
?>
