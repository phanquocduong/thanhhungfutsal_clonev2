<?php
    class AdminProductVariantsView {
        public function index($data = []) {
            $viewFile = './views/product/variants/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showAdd($data = []) {
            $viewFile = './views/product/variants/add-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/product/variants/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>