<?php
    class CategoryService {
        private $categoryModel;

        public function __construct() {
            $this->categoryModel = new CategoryModel();
        }

        public function getAllCategories($filters = []) {
            $result = $this->categoryModel->getAllCategories($filters);
            $categories = [];

            foreach ($result as $row) {
                $categories[] = new CategoryModel(
                    $row['id'],
                    $row['name'],
                    $row['image'],
                    $row['description'],
                    $row['status']
                );
            }

            return $categories;
        }

        public function getTotalCategories() {
            return $this->categoryModel->getTotalCategories();
        }        

        public function getCategoryById($id, $status = null) {
            $result = $this->categoryModel->getCategoryById($id, $status);

            if ($result) {
                return new CategoryModel(
                    $result['id'],
                    $result['name'],
                    $result['image'],
                    $result['description'],
                    $result['status']
                );
            }

            return null;
        }

        public function addCategory($name, $image_file, $description, $status) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
            // Xử lý ảnh chính
            $image = $image_file;
            if (!empty($image_file)) {
                $image = $this->handleImageUpload($image_file, $allowed_extensions);
            }
    
            // Lưu vào database
            $data = [
                'name' => $name,
                'image' => $image,
                'description' => $description,
                'status' => $status
            ];
            return $this->categoryModel->insertCategory($data);
        }

        public function editCategory($id, $name, $image_file, $description, $status) {
            $category = $this->getCategoryById($id);
            if (!$category) {
                throw new Exception("Danh mục không tồn tại.");
            }
    
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
            // Xử lý ảnh chính
            $image = $category->getImage();
            if (!empty($image_file)) {
                $image = $this->handleImageUpload($image_file, $allowed_extensions, $category->getImage());
            }
    
            // Cập nhật dữ liệu sản phẩm
            $data = [
                'name' => $name,
                'image' => $image,
                'description' => $description,
                'status' => $status
            ];

            return $this->categoryModel->updateCategory($id, $data);
        }           

        private function handleImageUpload($file, $allowed_extensions, $old_image = null) {
            // Kiểm tra đuôi file
            $image_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($image_extension, $allowed_extensions)) {
                throw new Exception("Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, JPEG, PNG, GIF, WEBP.");
            }
    
            // Tạo tên file duy nhất
            $image_name = uniqid('category_') . '.' . $image_extension;
            $image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/categories/" . $image_name;

            if (!move_uploaded_file($file['tmp_name'], $image_path)) {
                throw new Exception("Lỗi khi upload ảnh.");
            }

            // Xoá ảnh cũ nếu có
            if (!empty($old_image)) {
                $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/categories/" . $old_image;
                if (file_exists($old_image_path) && !empty($old_image)) {
                    unlink($old_image_path);
                }
            }
    
            return $image_name;
        }

        public function deleteCategory($id) {
            return $this->categoryModel->deleteCategoryById($id);
        }   
    }
?>
