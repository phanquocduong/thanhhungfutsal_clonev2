<?php
    class CartController {
        private $cartView;
        private $cartService;
        private $productService;

        public function __construct() {
            $this->cartView = new CartView();
            $this->cartService = new CartService();
            $this->productService = new ProductService();
        }

        public function index() {
            $grand_total = $this->cartService->calculateGrandTotal();
            $data = [ 'grand_total' => $grand_total ];
            
            $this->cartView->index($data);
        }

        public function handleAddToCart() {
            $product_data = json_decode(file_get_contents('php://input'), true);
            
            $product = $this->productService->getProductById($product_data['id'], 1);
            $size = $product_data['size'];
            $quantity = $product_data['quantity'];

            $cartQuantity = $this->cartService->addToCart($product, $size, $quantity);

            echo json_encode(['success' => true, 'cartQuantity' => $cartQuantity]);
        }

        public function handleUpdateCart() {
            $product_data = json_decode(file_get_contents('php://input'), true);
            $index = $product_data['index'];
            $quantity = $product_data['quantity'];

            $this->cartService->updateCart($index, $quantity);
        }

        public function handleDeleteCart($index) {
            if (isset($_SESSION['cart'][$index])) {
                unset($_SESSION['cart'][$index]);
            }
            header("Location: /thanhhungfutsal_v2/cart");
            exit();
        }
    }
?>