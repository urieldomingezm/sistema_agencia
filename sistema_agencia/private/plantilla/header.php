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

        // Bootstrap CSS
        echo '<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';

        // Simple database
        echo '<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">';
        echo '<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';
        // Simple database
        echo '<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">';
        echo '<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';
        // Bootstrap Icons CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">';

        // SweetAlert2 CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css" rel="stylesheet">';

        // Just-validate CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/just-validate@1.5.0/dist/css/just-validate.min.css" rel="stylesheet">';

        // Chart.js CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css" rel="stylesheet">';

        // Otros estilos
        echo '<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">';
        echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">';
        echo '<link type="text/css" rel="stylesheet" href="https://www.blogger.com/static/v1/widgets/3645911276-widget_css_bundle.css">';
        echo '<link type="text/css" rel="stylesheet" href="https://www.blogger.com/dyn-css/authorization.css?targetBlogID=6936817305946898479&zx=2fa9d285-e233-41f7-b579-9bf08ebc0786">';

        // Archivos CSS adicionales de tu proyecto
        foreach ($this->cssFiles as $file) {
            echo '<link href="' . $file . '" rel="stylesheet">';
        }

        // Archivos JS adicionales de tu proyecto
        foreach ($this->jsFiles as $file) {
            echo '<script src="' . $file . '" type="text/javascript"></script>';
        }

        // Archivos JS externos
        echo '<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>';
        echo '<script src="https://static.tumblr.com/y66747w/9hlmdpcpa/nivoslider.js" type="text/javascript"></script>';

        echo '</head>';
        echo '<body>';
    }
}

$header = new Header('Sistema de agencia');
// Archivos CSS personalizados
$header->addCssFile('/sistema_agencia/public/css/bootstrap.css');
$header->addCssFile('/sistema_agencia/public/css/bootstrap.min.css');
$header->addCssFile('/sistema_agencia/public/css/icons.css');
$header->addCssFile('/sistema_agencia/public/style.css');

// Archivos JS personalizados
$header->addJsFile('/sistema_agencia/public/script.js');
$header->addJsFile('/sistema_agencia/public/js/custom.js');

$header->render();
