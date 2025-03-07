<?php
class Header
{
    private $title;
    private $cssFiles = [];

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function addCssFile($filePath)
    {
        $this->cssFiles[] = $filePath;
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
        // Bootstrap Icons CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">';
        // SweetAlert2 CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css" rel="stylesheet">';
        // Just-validate CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/just-validate@1.5.0/dist/css/just-validate.min.css" rel="stylesheet">';
        // Chart.js CSS
        echo '<link href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css" rel="stylesheet">';

        // Archivos CSS de tu proyecto
        foreach ($this->cssFiles as $file) {
            echo '<link href="' . $file . '" rel="stylesheet">';
        }

        echo '</head>';
        echo '<body>';
    }
}

$header = new Header('Sistema de agencia');
// $header->addCssFile('/sistema_agencia/public/css/login/style.css'); // checar mas alrato
$header->addCssFile('/sistema_agencia/public/css/bootstrap.css');
$header->addCssFile('/sistema_agencia/public/css/bootstrap.min.css');
$header->addCssFile('/sistema_agencia/public/css/icons.css');
$header->render();
