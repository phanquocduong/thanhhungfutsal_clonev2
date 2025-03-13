<?php
    class ProductController {
        private $productService;
        private $categoryService;
        private $productView;

        public function __construct() {
            $this->productService = new ProductService();
            $this->categoryService = new CategoryService();
            $this->productView = new ProductView();
        }

        public function collection($category_id = null) {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 21;
            $offset = ($page - 1) * $limit;

            $filters = [
                'status' => 1,
                'order' => 'created_at DESC',
                'limit' => $limit,
                'offset' => $offset,
            ];
            $parentFilters = [
                'status' => 1
            ];
            if ($category_id !== null) {
                $filters['category_id'] = $category_id;
                $parentFilters['category_id'] = $category_id;
                $category = $this->categoryService->getCategoryById($category_id, 1);
            }
            
            $products = $this->productService->getAllProducts($filters);
            $totalProducts = count($this->productService->getAllProducts($parentFilters));
            $totalPages = ceil($totalProducts / $limit);

            $data = [
                'products' => $products,
                'totalPages' => $totalPages,
                'currentPage' => $page,
            ];
            if (isset($category)) {
                $data['category'] = $category;
            }

            $this->productView->collection($data);            
        }

        public function detail($id) {
            $product = $this->productService->getProductById($id, 1);
            if (!$product) {
                http_response_code(404);
                echo "Sản phẩm không tồn tại.";
                return;
            }

            $relatedProducts = $this->productService->getRelatedProducts($id, $product->getCategoryId());

            $data = ['product' => $product, 'relatedProducts' => $relatedProducts];

            $this->productView->detail($data);
        }
    }
?>