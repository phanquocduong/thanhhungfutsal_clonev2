<?php
    class NewsController {
        private $newsService;
        private $newsView;

        public function __construct() {
            $this->newsService = new NewsService();
            $this->newsView = new NewsView();
        }

        public function showList() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 8;
            $offset = ($page - 1) * $limit;

            $filters = [
                'status' => 1,
                'order' => 'created_at DESC',
                'limit' => $limit,
                'offset' => $offset,
            ];

            $newsList = $this->newsService->getAllNews($filters);
            $totalNews = count($this->newsService->getAllNews(['status' => 1]));
            $totalPages = ceil($totalNews / $limit);

            $data = [
                'newsList' => $newsList,
                'totalPages' => $totalPages,
                'currentPage' => $page,
            ];

            $this->newsView->showList($data);
        }

        public function detail($id) {
            $news = $this->newsService->getNewsById($id, 1);
            if (!$news) {
                http_response_code(404);
                echo "Bài viết không tồn tại.";
                return;
            }

            $data = ['news' => $news];

            $this->newsView->detail($data);
        }
    }
?>