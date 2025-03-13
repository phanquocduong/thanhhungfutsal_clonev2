<?php 
    class WardModel extends Connect {
        private $id;
        private $name;
        private $district_id;

        public function __construct($id = null, $name = null, $district_id = null) {
            parent::__construct();
            $this->id = $id;
            $this->name = $name;
            $this->district_id = $district_id;
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getDistrictId() { return $this->district_id; }

        public function getAllWards($district_id) {
            $sql = "SELECT * FROM wards WHERE district_id = :district_id";
            $params = ['district_id' => $district_id];
            return $this->getAll($sql, $params); 
        }

        public function getWardById($id) {
            $sql = "SELECT * FROM wards WHERE id  = :id";
            $params = [ 'id' => $id ];
            return $this->get($sql, $params); 
        }
    }
?>