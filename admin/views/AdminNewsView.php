<?php
    class AdminNewsView {
        public function index($data = []) {
            $viewFile = './views/news/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showAdd() {
            $viewFile = './views/news/add-form.php';
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/news/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>