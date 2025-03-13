<?php 
    class NewsService {
        private $newsModel;

        public function __construct() {
            $this->newsModel = new NewsModel();
        }

        public function getAllNews($filters = []) {
            $result = $this->newsModel->getAllNews($filters);
            $newsList = [];

            foreach ($result as $row) {
                $newsList[] = new NewsModel(
                    $row['id'],
                    $row['thumbnail'],
                    $row['title'],
                    $row['content'],
                    $row['created_at'],
                    $row['status'],
                );
            }

            return $newsList;
        }

        public function getNewsById($id, $status = null) {
            $result = $this->newsModel->getNewsById($id, $status);

            if ($result) {
                return new NewsModel(
                    $result['id'],
                    $result['thumbnail'],
                    $result['title'],
                    $result['content'],
                    $result['created_at'],
                    $result['status'],
                );
            }

            return null;
        }

        public function addNews($thumbnail_file, $title, $content, $status) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
            // Xử lý ảnh chính
            $thumbnail = $this->handleImageUpload($thumbnail_file, $allowed_extensions);
    
            // Lưu vào database
            $data = [
                'thumbnail' => $thumbnail,
                'title' => $title,
                'content' => $content,
                'status' => $status
            ];
            return $this->newsModel->insertNews($data);
        }

        public function editNews($id, $thumbnail_file, $title, $content, $status) {
            $news = $this->getNewsById($id);
            if (!$news) {
                throw new Exception("Tin tức không tồn tại.");
            }
    
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
            // Xử lý ảnh chính
            $thumbnail = $news->getThumbnail();
            if (!empty($thumbnail_file)) {
                $thumbnail = $this->handleImageUpload($thumbnail_file, $allowed_extensions, $news->getThumbnail());
            }
    
            // Cập nhật dữ liệu sản phẩm
            $data = [
                'thumbnail' => $thumbnail,
                'title' => $title,
                'content' => $content,
                'status' => $status
            ];

            return $this->newsModel->updateNews($id, $data);
        }           

        private function handleImageUpload($file, $allowed_extensions, $old_image = null) {
            // Kiểm tra đuôi file
            $image_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($image_extension, $allowed_extensions)) {
                throw new Exception("Định dạng thumbnail không hợp lệ. Chỉ chấp nhận JPG, JPEG, PNG, GIF, WEBP.");
            }
    
            // Tạo tên file duy nhất
            $image_name = uniqid('news_') . '.' . $image_extension;
            $image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/news/" . $image_name;

            if (!move_uploaded_file($file['tmp_name'], $image_path)) {
                throw new Exception("Lỗi khi upload thumbnail.");
            }

            // Xoá ảnh cũ nếu có
            if (!empty($old_image)) {
                $old_image_path = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/news/" . $old_image;
                if (file_exists($old_image_path) && !empty($old_image)) {
                    unlink($old_image_path);
                }
            }
    
            return $image_name;
        }

        public function deleteNews($id) {
            return $this->newsModel->deleteNewsById($id);
        }
    }
?>