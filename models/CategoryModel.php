<?php 
    class CategoryModel extends Connect {
        private $id;
        private $name;
        private $image;
        private $description;
        private $status;

        public function __construct($id = null, $name = null, $image = null, $description = null, $status = null) {
            parent::__construct();
            $this->id = $id;
            $this->name = $name;
            $this->image = $image;
            $this->description = $description;
            $this->status = $status;
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getImage() { return $this->image; }
        public function getDescription() { return $this->description; }
        public function getStatus() { return $this->status; }

        public function getAllCategories($filters = []) {
            $sql = "SELECT * FROM categories WHERE 1=1";
            $params = [];

            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }

            if (isset($filters['limit']) && isset($filters['offset'])) {
                $sql .= " LIMIT " . $filters['offset'] . ", " . $filters['limit'];
            }

            return $this->getAll($sql, $params);
        }      

        public function getTotalCategories() {
            $sql = "SELECT COUNT(*) as total FROM categories";
            $result = $this->get($sql);
            return $result ? $result['total'] : 0;
        }     
        
        public function getCategoryById($id, $status = null) {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $params = ['id' => $id];

            if ($status !== null) {
                $sql .= " AND status = :status";
                $params['status'] = $status;
            }

            return $this->get($sql, $params);
        }

        public function insertCategory($data) {
            $sql = "INSERT INTO categories (name, image, description, status) 
                    VALUES (:name, :image, :description, :status)";
        
            return $this->execute($sql, $data);
        }     

        public function updateCategory($id, $data) {
            $sql = "UPDATE categories 
                    SET name = :name, image = :image, description = :description, status = :status
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }  
        
        public function deleteCategoryById($id) {
            // Lấy thông tin ảnh danh mục
            $sql = "SELECT image FROM categories WHERE id = :id";
            $params = ['id' => $id];
            $category = $this->get($sql, $params);
        
            if ($category && !empty($category['image'])) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/categories/" . $category['image'];
        
                // Kiểm tra và xóa ảnh nếu tồn tại
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $sql = "DELETE FROM categories WHERE id = :id";
            return $this->execute($sql, $params)->rowCount() > 0;
        }        
    }
?>