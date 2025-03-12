<br>
<?php

class UserProfile
{
    public function render()
    {
        echo '<body class="d-flex flex-column h-100" style="background-color: #FFD700; font-family: Arial, sans-serif;">';
        $this->renderHeader();
        $this->renderProfileSection();
        echo '</body>';
    }

    private function renderHeader()
    {
        echo '<header style="background: linear-gradient(180deg, #FFCC00, #FFAA00); padding: 40px 0;">';
        echo '<div class="container text-center">';
        echo '<h1 style="color: white; font-weight: bold;">👤 Perfil de Usuario 👤</h1>';
        echo '<p style="color: #FFF; font-size: 18px;">Bienvenido a tu perfil, aquí puedes ver tu información.</p>';
        echo '</div>';
        echo '</header>';
    }

    private function renderProfileSection()
    {
        echo '<section style="background-color: #87CEEB; padding: 50px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: white; font-weight: bold;">Información del Usuario</h2>';
        echo '<div class="row justify-content-center">';

        // Tarjeta de Información del Usuario
        echo '<div class="col-12 col-md-4 mb-4">';
        echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2);">';
        echo '<img src="https://api.a0.dev/assets/image?text=Habbo%20avatar%20with%20brown%20hair&aspect=1:1" style="border-radius: 50%; width: 100px; height: 100px; border: 3px solid #FFD700;">';
        echo '<h3 style="color: #333;">Santidemg</h3>';
        echo '<p style="color: #666;">Rol: Supervisor</p>';
        echo '<p style="color: #666;">Misión: AGT- Supervisor G -XDD -SDS #</p>';
        echo '</div>';
        echo '</div>';

        // Tarjeta de Día de Paga
        echo '<div class="col-12 col-md-4 mb-4">';
        echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2);">';
        echo '<h3 style="color: #333;">💰 Proxima paga 💰</h3>';
        echo '<p style="color: #666;">Próximo día de paga: 15 de cada mes.</p>';
        echo '<p style="color: #666;">Pais perteneciente: Mexico.</p>';
        echo '<p style="color: #666;">🕒 Hora: 14:00 hrs</p>';
        echo '<hr style="border: 1px solid #ddd;">';
        echo '<h3 style="color: #333;">Tiempo de paga</h3>';
        echo '<p style="color: #666;">Horas restadas: 1:00</p>';
        echo '<p style="color: #666;">Total: 5:00</p>';
        echo '</div>';
        echo '</div>';
        

        // Tarjeta de Ascenso
        echo '<div class="col-12 col-md-4 mb-4">';
        echo '<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0px 5px 10px rgba(0,0,0,0.2);">';
        echo '<h3 style="color: #333;">📈 Ascenso 📈</h3>';
        echo '<p style="color: #666;">Mision actual: AGT- Supervisor G -XDD -SDS #</p>';
        echo '<p style="color: #666;">Proxima mision: AGT- Supervisor D -XDD -SDS #</p>';
        echo '<p style="color: #666;">Tiempo proximado: 2 dias</p>';
        echo '<p style="color: #666;">Estatus: Pendiente</p>';
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Cierre de la fila
        echo '</div>'; // Cierre del contenedor
        echo '</section>';
    }
}

$userProfile = new UserProfile();
$userProfile->render();