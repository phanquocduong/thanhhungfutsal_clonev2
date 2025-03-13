<?php
    class AdminProductVariantsController {
        private $productVariantsService;
        private $adminProductVariantsView;
        private $productService;

        public function __construct() {
            $this->productVariantsService = new ProductVariantsService();
            $this->adminProductVariantsView = new AdminProductVariantsView();
            $this->productService = new ProductService();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 40;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $productsVariants= $this->productVariantsService->getAllProductsVariants($filters);
            $totalProductVariants = count($this->productVariantsService->getAllProductsVariants());
            $totalPages = ceil($totalProductVariants / $limit);

            $data = [ 
                'productsVariants' => $productsVariants,
                'totalPages' => $totalPages,
                'currentPage' => $page 
            ];

            $this->adminProductVariantsView->index($data);
        }

        public function showAdd() {
            $products = $this->productService->getAllProducts();
            $data = [ 'products' => $products ];
            $this->adminProductVariantsView->showAdd($data);
        }

        public function showEdit($id) {
            $productVariant = $this->productVariantsService->getProductVariantById($id);
            if (!$productVariant) {
                http_response_code(404);
                echo "Biến thể sản phẩm không tồn tại.";
                return;
            }
            $products = $this->productService->getAllProducts();
            $data = [ 'products' => $products, 'productVariant' => $productVariant ];

            $this->adminProductVariantsView->showEdit($data);
        }

        public function handleAdd() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['size']) || empty($_POST['stock_quantity'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $size = trim($_POST['size']);
                    $stock_quantity = filter_var($_POST['stock_quantity'], FILTER_VALIDATE_INT);
                    $product_id = $_POST['product_id'] ?? null;

                    // Kiểm tra số hợp lệ
                    if ($stock_quantity === false || $stock_quantity < 0) {
                        throw new Exception("Số lượng hàng tồn kho không hợp lệ.");
                    }

                    // Kiểm tra sản phẩm hợp lệ
                    if (empty($product_id) || $product_id <= 0) {
                        throw new Exception("Sản phẩm không hợp lệ.");
                    }

                    // Gọi service để thêm biến thể sản phẩm
                    $this->productVariantsService->addProductVariant($size, $stock_quantity, $product_id);

                    $_SESSION['message'] = "Thêm biến thể sản phẩm thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/products/variants");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/products/variants/add");
                    exit();
                }
            }
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    // Kiểm tra dữ liệu có tồn tại không
                    if (empty($_POST['size']) || empty($_POST['stock_quantity'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $size = trim($_POST['size']);
                    $stock_quantity = filter_var($_POST['stock_quantity'], FILTER_VALIDATE_INT);
                    $product_id = $_POST['product_id'] ?? null;

                    // Kiểm tra số hợp lệ
                    if ($stock_quantity === false || $stock_quantity < 0) {
                        throw new Exception("Số lượng hàng tồn kho không hợp lệ.");
                    }

                    // Kiểm tra sản phẩm hợp lệ
                    if (empty($product_id) || $product_id <= 0) {
                        throw new Exception("Sản phẩm không hợp lệ.");
                    }

                    // Gọi service để chỉnh sửa biến thể sản phẩm
                    $this->productVariantsService->editProductVariant($id, $size, $stock_quantity, $product_id);

                    $_SESSION['message'] = "Cập nhật biến thể sản phẩm thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/products/variants");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/products/variants/edit/' . $id . '");
                    exit();
                }
            }
        }

        public function handleDelete($id) {
            try {
                // Kiểm tra mã biến thể sản phẩm hợp lệ
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("Mã biến thể sản phẩm không hợp lệ.");
                }

                // Xóa biến thể sản phẩm
                if (!$this->productVariantsService->deleteProductVariant($id)) {
                    throw new Exception("Xóa biến thể sản phẩm thất bại.");
                }

                $_SESSION['message'] = "Xóa biến thể sản phẩm thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: /thanhhungfutsal_v2/admin/products/variants");
            exit();
        }
    }
?>