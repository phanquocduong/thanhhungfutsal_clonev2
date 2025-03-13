<?php 
    class OrderItemsModel extends Connect {
        private $id;
        private $product_id;
        private $size;
        private $unit_price;
        private $quantity;
        private $order_id;

        public function __construct() {
            parent::__construct();
            if (func_num_args() > 0) {
                $this->id = func_get_arg(0);
                $this->product_id = func_get_arg(1);
                $this->size = func_get_arg(2);
                $this->unit_price = func_get_arg(3);
                $this->quantity = func_get_arg(4);
                $this->order_id = func_get_arg(5);
            }
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getProductId() {
            return $this->product_id;
        }

        public function setProductId($product_id) {
            $this->product_id = $product_id;
        }

        public function getSize() {
            return $this->size;
        }

        public function setSize($size) {
            $this->size = $size;
        }

        public function getUnitPrice() {
            return $this->unit_price;
        }

        public function setUnitPrice($unit_price) {
            $this->unit_price = $unit_price;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;
        }    
        
        public function getOrderItemsById($orderId) {
            $sql = "SELECT order_items.*, products.name AS product_name
                    FROM order_items
                    INNER JOIN products
                    ON order_items.id = products.id 
                    WHERE order_items.order_id = :orderId";
                    
            $params = ['orderId' => $orderId];
            return $this->getAll($sql, $params);
        }

        public function createOrderItems($data) {
            $sql = "INSERT INTO order_items (`order_id`, `product_id`, `size`, `unit_price`, `quantity`) 
                    VALUES (:order_id, :product_id, :size, :unit_price, :quantity)";
            $this->execute($sql, $data);
        }
    }
?>