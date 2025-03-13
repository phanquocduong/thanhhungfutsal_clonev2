<?php
    class HomeController {
        private $productService;
        private $categoryService;
        private $newsService;
        private $homeView;

        public function __construct() {
            $this->productService = new ProductService();
            $this->categoryService = new CategoryService();
            $this->newsService = new NewsService();
            $this->homeView = new HomeView();
        }

        public function index() {
            // Sản phẩm mới
            $newProductsFilters = ['status' => 1, 'order' => 'created_at DESC', 'limit' => 4, 'offset' => 0];
            $newProducts = $this->productService->getAllProducts($newProductsFilters);

            // Giày cỏ nhân tạo
            $tfProductsFilters = ['category_id' => 1, 'status' => 1, 'order' => 'created_at DESC', 'limit' => 8, 'offset' => 0];
            $tfProducts = $this->productService->getAllProducts($tfProductsFilters);

            // Giày futsal
            $icProductsFilters = ['category_id' => 2, 'status' => 1, 'order' => 'created_at DESC', 'limit' => 8, 'offset' => 0];
            $icProducts = $this->productService->getAllProducts($icProductsFilters);

            // Sản phẩm hotsale
            $hotSaleProducts = $this->productService->getHotSaleProducts();

            // Danh mục
            $categories = $this->categoryService->getAllCategories(['status' => 1]);

            // Tin tức mới
            $latestNewsListFilters = ['status' => 1, 'order' => 'created_at DESC', 'limit' => 3, 'offset' => 0];
            $latestNewsList = $this->newsService->getAllNews($latestNewsListFilters);

            $data = [
                        'newProducts' => $newProducts, 
                        'tfProducts' => $tfProducts, 
                        'icProducts' => $icProducts, 
                        'hotSaleProducts' => $hotSaleProducts,
                        'categories' => $categories,
                        'latestNewsList' => $latestNewsList
                    ];

            $this->homeView->index($data);
        }

        public function about() {
           $this->homeView->about();
        }
    }
?>