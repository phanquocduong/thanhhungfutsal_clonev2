<?php
    class AdminProductView {
        public function index($data = []) {
            $viewFile = './views/product/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showAdd($data = []) {
            $viewFile = './views/product/add-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/product/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>