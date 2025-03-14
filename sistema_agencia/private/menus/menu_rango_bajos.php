<?php
class Navbar
{
  private $brand;
  private $items;
  private $searchPlaceholder;
  private $searchButtonText;
  private $userData;

  public function __construct($brand, $items, $userData, $searchPlaceholder = "Buscar", $searchButtonText = "Buscar")
  {
    $this->brand = $brand;
    $this->items = $items;
    $this->searchPlaceholder = $searchPlaceholder;
    $this->searchButtonText = $searchButtonText;
    $this->userData = $userData;
  }

  public function render()
  {
    echo '<nav class="navbar fixed-top" style="background: linear-gradient(45deg, #d91960, #e0487c, #f07fa2, #d91960);">';
    echo '<div class="container-fluid">';
    
    // Marca
    echo '<a class="navbar-brand text-white" href="index.php">' . $this->brand . '</a>';

    // Botón del toggler para abrir el offcanvas
    echo '<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';

    // Offcanvas Menu
    echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">';
    echo '<div class="offcanvas-header">';
    echo '<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
    echo '</div>';
    
    echo '<div class="offcanvas-body">';
    echo '<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">';

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
              if ($dropdownItem == 'Gestion de tiempo') {
                echo '<li><a class="dropdown-item" href="index.php?page=Gestion de tiempo">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Gestion ascenso') {
                echo '<li><a class="dropdown-item" href="index.php?page=gestion de ascensos">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Ventas membresias') {
                echo '<li><a class="dropdown-item" href="index.php?page=Venta de membresias">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Ventas rangos') {
                echo '<li><a class="dropdown-item" href="index.php?page=venta de rangos">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Grafico total ventas') {
                echo '<li><a class="dropdown-item" href="index.php?page=grafico total ventas">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Gestion de pagas') {
                echo '<li><a class="dropdown-item" href="index.php?page=grafico total paga">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Grafico total de pagas') {
                echo '<li><a class="dropdown-item" href="index.php?page=grafico total paga">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Dar ascenso') {
                echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalAscenso">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Pagar usuario') {
                echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalpagar">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Vender membresias y rangos') {
                echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalrangos">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Tomar Time') {
                echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTiempo">' . $dropdownItem . '</a></li>';
              } elseif ($dropdownItem == 'Requisitos paga') {
                echo '<li><a class="dropdown-item" href="index.php?page=Requisitos de paga">' . $dropdownItem . '</a></li>';
              } else {
                echo '<li><a class="dropdown-item" href="index.php?page=' . strtolower(str_replace(' ', '_', $dropdownItem)) . '">' . $dropdownItem . '</a></li>';
              }
            }
          }
          echo '</ul>';
          echo '</li>';
        } else {
          echo '<li class="nav-item">';
          echo '<a class="nav-link text-black' . (isset($item['active']) && $item['active'] ? ' active' : '') . '" href="index.php?page=' . strtolower(str_replace(' ', '_', $item['name'])) . '">' . $item['name'] . '</a>';
          echo '</li>';
        }
      }

    echo '</ul>';

    // Formulario de búsqueda
    echo '<form class="d-flex mt-3" role="search" method="GET" action="/usuario/index.php">';
    echo '<input class="form-control me-2" name="q" type="search" placeholder="' . $this->searchPlaceholder . '" aria-label="Search">';
    echo '<button class="btn btn-outline-success" type="submit">' . $this->searchButtonText . '</button>';
    echo '</form>';
    
    echo '</div>';
    echo '</div>'; // Cierra offcanvas

    echo '</div>'; // Cierra container-fluid
    echo '</nav>';
  }
}

// Datos del usuario
$userData = [
  'usuario' => 'Santidemg',
  'rango' => 'Seguridad',
  'avatar' => '/public/custom/custom_menus_usuarios/image/profile.png'
];

$items = [
  ['name' => 'Inicio', 'active' => true],
  ['name' => 'Informacion', 'dropdown' => ['Requisitos paga']],
  ['name' => 'Ascenso', 'dropdown' => ['Gestion de tiempo', 'Gestion ascenso', 'divider', 'Dar ascenso', 'Tomar Time']],
  ['name' => 'Ventas', 'dropdown' => ['Ventas membresias', 'Ventas rangos', 'Grafico total ventas', 'divider', 'Vender membresias y rangos']],
  ['name' => 'Paga', 'dropdown' => ['Gestion de pagas', 'Pagar usuario', 'Grafico total de pagas']],
];

$navbar = new Navbar('Agencia Atenas', $items, $userData);
$navbar->render();

require_once(MODALES_MENU_PATH . 'modal_ascender.php');
require_once(MODALES_MENU_PATH . 'modal_tiempo_paga.php');
require_once(MODALES_MENU_PAGA_PATH . 'modal_pagar_usuario.php');
require_once(MODALES_MENU_VENTAS_PATH . 'modal_vender_rangos.php');

?>