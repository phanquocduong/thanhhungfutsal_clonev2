<?php
    class ContactView {
        public function index() {
            $viewFile = './views/contact/index.php';
            $cssFile = 'contact.css';
            $jsFile = 'contact.js';
            require_once './views/layouts/template.php';
        }
    }
    
?>