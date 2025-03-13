<?php
    class NewsView {
        public function detail($data = []) {
            $viewFile = './views/news/detail.php';
            $cssFile = 'news-details.css';
            extract($data);
            require_once './views/layouts/template.php';
        }

        public function showList($data = []) {
            $viewFile = './views/news/list.php';
            $cssFile = 'news.css';
            extract($data);
            require_once './views/layouts/template.php';
        }
    }
    
?>