<?php
    class AdminProductController {
        private $productService;
        private $adminProductView;
        private $categoryService;

        public function __construct() {
            $this->productService = new ProductService();
            $this->adminProductView = new AdminProductView();
            $this->categoryService = new CategoryService();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $products = $this->productService->getAllProducts($filters);
            $totalProducts = $this->productService->getTotalProducts();
            $totalPages = ceil($totalProducts / $limit);

            $data = [
                'products' => $products,
                'totalPages' => $totalPages,
                'currentPage' => $page,
            ];

            $this->adminProductView->index($data);
        }

        public function showAdd() {
            $categories = $this->categoryService->getAllCategories();
            $data = [ 'categories' => $categories ];

            $this->adminProductView->showAdd($data);
        }

        public function showEdit($id) {
            $product = $this->productService->getProductById($id);
            if (!$product) {
                http_response_code(404);
                echo "Sản phẩm không tồn tại.";
                return;
            }
            $categories = $this->categoryService->getAllCategories();

            $data = [ 'product' => $product, 'categories' => $categories ];

            $this->adminProductView->showEdit($data);
        }

        public function handleAdd() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['name']) || empty($_POST['price']) || empty($_FILES['image']['name'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $name = trim($_POST['name']);
                    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
                    $sale = $_POST['sale'] ? filter_var($_POST['sale'], FILTER_VALIDATE_INT) : null;
                    $description = $_POST['description'] ? trim($_POST['description']) : null;
                    $status = $_POST['status'] ?? 1;
                    $sold = $_POST['sold'] ?? 0;
                    $category_id = $_POST['category_id'] ?? null;

                    // Kiểm tra số hợp lệ
                    if ($price === false || $price < 0) {
                        throw new Exception("Giá gốc không hợp lệ.");
                    }
                    if ($sale === false || $sale < 0 || $sale >= $price) {
                        throw new Exception("Giá sau khi giảm không hợp lệ.");
                    }

                    // Kiểm tra danh mục hợp lệ
                    if (empty($category_id) || $category_id <= 0) {
                        throw new Exception("Danh mục không hợp lệ.");
                    }

                    $image_file = $_FILES['image'];
                    $extra_image_files = $_FILES['extra_images']['name'][0] ? $_FILES['extra_images'] : null;

                    // Gọi Service để thêm sản phẩm
                    $this->productService->addProduct($name, $price, $sale, $image_file, $extra_image_files, $description, $status, $sold, $category_id);
        
                    $_SESSION['message'] = "Thêm sản phẩm thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/products");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/products/add");
                    exit();
                }
            }
        }          

    
        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['name']) || empty($_POST['price'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $name = trim($_POST['name']);
                    $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
                    $sale = $_POST['sale'] ? filter_var($_POST['sale'], FILTER_VALIDATE_INT) : null;
                    $description = $_POST['description'] ? trim($_POST['description']) : null;
                    $status = $_POST['status'] ?? 1;
                    $sold = $_POST['sold'] ?? 0;
                    $category_id = $_POST['category_id'] ?? null;

                    // Kiểm tra số hợp lệ
                    if ($price === false || $price < 0) {
                        throw new Exception("Giá gốc không hợp lệ.");
                    }
                    if ($sale === false || $sale < 0 || $sale >= $price) {
                        throw new Exception("Giá sau khi giảm không hợp lệ.");
                    }

                    // Kiểm tra danh mục hợp lệ
                    if (empty($category_id) || $category_id <= 0) {
                        throw new Exception("Danh mục không hợp lệ.");
                    }

                    $image_file = $_FILES['image']['name'] ? $_FILES['image'] : null;
                    $extra_image_files = $_FILES['extra_images']['name'][0] ? $_FILES['extra_images'] : null;

                    $this->productService->editProduct($id, $name, $price, $sale, $image_file, $extra_image_files, $description, $status, $sold, $category_id);
    
                    $_SESSION['message'] = "Cập nhật sản phẩm thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/products");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/products/edit/' . $id . '");
                    exit();
                }
            }
        }

        public function handleDelete($id) {
            try {
                // Kiểm tra mã sản phẩm hợp lệ
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("Mã sản phẩm không hợp lệ.");
                }

                // Xóa sản phẩm
                if (!$this->productService->deleteProduct($id)) {
                    throw new Exception("Xóa sản phẩm thất bại.");
                }

                $_SESSION['message'] = "Xóa sản phẩm thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: /thanhhungfutsal_v2/admin/products");
            exit();
        }
        
    }
?>