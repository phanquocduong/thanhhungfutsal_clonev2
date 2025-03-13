<?php 
    class DistrictModel extends Connect {
        private $id;
        private $name;
        private $province_id;

        public function __construct($id = null, $name = null, $province_id = null) {
            parent::__construct();
            $this->id = $id;
            $this->name = $name;
            $this->province_id = $province_id;
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getProvinceId() { return $this->province_id; }

        public function getAllDistricts($province_id) {
            $sql = "SELECT * FROM districts WHERE province_id = :province_id";
            $params = ['province_id' => $province_id];
            return $this->getAll($sql, $params); 
        }

        public function getDistrictById($id) {
            $sql = "SELECT * FROM districts WHERE id  = :id";
            $params = [ 'id' => $id ];
            return $this->get($sql, $params); 
        }
    }
?>