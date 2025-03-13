<?php
    class ProductView {
        public function detail($data = []) {
            $viewFile = './views/product/detail.php';
            $cssFile = 'product-details.css';
            $jsFile = 'product-details.js';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function collection($data = []) {
            $viewFile = './views/product/collection.php';
            $cssFile = 'collection.css';
            $jsFile = 'collection.js';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
?>