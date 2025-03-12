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
    echo '<style>
      .dropdown-menu {
        background-color: #343a40;
      }
      .dropdown-item {
        color: white;
      }
      .dropdown-item:hover, .dropdown-item:focus {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
      }
      .user-dropdown .dropdown-toggle::after {
        display: none;
      }
      .navbar-brand {
        flex-grow: 1;
        text-align: center;
      }
      .navbar-nav {
        flex-grow: 1;
        justify-content: flex-end;
      }
      .navbar-nav .nav-item {
        margin-left: 15px;
      }
      .user-dropdown {
        margin-left: auto;
        display: flex;
        align-items: center;
      }
      .user-dropdown .dropdown-toggle {
        padding-left: 10px;
        padding-right: 10px;
      }
      .user-dropdown img {
        margin-right: 10px;
      }
    </style>';

    echo '<nav class="navbar navbar-expand-lg fixed-top" style="background-color:rgb(209, 25, 96);" data-bs-theme="dark">';
    echo '<div class="container-fluid d-flex">';

    // Usuario con dropdown alineado a la izquierda
    echo '<div class="nav-item dropdown ms-5 user-dropdown">';
    echo '<a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    echo '<img src="' . $this->userData['avatar'] . '" alt="Perfil" class="rounded-circle" width="35" height="35">';
    echo '</a>';
    echo '<ul class="dropdown-menu dropdown-menu-end">';
    echo '<li><span class="dropdown-item-text text-white"><strong>' . $this->userData['usuario'] . '</strong></span></li>';
    echo '<li><hr class="dropdown-divider"></li>';
    echo '<li><span class="dropdown-item-text text-white">' . $this->userData['rango'] . '</span></li>';
    echo '<li><hr class="dropdown-divider"></li>';
    echo '<li><a class="dropdown-item" href="index.php?page=perfil de usuario">Ver perfil</a></li>';
    echo '<li><a class="dropdown-item" href="index.php?page=cerrar_session_usuario">Cerrar sesión</a></li>';
    echo '</ul>';
    echo '</div>';

    // Navbar brand centrado
    echo '<a class="navbar-brand text-white" href="index.php?page=home">' . $this->brand . '</a>';

    // Botón del toggler con SVG personalizado
    echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
          </svg>';
    echo '</button>';

    echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';

    // Elementos alineados a la derecha
    echo '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">';

    foreach ($this->items as $item) {
      if (isset($item['dropdown'])) {
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
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
        echo '<a class="nav-link text-white' . (isset($item['active']) && $item['active'] ? ' active' : '') . '" href="index.php?page=' . strtolower(str_replace(' ', '_', $item['name'])) . '">' . $item['name'] . '</a>';
        echo '</li>';
      }
    }

    echo '</ul>';

    // Formulario de búsqueda
    echo '<form class="d-flex ms-3" role="search" method="GET" action="/usuario/index.php">';
    echo '<input class="form-control me-2 bg-light text-dark" type="search" name="q" placeholder="' . $this->searchPlaceholder . '" aria-label="Search">';
    echo '<button class="btn btn-light" type="submit">' . $this->searchButtonText . '</button>';
    echo '</form>';

    echo '</div>';
    echo '</div>';
    echo '</nav>';
  }
}

// Datos del usuario (se pueden obtener desde una base de datos o sesión)
$userData = [
  'usuario' => 'Santidemg',
  'rango' => 'Seguridad',
  'avatar' => '/public/custom/custom_menus_usuarios/image/profile.png'
];

$items = [
  ['name' => 'Inicio', 'active' => true],
  ['name' => 'Informacion', 'dropdown' => ['Requisitos paga']],
  ['name' => 'Ascenso y tiempo', 'dropdown' => ['Gestion de tiempo', 'Gestion ascenso']],
  ['name' => 'Administraccion', 'dropdown' => ['Gestion de tiempo', 'Gestion ascenso']],
  ['name' => 'Ventas', 'dropdown' => ['Gestion de tiempo', 'Gestion ascenso']],
];

$navbar = new Navbar('Agencia Atenas', $items, $userData);
$navbar->render();
