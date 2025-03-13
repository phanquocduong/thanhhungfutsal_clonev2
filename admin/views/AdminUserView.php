<?php
    class AdminUserView {
        public function index($data = []) {
            $viewFile = './views/user/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/user/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>