<?php 
    class ProvinceModel extends Connect {
        private $id;
        private $name;

        public function __construct($id = null, $name = null) {
            parent::__construct();
            $this->id = $id;
            $this->name = $name;
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }

        public function getAllProvinces() {
            $sql = "SELECT * FROM provinces ORDER BY name";
            return $this->getAll($sql); 
        }

        public function getProvinceById($id) {
            $sql = "SELECT * FROM provinces WHERE id  = :id";
            $params = [ 'id' => $id ];
            return $this->get($sql, $params); 
        }
    }
?>