<?php

class BodyHome
{
    public function render()
    {
        echo '<body class="d-flex flex-column h-100" style="background-color: #FFD700; font-family: Arial, sans-serif;">';
        $this->renderHeader();
        $this->renderTeamSection();
        $this->renderEventsSection();
        $this->renderPaydaySection();
        $this->renderMembershipSection();
        echo '</body>';
    }

    private function renderHeader()
    {
        echo '<br>';
        echo '<br>';
        echo '<main class="flex-shrink-0">';
        echo '<header style="background: linear-gradient(180deg, #FFCC00, #FFAA00); padding: 40px 0;">';
        echo '<div class="container text-center">';
        echo '<h1 style="color: white; font-weight: bold;">🌟 Agencia Atenas 🌟</h1>';
        echo '<p style="color: #FFF; font-size: 18px;">Bienvenido a nuestra agencia esperamos y nos podemos divertir juntos</p>';
        echo '</div>';
        echo '</header>';
        echo '</main>';
    }

    private function renderTeamSection()
    {
        $teamMembers = [
            ['name' => 'Santidemg', 'role' => 'Supervisor', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20blonde%20hair%20and%20suit&aspect=1:1', 'rank' => 'Dueño'],
            ['name' => 'Manu', 'role' => 'Supervisor', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20pink%20hair&aspect=1:1', 'rank' => 'Dueño'],
            ['name' => 'Carlos Díaz', 'role' => 'Supervisor', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20brown%20hair%20and%20glasses&aspect=1:1', 'rank' => 'Dueño'],
            ['name' => 'María Ruiz', 'role' => 'Supervisor', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20red%20dress&aspect=1:1', 'rank' => 'Dueño'],
            ['name' => 'Loucio', 'role' => 'Administrador', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20blue%20outfit&aspect=1:1', 'rank' => 'Administrador'],
            ['name' => 'Sofia', 'role' => 'Administradora', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20green%20dress&aspect=1:1', 'rank' => 'Administradora'],
        ];

        echo '<section style="background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important; padding: 50px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: black; font-weight: bold;">👑 Nuestro Equipo 👑</h2>';
        echo '<div class="row justify-content-center">'; // Centrar el contenido

        foreach ($teamMembers as $member) {
            echo '<div class="col-12 col-sm-6 col-md-4 mb-4">'; // 1 columna en móvil, 2 en tablet, 3 en PC
            echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">';
            echo '<img src="' . $member['image'] . '" style="border-radius: 50%; width: 100px; height: 100px; border: 3px solid #FFD700;">';
            echo '<h3 style="color: #333;">' . $member['name'] . '</h3>';
            echo '<p style="color: #666;">' . $member['role'] . '</p>';
            echo '<span style="background: #FF4500; color: white; padding: 5px 10px; border-radius: 10px;">' . $member['rank'] . '</span>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    private function renderEventsSection()
    {
        $events = [
            ['title' => 'Fiesta de Bienvenida', 'description' => 'Conoce a todos los miembros de Agencia Atenas en nuestra fiesta de bienvenida', 'date' => '15 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20party%20room%20with%20lots%20of%20avatars%20dancing&aspect=16:9'],
            ['title' => 'Construcción', 'description' => 'Muestra tus habilidades de construcción y gana premios increíbles', 'date' => '22 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20building%20competition%20with%20furniture%20and%20decorations&aspect=16:9'],
            ['title' => 'Carrera de Obstáculos', 'description' => 'Supera todos los obstáculos en el menor tiempo posible', 'date' => '29 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20obstacle%20course%20with%20traps%20and%20challenges&aspect=16:9'],
        ];

        echo '<section style="background: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important; padding: 10px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: black; font-weight: bold;">🎉 Noticias 🎉</h2>';
        echo '<div class="row">';

        foreach ($events as $event) {
            echo '<div class="col-md-4" style="margin-top: 20px;">';
            echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2);">';
            echo '<img src="' . $event['image'] . '" style="width: 100%; height: 150px; border-radius: 10px; object-fit: cover;">';
            echo '<h3 style="color: #333; margin-top: 10px;">' . $event['title'] . '</h3>';
            echo '<p style="color: #666;">' . $event['description'] . '</p>';
            echo '<span style="background: #008080; color: white; padding: 5px 10px; border-radius: 10px;">' . $event['date'] . '</span>';
            echo '<br><br>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    private function renderPaydaySection()
    {
        $countries = [
            ['name' => 'México', 'flag' => 'https://flagcdn.com/mx.svg'],
            ['name' => 'Argentina', 'flag' => 'https://flagcdn.com/ar.svg'],
            ['name' => 'Colombia', 'flag' => 'https://flagcdn.com/co.svg'],
            ['name' => 'Perú', 'flag' => 'https://flagcdn.com/pe.svg'],
            ['name' => 'Chile', 'flag' => 'https://flagcdn.com/cl.svg'],
        ];

        echo '<section style="background: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important; padding: 20px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: black; font-weight: bold;">💰 Día de Paga 💰</h2>';
        echo '<div class="row justify-content-center">';

        foreach ($countries as $country) {
            echo '<div class="col-6 col-sm-4 col-md-3 mb-4">'; // Aumentamos el tamaño de la columna
            echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 8px 15px rgba(0,0,0,0.2);">';
            echo '<img src="' . $country['flag'] . '" style="width: 100%; height: 120px; border-radius: 8px; object-fit: cover;">'; // Ajustamos la imagen
            echo '<p style="color: #333; margin-top: 15px; font-size: 18px; font-weight: bold;">' . $country['name'] . '</p>';
            echo '<p style="color: #666; font-size: 16px;">Hora de paga: 14:00</p>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</section>';
    }


    private function renderMembershipSection()
    {
        $memberships = [
            [
                'title' => 'Membresía gold',
                'benefits' => 'Bonificación del 5% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/gold.png' // URL de la imagen
            ],
            [
                'title' => 'Membresía Premium',
                'benefits' => 'Bonificación del 15% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/premim.png' // URL de la imagen
            ],
            [
                'title' => 'Membresía regla libre',
                'benefits' => 'Bonificación del 25% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/regla.png' // URL de la imagen
            ],
            [
                'title' => 'Membresía save',
                'benefits' => 'Bonificación del 35% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/save.png' // URL de la imagen
            ],
            [
                'title' => 'Membresía vip',
                'benefits' => 'Bonificación del 50% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/vip.png' // URL de la imagen
            ],
            [
                'title' => 'Membresía silver',
                'benefits' => 'Bonificación del 50% en paga.',
                'image' => '/public/custom/custom_requisitos_rangos/image/membresias/silver.png' // URL de la imagen
            ],
        ];

        echo '<section style="background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important; padding: 10px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: #333; font-weight: bold;">🌟 Membresías Disponibles 🌟</h2>';
        echo '<p style="color: #666; font-size: 18px;">Elige la membresía que mejor se adapte a tus necesidades y disfruta de nuestros beneficios exclusivos.</p>';
        echo '<div class="row justify-content-center">';

        foreach ($memberships as $membership) {
            echo '<div class="col-12 col-sm-6 col-md-4 mb-4">'; // 1 columna en móvil, 2 en tablet, 3 en PC
            echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">';
            echo '<img src="' . $membership['image'] . '" style="width: 100%; height: 150px; border-radius: 10px; object-fit: cover; margin-bottom: 15px;">'; // Imagen de la membresía
            echo '<h3 style="color: #333;">' . $membership['title'] . '</h3>';
            echo '<p style="color: #008080; font-weight: bold;">' . $membership['benefits'] . '</p>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>'; // Cierre de la fila
        echo '</div>'; // Cierre del contenedor
        echo '</section>';
    }
}

// Instancia y renderizado de la clase
require_once(BODY_DJ_PATH . 'dj_radio.php');
$bodyHome = new BodyHome();
$bodyHome->render();
