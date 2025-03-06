<?php

class Navbar {
  private $brand;
  private $items;
  private $searchPlaceholder;
  private $searchButtonText;

  public function __construct($brand, $items, $searchPlaceholder = "Search", $searchButtonText = "Search") {
    $this->brand = $brand;
    $this->items = $items;
    $this->searchPlaceholder = $searchPlaceholder;
    $this->searchButtonText = $searchButtonText;
  }

  public function render() {
    echo '<nav class="navbar navbar-expand-lg bg-primary bg-body-tertiary" data-bs-theme="dark">';
    echo '<div class="container-fluid">';
    echo '<a class="navbar-brand" href="#">' . $this->brand . '</a>';
    echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';
    echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
    
    foreach ($this->items as $item) {
      if (isset($item['dropdown'])) {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
        echo $item['name'];
        echo '</a>';
        echo '<ul class="dropdown-menu">';
        foreach ($item['dropdown'] as $dropdownItem) {
          if ($dropdownItem == 'divider') {
            echo '<li><hr class="dropdown-divider"></li>';
          } else {
            echo '<li><a class="dropdown-item" href="#">' . $dropdownItem . '</a></li>';
          }
        }
        echo '</ul>';
        echo '</li>';
      } else {
        echo '<li class="nav-item">';
        echo '<a class="nav-link' . (isset($item['active']) && $item['active'] ? ' active' : '') . '" href="#">' . $item['name'] . '</a>';
        echo '</li>';
      }
    }

    echo '</ul>';
    echo '<form class="d-flex" role="search">';
    echo '<input class="form-control me-2" type="search" placeholder="' . $this->searchPlaceholder . '" aria-label="Search">';
    echo '<button class="btn btn-outline-success" type="submit">' . $this->searchButtonText . '</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';

    // Menú de hamburguesa para el perfil
    echo '<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">';
    echo '<div class="offcanvas-header">';
    echo '<h5 class="offcanvas-title" id="offcanvasProfileLabel">Perfil</h5>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
    echo '</div>';
    echo '<div class="offcanvas-body">';
    echo '<p>Aquí puedes mostrar los datos del perfil del usuario.</p>';
    echo '</div>';
    echo '</div>';

    echo '<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile" aria-controls="offcanvasProfile">';
    echo 'Perfil';
    echo '</button>';
  }
}

$items = [
  ['name' => 'Inicio', 'active' => true],
  ['name' => 'Informacion', 'dropdown' => ['Rangos', 'Requisitos paga', 'Membresias']],
  ['name' => 'Perfil', 'dropdown' => ['Chat General', 'divider', 'Cerrar sesión']],
];

$navbar = new Navbar('Navbar', $items);
$navbar->render();
?>