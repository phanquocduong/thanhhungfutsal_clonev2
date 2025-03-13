<?php
    class AdminVoucherView {
        public function index($data = []) {
            $viewFile = './views/voucher/index.php';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showAdd() {
            $viewFile = './views/voucher/add-form.php';
            require_once './views/layouts/template.php';
        }

        public function showEdit($data = []) {
            $viewFile = './views/voucher/edit-form.php';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>