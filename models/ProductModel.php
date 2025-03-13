<?php
    class ProductModel extends Connect {
        private $id;
        private $name;
        private $price;
        private $sale;
        private $image;
        private $extra_images;
        private $description;
        private $status;
        private $sold;
        private $created_at;
        private $category_id;

        public function __construct(
            $id = null,
            $name = null,
            $price = null,
            $sale = null,
            $image = null,
            $extra_images = null,
            $description = null,
            $status = null,
            $sold = null,
            $created_at = null,
            $category_id = null
        ) {
            parent::__construct();
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->sale = $sale;
            $this->image = $image;
            $this->extra_images = $extra_images;
            $this->description = $description;
            $this->status = $status;
            $this->sold = $sold;
            $this->created_at = $created_at;
            $this->category_id = $category_id;
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getPrice() { return $this->price; }
        public function getSale() { return $this->sale; }

        public function getPercentDiscount() {
            return round(($this->price - $this->sale) / $this->price * 100);
        }

        public function getEconomicalPrice() {
            return $this->price - $this->sale;
        }

        public function getImage() { return $this->image; }

        public function getExtraImages() {
            return $this->extra_images ? explode(",", $this->extra_images) : [];
        }

        public function getDescription() { return $this->description; }
        public function getStatus() { return $this->status; }
        public function getSold() { return $this->sold; }
        public function getCreatedAt() { return $this->created_at; }
        public function getCategoryId() { return $this->category_id; }

        public function getAllProducts($filters = []) {
            $sql = "SELECT * FROM products WHERE 1=1";
            $params = [];
        
            if (isset($filters['category_id'])) {
                $sql .= " AND category_id = :category_id";
                $params['category_id'] = $filters['category_id'];
            }

            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }
        
            if (isset($filters['order'])) {
                $sql .= " ORDER BY " . $filters['order'];
            }
        
            if (isset($filters['limit']) && isset($filters['offset'])) {
                $sql .= " LIMIT " . $filters['offset'] . ", " . $filters['limit'];
            }
        
            return $this->getAll($sql, $params);
        }

        public function getTotalProducts($filters = []) {
            $sql = "SELECT COUNT(*) as total FROM products WHERE 1=1";
            $params = [];

            if (isset($filters['category_id'])) {
                $sql .= " AND category_id = :category_id";
                $params['category_id'] = $filters['category_id'];
            }

            $result = $this->get($sql, $params);
            return $result ? $result['total'] : 0;
        }
        

        public function getHotSaleProducts() {
            $sql = "SELECT *, 
                        ROUND((price - sale) / price * 100) AS percent_discount 
                    FROM products 
                    WHERE sale IS NOT NULL AND status = 1
                    ORDER BY percent_discount DESC 
                    LIMIT 8";
            return $this->getAll($sql);
        }
        
        public function getProductById($id, $status = null) {
            $sql = "SELECT 
                        products.*, 
                        categories.name AS category_name 
                    FROM 
                        products 
                    INNER JOIN 
                        categories 
                    ON 
                        products.category_id = categories.id 
                    WHERE 
                        products.id = :id";

            $params = ['id' => $id];

            if ($status !== null) {
                $sql .= " AND products.status = :status";
                $params['status'] = $status;
            }

            return $this->get($sql, $params);
        }     

        public function getRelatedProducts($id, $category_id) {
            $sql = "SELECT * FROM products WHERE category_id = :category_id AND id != :id AND status = 1 ORDER BY created_at DESC LIMIT 4";
            $params = ['category_id' => $category_id, 'id' => $id];
            return $this->getAll($sql, $params);
        }

        public function insertProduct($data) {
            $sql = "INSERT INTO products (name, price, sale, image, extra_images, description, status, sold, category_id) 
                    VALUES (:name, :price, :sale, :image, :extra_images, :description, :status, :sold, :category_id)";
        
            return $this->execute($sql, $data);
        }     

        public function updateProduct($id, $data) {
            $sql = "UPDATE products 
                    SET name = :name, price = :price, sale = :sale, image = :image, 
                        extra_images = :extra_images, description = :description, 
                        status = :status, sold = :sold, category_id = :category_id 
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }        

        public function deleteProductById($id) {
            $sql = "SELECT image, extra_images FROM products WHERE id = :id";
            $params = ['id' => $id];
            $product = $this->get($sql, $params);
        
            if ($product) {
                $this->deleteImages($product);
            }
        
            $sql = "DELETE FROM products WHERE id = :id";
            return $this->execute($sql, $params)->rowCount() > 0;
        }
        
        private function deleteImages($product) {
            $basePath = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/products/";
        
            if (!empty($product['image'])) {
                $imagePath = $basePath . $product['image'];
                if (file_exists($imagePath) && !unlink($imagePath)) {
                    throw new Exception("Không thể xóa ảnh chính của sản phẩm.");
                }
            }
        
            if (!empty($product['extra_images'])) {
                foreach (explode(",", $product['extra_images']) as $extraImage) {
                    $extraImagePath = $basePath . trim($extraImage);
                    if (file_exists($extraImagePath) && !unlink($extraImagePath)) {
                        throw new Exception("Không thể xóa ảnh phụ: $extraImage");
                    }
                }
            }
        }
        
        public function increaseSold($id, $quantity) {
            $sql = "UPDATE products SET sold = sold + :quantity WHERE id = :id AND status = 1";
            $params = ['quantity' => $quantity, 'id' => $id];
            
            return $this->execute($sql, $params);
        }
    }
?>