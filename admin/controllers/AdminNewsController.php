<?php
    class AdminNewsController {
        private $newsService;
        private $adminNewsView;

        public function __construct() {
            $this->newsService = new NewsService();
            $this->adminNewsView = new AdminNewsView();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 10;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $newsList = $this->newsService->getAllNews($filters);
            $totalNews = count($this->newsService->getAllNews());
            $totalPages = ceil($totalNews / $limit);

            $data = [ 
                'newsList' => $newsList,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];

            $this->adminNewsView->index($data);
        }

        public function showAdd() {
            $this->adminNewsView->showAdd();
        }

        public function showEdit($id) {
            $news = $this->newsService->getNewsById($id);
            if (!$news) {
                http_response_code(404);
                echo "Tin tức không tồn tại.";
                return;
            }
            $data = [ 'news' => $news ];

            $this->adminNewsView->showEdit($data);
        }

        public function handleAdd() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_FILES['thumbnail']['name']) || empty($_POST['title']) || empty($_POST['content'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $thumbnail_file = $_FILES['thumbnail'];
                    $title = trim($_POST['title']);
                    $content = trim($_POST['content']);
                    $status = $_POST['status'] ?? 1;

                    // Gọi service để thêm tin tức
                    $this->newsService->addNews($thumbnail_file, $title, $content, $status);

                    $_SESSION['message'] = "Thêm tin tức thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/news");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/news/add");
                    exit();
                }
            }
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['title']) || empty($_POST['content'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $thumbnail_file = $_FILES['thumbnail']['name'] ? $_FILES['thumbnail'] : null;
                    $title = trim($_POST['title']);
                    $content = trim($_POST['content']);
                    $status = $_POST['status'] ?? 1;

                    $this->newsService->editNews($id, $thumbnail_file, $title, $content, $status);

                    $_SESSION['message'] = "Cập nhật tin tức thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/news");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/news/edit/' . $id . '");
                    exit();
                }
            }
        }

        public function handleDelete($id) {
            try {
                // Kiểm tra mã tin tức hợp lệ
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("Mã tin tức không hợp lệ.");
                }

                // Xóa tin tức
                if (!$this->newsService->deleteNews($id)) {
                    throw new Exception("Xóa tin tức thất bại.");
                }

                $_SESSION['message'] = "Xóa tin tức thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: /thanhhungfutsal_v2/admin/news");
            exit();
        }
    }
?>