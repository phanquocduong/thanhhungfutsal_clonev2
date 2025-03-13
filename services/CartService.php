<?php
    class CartService {
        private $productService;

        public function __construct() {
            $this->productService = new ProductService();
        }

        public function addToCart($product, $size, $quantity) {
            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $found = false;

            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['id'] == $product->getId() && $item['size'] == $size) {
                    $_SESSION['cart'][$index]['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getSale() ?? $product->getPrice(),
                    'image' => $product->getImage(),
                    'size' => $size,
                    'quantity' => $quantity,
                ];
            }

            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));
            return $cartQuantity;
        }

        public function calculateGrandTotal() {
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $grand_total = 0;
                foreach ($_SESSION['cart'] as $index => $item) {
                    $line_total = $item['price'] * $item['quantity'];
                    $grand_total += $line_total;
                }
                return $grand_total;
            }

            return null;
        }

        public function updateCart($index, $quantity) {
            if ($quantity > 0 && isset($_SESSION['cart'][$index])) {
                $_SESSION['cart'][$index]['quantity'] = $quantity;
            }

            $cart = $_SESSION['cart'];

            $lineTotal = $cart[$index]['quantity'] * $cart[$index]['price'];

            $grandTotal = array_reduce($cart, function($total, $item) {
                return $total + ($item['quantity'] * $item['price']);
            }, 0);

            $cartQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));

            echo json_encode([
                'lineTotal' => $lineTotal,
                'grandTotal' => $grandTotal,
                'cartQuantity' => $cartQuantity
            ]);
        }
    }
?>
