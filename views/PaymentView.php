<?php
    class PaymentView {
        public function index($data = []) {
            $viewFile = './views/payment/index.php';
            $cssFile = 'payment.css';
            $jsFile = 'payment.js';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>