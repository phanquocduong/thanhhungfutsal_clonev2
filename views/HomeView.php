<?php
    class HomeView {
        public function index($data = []) {
            $viewFile = './views/home/index.php';
            $cssFile = 'home.css';
            $jsFile = 'home.js';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function about() {
            $viewFile = './views/home/about.php';
            $cssFile = 'about.css';
            require_once './views/layouts/template.php';
        }
    }
    
?>