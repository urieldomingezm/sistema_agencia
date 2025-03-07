<?php
class BodyHome
{
    public function render()
    {
        echo '<body class="d-flex flex-column h-100">';

        $this->renderHeader(); // Llamamos a la función para renderizar el header
        $this->renderTeamSection(); // Llamamos a la función para renderizar la sección del equipo
        $this->renderEventsSection(); // Llamamos a la función para renderizar la sección de eventos

        echo '</body>';
    }

    private function renderHeader()
    {
        echo '<main class="flex-shrink-0">';
        echo '<header class="bg-dark py-5">';
        echo '<div class="container px-5">';
        echo '<div class="row gx-5 align-items-center justify-content-center">';
        echo '<div class="col-lg-8 col-xl-7 col-xxl-6">';
        echo '<div class="my-5 text-center text-xl-start">';
        echo '<h1 class="display-5 fw-bolder text-white mb-2">Agencia Atenas</h1>';
        echo '<p class="lead fw-normal text-white-50 mb-4">La mejor comunidad de Habbo Hotel</p>';
        echo '<a class="btn btn-warning btn-lg px-4 me-sm-3" href="#">¡Únete ahora!</a>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">';
        echo '<img class="img-fluid rounded-3 my-5" src="https://api.a0.dev/assets/image?text=Habbo%20hotel%20with%20many%20colorful%20avatars%20in%20a%20lobby&aspect=1:1" alt="Habbo Hotel" />';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</header>';
        echo '</main>';
    }

    private function renderTeamSection()
{
    $teamMembers = [
        [
            'id' => '1',
            'name' => 'Juan Pérez',
            'role' => 'Líder de la comunidad y administrador principal',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20blonde%20hair%20and%20suit&aspect=1:1',
            'rank' => 'Fundador',
            'habboName' => 'JuanHabbo',
        ],
        [
            'id' => '2',
            'name' => 'Ana Gómez',
            'role' => 'Encargada de eventos y actividades de la comunidad',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20pink%20hair&aspect=1:1',
            'rank' => 'Directora',
            'habboName' => 'AnaHabbo',
        ],
        [
            'id' => '3',
            'name' => 'Carlos Díaz',
            'role' => 'Desarrollador web y encargado de la parte técnica',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20brown%20hair%20and%20glasses&aspect=1:1',
            'rank' => 'Técnico',
            'habboName' => 'CarlosHabbo',
        ],
        [
            'id' => '4',
            'name' => 'María Ruiz',
            'role' => 'Encargada de redes sociales y comunicación',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20red%20dress&aspect=1:1',
            'rank' => 'Community Manager',
            'habboName' => 'MariaHabbo',
        ],
        [
            'id' => '5',
            'name' => 'Laura Sánchez',
            'role' => 'Coordinadora de proyectos y eventos especiales',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20blue%20outfit&aspect=1:1',
            'rank' => 'Coordinadora',
            'habboName' => 'LauraHabbo',
        ],
        [
            'id' => '6',
            'name' => 'Pedro García',
            'role' => 'Especialista en marketing digital y contenido',
            'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20dark%20hair%20and%20casual%20clothes&aspect=1:1',
            'rank' => 'Marketing',
            'habboName' => 'PedroHabbo',
        ],
    ];

    echo '<section class="py-5 bg-light">';
    echo '<div class="container px-5">';
    echo '<div class="text-center mb-5">';
    echo '<h2 class="fw-bolder">Nuestro Equipo</h2>';
    echo '<p class="lead fw-normal text-muted">Conoce a los miembros que hacen posible Agencia Atenas</p>';
    echo '</div>';

    echo '<div class="row gx-5 justify-content-center">';
    foreach ($teamMembers as $member) {
        echo '<div class="col-lg-4 col-md-6 mb-4">';
        echo '<div class="card h-100 shadow border-0">';
        echo '<div class="card-img-top text-center p-3">';
        echo '<img src="' . $member['image'] . '" class="rounded-circle" alt="' . $member['name'] . '" style="width: 120px; height: 120px; border: 3px solid #4a69bd;">';
        // Aquí centramos el badge con el rank debajo de la imagen
        echo '<div class="badge bg-primary mt-2 d-block mx-auto" style="width: fit-content;">' . $member['rank'] . '</div>';
        echo '</div>';
        echo '<div class="card-body p-4 text-center">';
        echo '<h5 class="card-title">' . $member['name'] . '</h5>';
        echo '<p class="card-text">' . $member['role'] . '</p>';
        echo '<div class="d-flex align-items-center justify-content-center">';
        echo '<i class="fas fa-user me-2"></i>';
        echo '<span>' . $member['habboName'] . '</span>';
        echo '</div>';
        echo '</div>';
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
            [
                'id' => '1',
                'title' => 'Fiesta de Bienvenida',
                'description' => 'Conoce a todos los miembros de Agencia Atenas en nuestra fiesta de bienvenida',
                'date' => '15 de Marzo, 2025',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20party%20room%20with%20lots%20of%20avatars%20dancing&aspect=16:9',
            ],
            [
                'id' => '2',
                'title' => 'Concurso de Construcción',
                'description' => 'Muestra tus habilidades de construcción y gana premios increíbles',
                'date' => '22 de Marzo, 2025',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20building%20competition%20with%20furniture%20and%20decorations&aspect=16:9',
            ],
            [
                'id' => '3',
                'title' => 'Carrera de Obstáculos',
                'description' => 'Supera todos los obstáculos en el menor tiempo posible',
                'date' => '29 de Marzo, 2025',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20obstacle%20course%20with%20traps%20and%20challenges&aspect=16:9',
            ],
        ];

        echo '<section class="py-5">';
        echo '<div class="container px-5">';
        echo '<div class="text-center mb-5">';
        echo '<h2 class="fw-bolder">Próximos Eventos</h2>';
        echo '<p class="lead fw-normal text-muted">No te pierdas nuestras actividades en Habbo Hotel</p>';
        echo '</div>';

        echo '<div class="row gx-5">';
        foreach ($events as $event) {
            echo '<div class="col-lg-4 col-md-6 mb-4">';
            echo '<div class="card h-100 shadow border-0">';
            echo '<img src="' . $event['image'] . '" class="card-img-top" alt="' . $event['title'] . '" style="height: 180px; object-fit: cover;">';
            echo '<div class="card-body p-4">';
            echo '<h5 class="card-title">' . $event['title'] . '</h5>';
            echo '<p class="card-text">' . $event['description'] . '</p>';
            echo '<div class="d-flex align-items-center mb-3">';
            echo '<i class="fas fa-calendar-alt me-2"></i>';
            echo '<span>' . $event['date'] . '</span>';
            echo '</div>';
            echo '<a href="#" class="btn btn-primary">Inscribirme</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }
}

$bodyHome = new BodyHome();
$bodyHome->render();
?>