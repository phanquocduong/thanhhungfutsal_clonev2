<?php 
    class ProductVariantsModel extends Connect {
        private $id;
        private $product_id;
        private $size;
        private $stock_quantity;

        public function __construct() {
            parent::__construct();
            if (func_num_args() > 0) {
                $this->id = func_get_arg(0);
                $this->product_id = func_get_arg(1);
                $this->size = func_get_arg(2);
                $this->stock_quantity = func_get_arg(3);
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

        public function getStockQuantity() {
            return $this->stock_quantity;
        }

        public function setStockQuantity($stock_quantity) {
            $this->stock_quantity = $stock_quantity;
        }

        public function getSizesByProductId($productId) {
            $sql = "SELECT * FROM product_variants WHERE product_id = :product_id AND stock_quantity > 0";
        
            $params = ['product_id' => $productId];
        
            return $this->getAll($sql, $params);
        }        

        public function getAllProductsVariants($filters = []) {
            $sql = "SELECT * FROM product_variants WHERE 1=1";
            $params = [];

            if (isset($filters['product_id'])) {
                $sql .= " AND product_id = :product_id";
                $params['product_id'] = $filters['product_id'];
            }

            if (isset($filters['limit']) && isset($filters['offset'])) {
                $sql .= " LIMIT " . $filters['offset'] . ", " . $filters['limit'];
            }

            return $this->getAll($sql, $params);
        }      

        public function getProductVariantById($id) {
            $sql = "SELECT * FROM product_variants WHERE id = :id";
            $params = ['id' => $id];

            return $this->get($sql, $params);
        }

        public function insertProductVariant($data) {
            $sql = "INSERT INTO product_variants (size, stock_quantity, product_id) 
                    VALUES (:size, :stock_quantity, :product_id)";
        
            return $this->execute($sql, $data);
        }   

        public function updateProductVariant($id, $data) {
            $sql = "UPDATE product_variants 
                    SET size = :size, stock_quantity = :stock_quantity, product_id = :product_id
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }

        public function deleteProductVariantById($id) {
            $sql = "DELETE FROM product_variants WHERE id = :id";
            $params = ['id' => $id];
            return $this->execute($sql, $params)->rowCount() > 0;
        }        

        public function reduceStock($quantity, $size, $product_id) {
            $sql = "UPDATE product_variants SET stock_quantity = stock_quantity - :quantity WHERE size = :size AND product_id = :product_id";
            $params = [
                'quantity' => $quantity,
                'size' => $size,
                'product_id' => $product_id
            ];
            return $this->execute($sql, $params);
        }
    }
?>