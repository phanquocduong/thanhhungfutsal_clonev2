<?php
    class CartView {
        public function index($data = []) {
            $viewFile = './views/cart/index.php';
            $cssFile = 'cart.css';
            $jsFile = 'cart.js';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>