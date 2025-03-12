    <?php
    class RadioPlayer
    {
        private $streamURL;
        private $djName;

        public function __construct($streamURL, $djName = "DJ Desconocido")
        {
            $this->streamURL = $streamURL;
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
            echo '<script>
                    var radio = document.getElementById("radio");
                    var playButton = document.getElementById("playButton");
                    var pauseButton = document.getElementById("pauseButton");
                    var muteButton = document.getElementById("muteButton");

                    // Función para reproducir la radio
                    function playRadio() {
                        radio.play();
                        playButton.disabled = true; // Desactiva el botón de Play
                        pauseButton.disabled = false; // Activa el botón de Pause
                    }

                    // Función para pausar la radio
                    function pauseRadio() {
                        radio.pause();
                        playButton.disabled = false; // Activa el botón de Play
                        pauseButton.disabled = true; // Desactiva el botón de Pause
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
                            radio.volume -= 0.1; // Disminuye el volumen en 10%
                        }
                        updateVolumeIcon();
                    }

                    // Función para subir el volumen
                    function volumeUp() {
                        if (radio.volume < 1) {
                            radio.volume += 0.1; // Aumenta el volumen en 10%
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

    // Uso del reproductor con una URL de prueba
    $radio = new RadioPlayer("https://radionoyabrsk.ru:8443", " DJ Nocturno");
    $radio->render();
    ?>