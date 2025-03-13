    <?php
        class ProductService {
            private $productModel;
            private $productVariantsService;

            public function __construct() {
                $this->productModel = new ProductModel();
                $this->productVariantsService = new ProductVariantsService();
            }

            public function getAllProducts($filters = []) {
                $result = $this->productModel->getAllProducts($filters);
                $products = [];

                if ($result) {
                    foreach ($result as $row) {
                        $product = new ProductModel(
                            $row['id'],
                            $row['name'],
                            $row['price'],
                            $row['sale'],
                            $row['image'],
                            $row['extra_images'],
                            $row['description'],
                            $row['status'],
                            $row['sold'],
                            $row['created_at'],
                            $row['category_id']
                        );
                        $sizes = $this->productVariantsService->getSizesByProductId($row['id']);
                        if ($sizes) {
                            $product->sizes = $sizes;
                        }
                        $products[] = $product;
                    }
                }

                return $products;
            }

            public function getTotalProducts($filters = []) {
                return $this->productModel->getTotalProducts($filters);
            }
            
            public function getHotSaleProducts() {
                $result = $this->productModel->getHotSaleProducts();
                $products = [];

                if ($result) {
                    foreach ($result as $row) {
                        $product = new ProductModel(
                            $row['id'],
                            $row['name'],
                            $row['price'],
                            $row['sale'],
                            $row['image'],
                            $row['extra_images'],
                            $row['description'],
                            $row['status'],
                            $row['sold'],
                            $row['created_at'],
                            $row['category_id']
                        );
                        $sizes = $this->productVariantsService->getSizesByProductId($row['id']);
                        if ($sizes) {
                            $product->sizes = $sizes;
                        }
                        $products[] = $product;
                    }
                }

                return $products;
            }

            public function getProductById($id, $status = null) {
                $result = $this->productModel->getProductById($id, $status);

                if ($result) {
                    $product = new ProductModel(
                        $result['id'],
                        $result['name'],
                        $result['price'],
                        $result['sale'],
                        $result['image'],
                        $result['extra_images'],
                        $result['description'],
                        $result['status'],
                        $result['sold'],
                        $result['created_at'],
                        $result['category_id']
                    );
                    $product->category_name = $result['category_name'];
                    $sizes = $this->productVariantsService->getSizesByProductId($result['id']);
                    if ($sizes) {
                        $product->sizes = $sizes;
                    }
                    return $product;
                }

                return null;
            }

            public function getRelatedProducts($id, $category_id) {
                $result = $this->productModel->getRelatedProducts($id, $category_id);
                $products = [];

                if ($result) {
                    foreach ($result as $row) {
                        $product = new ProductModel(
                            $row['id'],
                            $row['name'],
                            $row['price'],
                            $row['sale'],
                            $row['image'],
                            $row['extra_images'],
                            $row['description'],
                            $row['status'],
                            $row['sold'],
                            $row['created_at'],
                            $row['category_id']
                        );
                        $sizes = $this->productVariantsService->getSizesByProductId($row['id']);
                        if ($sizes) {
                            $product->sizes = $sizes;
                        }
                        $products[] = $product;
                    }
                }

                return $products;
            }

            public function addProduct($name, $price, $sale, $image_file, $extra_image_files, $description, $status, $sold, $category_id) {
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
                // Xử lý ảnh chính
                $image = $this->handleImageUpload($image_file, $allowed_extensions);
        
                // Xử lý ảnh phụ
                $extra_images = $extra_image_files;
                if (!empty($extra_image_files)) {
                    $extra_images = $this->handleMultipleImageUpload($extra_image_files, $allowed_extensions);
                }
        
                // Lưu vào database
                $data = [
                    'name' => $name,
                    'price' => $price,
                    'sale' => $sale,
                    'image' => $image,
                    'extra_images' => !empty($extra_images) ? implode(",", $extra_images) : null,
                    'description' => $description,
                    'status' => $status,
                    'sold' => $sold,
                    'category_id' => $category_id
                ];
                return $this->productModel->insertProduct($data);
            }

            public function editProduct($id, $name, $price, $sale, $image_file, $extra_image_files, $description, $status, $sold, $category_id) {
                $product = $this->getProductById($id);
                if (!$product) {
                    throw new Exception("Sản phẩm không tồn tại.");
                }
        
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
                // Xử lý ảnh chính
                $image = $product->getImage();
                if (!empty($image_file)) {
                    $image = $this->handleImageUpload($image_file, $allowed_extensions, $product->getImage());
                }
        
                // Xử lý ảnh phụ
                $extra_images = $product->getExtraImages();
                if (!empty($extra_image_files)) {
                    $extra_images = $this->handleMultipleImageUpload($extra_image_files, $allowed_extensions, $product->getExtraImages());
                }
        
                // Cập nhật dữ liệu sản phẩm
                $data = [
                    'name' => $name,
                    'price' => $price,
                    'sale' => $sale,
                    'image' => $image,
                    'extra_images' => !empty($extra_images) ? implode(",", $extra_images) : null,
                    'description' => $description,
                    'status' => $status,
                    'sold' => $sold,
                    'category_id' => $category_id
                ];

                return $this->productModel->updateProduct($id, $data);
            }        

            private function handleImageUpload($file, $allowed_extensions, $old_image = null) {
                // Kiểm tra đuôi file
                $image_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (!in_array($image_extension, $allowed_extensions)) {
                    throw new Exception("Định dạng ảnh chính không hợp lệ. Chỉ chấp nhận JPG, JPEG, PNG, GIF, WEBP.");
                }
        
                // Tạo tên file duy nhất
                $image_name = uniqid('product_') . '.' . $image_extension;
                $image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/products/" . $image_name;

                if (!move_uploaded_file($file['tmp_name'], $image_path)) {
                    throw new Exception("Lỗi khi upload ảnh chính.");
                }

                // Xoá ảnh cũ nếu có
                if (!empty($old_image)) {
                    $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/products/" . $old_image;
                    if (file_exists($old_image_path) && !empty($old_image)) {
                        unlink($old_image_path);
                    }
                }
        
                return $image_name;
            }

            private function handleMultipleImageUpload($files, $allowed_extensions, $old_images = []) {
                $uploaded_images = [];
        
                foreach ($files['tmp_name'] as $key => $tmp_name) {
                    if (!empty($files['name'][$key])) {
                        $image_name = $files['name'][$key];
                        $image_extension = strtolower(pathinfo($files['name'][$key], PATHINFO_EXTENSION));
        
                        if (!in_array($image_extension, $allowed_extensions)) {
                            throw new Exception("Ảnh phụ '$image_name' có định dạng không hợp lệ.");
                        }
        
                        $new_image_name = uniqid('product_') . '.' . $image_extension;
                        $image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/products/" . $new_image_name;
        
                        if (!move_uploaded_file($tmp_name, $image_path)) {
                            throw new Exception("Lỗi khi upload ảnh phụ: $image_name.");
                        }
        
                        $uploaded_images[] = $new_image_name;
                    }
                }

                // Xoá ảnh cũ
                if (!empty($old_images)) {
                    foreach ($old_images as $old_image) {
                        $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/products/" . $old_image;
                        if (file_exists($old_image_path) && !empty($old_image)) {
                            unlink($old_image_path);
                        }
                    }
                }                
                
                return $uploaded_images;
            }

            public function deleteProduct($id) {
                return $this->productModel->deleteProductById($id);
            }                      
        }
    ?>
