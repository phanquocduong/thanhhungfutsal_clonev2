<?php
    class AdminCategoryView {
        public function index($data = []) {
            $viewFile = './views/category/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showAdd() {
            $viewFile = './views/category/add-form.php';
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/category/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>