<?php
    class UserView {
        public function login() {
            $viewFile = './views/user/auth/login.php';
            $cssFile = 'login.css';
            $jsFile = 'login.js';
            require_once './views/layouts/template.php';
        }

        public function register() {
            $viewFile = './views/user/auth/register.php';
            $cssFile = 'register.css';
            $jsFile = 'register.js';
            require_once './views/layouts/template.php';
        }
    }
    
?>