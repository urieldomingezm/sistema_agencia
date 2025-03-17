<?php

class BodyHome
{
    public function render()
    {
        echo '<body class="d-flex flex-column h-100" style="background-color: #F3F0FF; font-family: \'Poppins\', sans-serif;">';
        $this->renderHeader();
        $this->renderTeamSection();
        $this->renderEventsSection();
        echo '</body>';
    }

    private function renderHeader()
    {
        echo '<br><br>';
        echo '<main class="flex-shrink-0">';
        echo '<header style="background: linear-gradient(135deg, #A78BFA, #8B5CF6); padding: 40px 0; box-shadow: 0 4px 6px rgba(139, 92, 246, 0.1);">';
        echo '<div class="container text-center">';
        echo '<h1 style="color: white; font-weight: 700;">✨ Agencia Atenas ✨</h1>';
        echo '<p style="color: #FFF; font-size: 1.2rem; opacity: 0.9;">La mejor comunidad de Habbo Hotel</p>';
        echo '<a href="#" style="background: #F3F0FF; color: #8B5CF6; padding: 15px 30px; border-radius: 30px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">¡Únete ahora!</a>';
        echo '</div>';
        echo '</header>';
        echo '</main>';
    }

    private function renderTeamSection()
    {
        $teamMembers = [
            [
                'id' => '1',
                'name' => 'Santidemgs',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20blonde%20hair%20and%20suit&aspect=1:1',
                'rank' => 'Dueño',
            ],
            [
                'id' => '2',
                'name' => 'Manu',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20pink%20hair&aspect=1:1',
                'rank' => 'Dueño',
            ],
            [
                'id' => '3',
                'name' => 'Carlos Díaz',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20brown%20hair%20and%20glasses&aspect=1:1',
                'rank' => 'Dueño',
            ],
            [
                'id' => '4',
                'name' => 'María Ruiz',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20red%20dress&aspect=1:1',
                'rank' => 'Dueño',
            ],
            [
                'id' => '5',
                'name' => 'Loucio',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20female%20with%20blue%20outfit&aspect=1:1',
                'rank' => 'Administrador',
            ],
            [
                'id' => '6',
                'name' => 'asdasdas',
                'role' => 'ATN- Supervisor -XDD -SDD #',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20dark%20hair%20and%20casual%20clothes&aspect=1:1',
                'rank' => 'Administrador',
            ],
        ];

            echo '<section style="background-color: #87CEEB; padding: 50px 0;">';
            echo '<div class="container text-center">';
            echo '<h2 style="color: white; font-weight: bold;">👑 Nuestro Equipo 👑</h2>';
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
            ['title' => 'Concurso de Construcción', 'description' => 'Muestra tus habilidades de construcción y gana premios increíbles', 'date' => '22 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20building%20competition%20with%20furniture%20and%20decorations&aspect=16:9'],
            ['title' => 'Carrera de Obstáculos', 'description' => 'Supera todos los obstáculos en el menor tiempo posible', 'date' => '29 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20obstacle%20course%20with%20traps%20and%20challenges&aspect=16:9'],
        ];

        echo '<section style="background: #DDD6FE; padding: 50px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: #7C3AED; font-weight: 700; margin-bottom: 40px;">🎉 Próximos Eventos 🎉</h2>';
        echo '<div class="row">';

        foreach ($events as $event) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 15px rgba(139, 92, 246, 0.1); height: 100%;">';
            echo '<img src="' . $event['image'] . '" style="width: 100%; height: 180px; border-radius: 15px; object-fit: cover; margin-bottom: 20px;">';
            echo '<h3 style="color: #4C1D95; font-weight: 600;">' . $event['title'] . '</h3>';
            echo '<p style="color: #6B7280; margin: 15px 0;">' . $event['description'] . '</p>';
            echo '<span style="background: #8B5CF6; color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500;">📅 ' . $event['date'] . '</span>';
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
