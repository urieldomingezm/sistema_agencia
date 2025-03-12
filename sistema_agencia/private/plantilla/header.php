<?php
class Header
{
    private $title;
    private $cssFiles = [];
    private $jsFiles = [];

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function addCssFile($filePath)
    {
        $this->cssFiles[] = $filePath;
    }

    public function addJsFile($filePath)
    {
        $this->jsFiles[] = $filePath;
    }

    public function render()
    {
        echo '<!DOCTYPE html>';
        echo '<html lang="es">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>' . $this->title . '</title>';
        echo '<link rel="icon" type="image/x-icon" href="/public/custom/custom_radio/img/dj.jpg">';

        // Cargar archivos desde CDN por defecto
        
        echo '<link id="bootstrap-css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
        echo '<script id="bootstrap-js" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';

        echo '<link id="datatable-css" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">';
        echo '<script id="datatable-js" src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';

        echo '<link id="icons-css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">';
        echo '<link id="sweetalert-css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css" rel="stylesheet">';
        echo '<link id="chart-css" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css" rel="stylesheet">';

        // Archivos CSS adicionales de tu proyecto
        foreach ($this->cssFiles as $file) {
            echo '<link href="' . $file . '" rel="stylesheet">';
        }

        // Archivos JS adicionales de tu proyecto
        foreach ($this->jsFiles as $file) {
            echo '<script src="' . $file . '" type="text/javascript"></script>';
        }

        echo '<script>
            // Función para verificar si un archivo se cargó correctamente
            function checkAndLoadCDN(id, fallbackUrl) {
                var element = document.getElementById(id);
                if (!element || element.sheet === null) {
                    console.warn("CDN no disponible, cargando desde local:", fallbackUrl);
                    var newElement;
                    
                    if (id.includes("-js")) {
                        newElement = document.createElement("script");
                        newElement.src = fallbackUrl;
                        newElement.async = false;
                    } else {
                        newElement = document.createElement("link");
                        newElement.rel = "stylesheet";
                        newElement.href = fallbackUrl;
                    }

                    document.head.appendChild(newElement);
                }
            }

            // Verifica y carga recursos locales si es necesario
            window.onload = function () {
                checkAndLoadCDN("bootstrap-css", "/public/custom/bootstrap/bootstrap.css");
                checkAndLoadCDN("bootstrap-js", "/public/custom/bootstrap/bootstrap.bundle.min.js");
                checkAndLoadCDN("datatable-css", "/public/custom/datatables/style.css");
                checkAndLoadCDN("datatable-js", "/public/custom/datatables/datatables.js");
                checkAndLoadCDN("icons-css", "/public/custom/bootstrap/icons.css");
                checkAndLoadCDN("sweetalert-css", "/public/custom/sweetalert2/sweetalert2.min.css");
                checkAndLoadCDN("chart-css", "/public/custom/chart.js/chart.min.css");
            };
        </script>';

        echo '</head>';
        echo '<body>';
    }
}

$header = new Header('Sistema de agencia');
// Archivos CSS personalizados (versiones locales)
$header->addCssFile('/public/custom/bootstrap/bootstrap.css');
$header->addCssFile('/public/custom/bootstrap/bootstrap.min.css');
$header->addCssFile('/public/custom/bootstrap/icons.css');

// Archivos de datatable simple CSS y JS personalizados (versiones locales)
$header->addCssFile('/public/custom/simple_datatables/css/style.css');
$header->addJsFile('/public/custom/simple_datatables/js/script.js');

// Archivos JS personalizados
$header->addJsFile('/public/custom/custom/js/script.js');

$header->render();
?>
