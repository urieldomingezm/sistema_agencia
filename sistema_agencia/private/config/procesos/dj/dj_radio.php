<?php
class RadioPlayer
{
    private $streamURL;
    private $djName;
    private $localMusicPath;

    public function __construct($streamURL, $localMusicPath, $djName = "DJ Desconocido")
    {
        $this->streamURL = $streamURL;
        $this->localMusicPath = $localMusicPath;
        $this->djName = $djName;
    }

    public function render()
    {
        echo '<div class="radio-container text-center">';
        echo '    <img src="/public/custom/custom_radio/img/dj.jpg" class="radio-cover" alt="Radio Cover">';
        echo '    <div class="radio-info">';
        echo '        <p class="dj-label">DJ: <span>' . htmlspecialchars($this->djName) . '</span></p>';
        echo '    </div>';
        echo '    <audio id="radio" src="' . htmlspecialchars($this->streamURL) . '" preload="none"></audio>';
        echo '    <div class="radio-controls">';
        echo '        <button id="playButton" class="btn btn-danger" onclick="playRadio()"><i class="bi bi-play-fill"></i></button>';
        echo '        <button id="pauseButton" class="btn btn-danger" onclick="pauseRadio()" disabled><i class="bi bi-pause-fill"></i></button>';
        echo '        <button id="muteButton" class="btn btn-danger" onclick="toggleMute()"><i class="bi bi-volume-up-fill"></i></button>';
        echo '        <button id="volumeDownButton" class="btn btn-danger" onclick="volumeDown()"><i class="bi bi-volume-down-fill"></i></button>';
        echo '        <button id="volumeUpButton" class="btn btn-danger" onclick="volumeUp()"><i class="bi bi-volume-up-fill"></i></button>';
        echo '    </div>';
        echo '</div>';

        $this->renderStyles();
        $this->renderScripts();
    }

    private function renderStyles()
    {
        // Cargar el archivo CSS desde una ubicación externa
        $cssPath = CUSTOM_RADIO_CSS_PATH . 'style.css';
        if (file_exists($cssPath)) {
            echo '<style>' . file_get_contents($cssPath) . '</style>';
        }
    }

    private function renderScripts()
    {
        // Escanear la carpeta 'public/music/' para obtener los archivos de música
        $musicFiles = glob($_SERVER['DOCUMENT_ROOT'] . '/public/music/*.mp3');
        
        // Verificar si hay archivos disponibles
        if (count($musicFiles) > 0) {
            // Seleccionar un archivo aleatorio
            $randomMusicFile = $musicFiles[array_rand($musicFiles)];
        } else {
            // Si no hay archivos, podemos mostrar un mensaje o usar un archivo por defecto
            $randomMusicFile = '/public/music/505.mp3'; // Archivo por defecto si no hay música
        }

        echo '<script>
                var radio = document.getElementById("radio");
                var playButton = document.getElementById("playButton");
                var pauseButton = document.getElementById("pauseButton");
                var muteButton = document.getElementById("muteButton");
                var radioCover = document.querySelector(".radio-cover"); // Selecciona la imagen

                var streamURL = "' . $this->streamURL . '";
                var localMusicPath = "' . $randomMusicFile . '"; // Ruta de la música aleatoria

                // Función para reproducir la radio
                function playRadio() {
                    // Inicia la reproducción de la radio
                    radio.src = streamURL;
                    radio.play();

                    // Activar la animación de giro
                    radioCover.classList.add("playing");

                    // Desactiva el botón de Play y activa el de Pause
                    playButton.disabled = true;
                    pauseButton.disabled = false;
                }

                // Función para pausar la radio
                function pauseRadio() {
                    radio.pause();

                    // Desactivar la animación de giro
                    radioCover.classList.remove("playing");

                    playButton.disabled = false;
                    pauseButton.disabled = true;
                }

                // Función para silenciar o activar el sonido
                function toggleMute() {
                    radio.muted = !radio.muted;
                    var volumeIcon = muteButton.querySelector("i");
                    if (radio.muted) {
                        volumeIcon.classList.replace("bi-volume-up-fill", "bi-volume-mute-fill");
                    } else {
                        volumeIcon.classList.replace("bi-volume-mute-fill", "bi-volume-up-fill");
                    }
                }

                // Función para bajar el volumen
                function volumeDown() {
                    if (radio.volume > 0) {
                        radio.volume -= 0.1;
                    }
                    updateVolumeIcon();
                }

                // Función para subir el volumen
                function volumeUp() {
                    if (radio.volume < 1) {
                        radio.volume += 0.1;
                    }
                    updateVolumeIcon();
                }

                // Función para actualizar el ícono del volumen
                function updateVolumeIcon() {
                    var volumeIcon = muteButton.querySelector("i");
                    if (radio.muted || radio.volume === 0) {
                        volumeIcon.classList.replace("bi-volume-up-fill", "bi-volume-mute-fill");
                    } else if (radio.volume < 0.5) {
                        volumeIcon.classList.replace("bi-volume-up-fill", "bi-volume-down-fill");
                    } else {
                        volumeIcon.classList.replace("bi-volume-down-fill", "bi-volume-up-fill");
                    }
                }

                // Detectar error de la radio (si no está disponible)
                radio.onerror = function() {
                    console.log("Radio no disponible, cambiando a música local...");
                    radio.src = localMusicPath; // Cambia a música local
                    radio.play();

                    // Activar la animación de giro
                    radioCover.classList.add("playing");
                };

                // Actualizar el estado de los botones cuando la radio se reproduce o se pausa automáticamente
                radio.addEventListener("play", function() {
                    playButton.disabled = true;
                    pauseButton.disabled = false;
                });

                radio.addEventListener("pause", function() {
                    playButton.disabled = false;
                    pauseButton.disabled = true;
                });

                // Actualizar el ícono del volumen cuando cambia el volumen
                radio.addEventListener("volumechange", function() {
                    updateVolumeIcon();
                });
            </script>';
    }
}

$radio = new RadioPlayer("https://radionoyabrsk.ru:8443", "/public/music/505.mp3", " DJ Nocturno");
$radio->render();
?>
