<?php 
    class NewsModel extends Connect {
        private $id;
        private $thumbnail;
        private $title;
        private $content;
        private $created_at;
        private $status;

        public function __construct(
            $id = null, 
            $thumbnail = null, 
            $title = null, 
            $content = null, 
            $created_at = null, 
            $status = null
        ) {
            parent::__construct();
            $this->id = $id;
            $this->thumbnail = $thumbnail;
            $this->title = $title;
            $this->content = $content;
            $this->created_at = $created_at;
            $this->status = $status;
        }
        

        public function getId() { return $this->id; }
        public function getThumbnail() { return $this->thumbnail; }
        public function getTitle() { return $this->title; }
        public function getContent() { return $this->content; }
        
        public function getShortContent() {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML(mb_convert_encoding($this->content, 'HTML-ENTITIES', 'UTF-8'));
            
            $pTags = $doc->getElementsByTagName('p');
            if ($pTags->length > 0) {
                $shortContent = $pTags->item(0)->nodeValue;
            }

            return $shortContent;
        }

        public function getCreatedAt() {
            return $this->created_at;
        }

        public function setCreatedAt($created_at) {
            $this->created_at = $created_at;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function getAllNews($filters = []) {
            $sql = "SELECT * FROM news WHERE 1=1";
            $params = [];

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

        public function getNewsById($id, $status = null) {
            $sql = "SELECT * FROM news WHERE id = :id";
            $params = ['id' => $id];

            if ($status !== null) {
                $sql .= " AND status = :status";
                $params['status'] = $status;
            }
            return $this->get($sql, $params);
        }     
        
        public function insertNews($data) {
            $sql = "INSERT INTO news (thumbnail, title, content, status) 
                    VALUES (:thumbnail, :title, :content, :status)";
        
            return $this->execute($sql, $data);
        }  

        public function updateNews($id, $data) {
            $sql = "UPDATE news 
                    SET thumbnail = :thumbnail, title = :title, content = :content, status = :status
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }  

        public function deleteNewsById($id) {
            // Lấy thông tin ảnh danh mục
            $sql = "SELECT thumbnail FROM news WHERE id = :id";
            $params = ['id' => $id];
            $news = $this->get($sql, $params);
        
            if ($news && !empty($news['thumbnail'])) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/thanhhungfutsal_v2/public/images/news/" . $news['thumbnail'];
        
                // Kiểm tra và xóa ảnh nếu tồn tại
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $sql = "DELETE FROM news WHERE id = :id";
            return $this->execute($sql, $params)->rowCount() > 0;
        }        
    }
?>