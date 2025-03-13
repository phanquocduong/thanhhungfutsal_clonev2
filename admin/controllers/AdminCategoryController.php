<?php
    class AdminCategoryController {
        private $categoryService;
        private $adminCategoryView;
        private $productService;

        public function __construct() {
            $this->categoryService = new CategoryService();
            $this->adminCategoryView = new AdminCategoryView();
            $this->productService = new ProductService();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $categories = $this->categoryService->getAllCategories($filters);
            $totalCategories = $this->categoryService->getTotalCategories();
            $totalPages = ceil($totalCategories / $limit);

            $data = [ 
                'categories' => $categories,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];

            $this->adminCategoryView->index($data);
        }

        public function showAdd() {
            $this->adminCategoryView->showAdd();
        }

        public function showEdit($id) {
            $category = $this->categoryService->getCategoryById($id);
            if (!$category) {
                http_response_code(404);
                echo "Danh mục không tồn tại.";
                return;
            }
            $data = [ 'category' => $category ];

            $this->adminCategoryView->showEdit($data);
        }

        public function handleAdd() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['name'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $name = trim($_POST['name']);
                    $image_file = $_FILES['image']['name'] ? $_FILES['image'] : null;
                    $description = $_POST['description'] ? trim($_POST['description']) : null;
                    $status = $_POST['status'] ?? 1;

                    // Gọi service để thêm danh mục
                    $this->categoryService->addCategory($name, $image_file, $description, $status);

                    $_SESSION['message'] = "Thêm danh mục thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/categories");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/categories/add");
                    exit();
                }
            }
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['name'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $name = trim($_POST['name']);
                    $image_file = $_FILES['image']['name'] ? $_FILES['image'] : null;
                    $description = $_POST['description'] ? trim($_POST['description']) : null;
                    $status = $_POST['status'] ?? 1;

                    // Gọi service để thêm danh mục
                    $this->categoryService->editCategory($id, $name, $image_file, $description, $status);

                    $_SESSION['message'] = "Cập nhật danh mục thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/categories");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/categories/edit/' . $id . '");
                    exit();
                }
            }
        }

        public function handleDelete($id) {
            try {
                // Kiểm tra mã danh mục hợp lệ
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("Mã danh mục không hợp lệ.");
                }

                // Kiểm tra xem danh mục có sản phẩm không
                if ($this->productService->getTotalProducts(['category_id' => $id]) > 0) {
                    throw new Exception("Không thể xóa danh mục vì vẫn còn sản phẩm liên quan.");
                }
                
                // Xóa danh mục
                if (!$this->categoryService->deleteCategory($id)) {
                    throw new Exception("Xóa danh mục thất bại.");
                }

                $_SESSION['message'] = "Xóa danh mục thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: /thanhhungfutsal_v2/admin/categories");
            exit();
        }
    }
?>