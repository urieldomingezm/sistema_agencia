
<?php
class Footer
{
    private $jsFiles = [];

    public function addJsFile($filePath)
    {
        $this->jsFiles[] = $filePath;
    }

    public function render()
    {
        ?>
        <footer class="custom-footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 text-center">
                        <div class="footer-content">
                            <span class="copyright">
                                &copy; <?= date('Y') ?> Agencia Atenas. Todos los derechos reservados para Ing. Medina
                            </span>
                            <img src="https://www.habbo.es/habbo-imaging/avatarimage?user=goblinslayer88&action=none&direction=0&head_direction=3&gesture=&size=s&headonly=1" 
                                 alt="Medina Avatar" 
                                 class="avatar-image">
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <button id="scrollTopBtn" class="scroll-top-btn" onclick="scrollToTop()">
            <i class="bi bi-arrow-up"></i>
        </button>

        <style>
        .custom-footer {
            background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%);
            color: #000;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .copyright {
            font-weight: 500;
        }

        .avatar-image {
            vertical-align: middle;
            border-radius: 50%;
            border: 2px solid #000;
        }

        .scroll-top-btn {
            position: fixed;
            bottom: 80px;
            right: 20px;
            display: none;
            z-index: 1000;
            background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%);
            border: none;
            color: #000;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .scroll-top-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                gap: 10px;
            }
        }
        </style>

        <script>
        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("scrollTopBtn").style.display = "block";
            } else {
                document.getElementById("scrollTopBtn").style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: "smooth" });
        }
        </script>
        <?php
    }
}

$footer = new Footer();
$footer->render();
?>
