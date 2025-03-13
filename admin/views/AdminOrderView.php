<?php
    class AdminOrderView {
        public function index($data = []) {
            $viewFile = './views/order/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/order/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>