<?php
    class LocationService {
        private $provinceModel;
        private $districtModel;
        private $wardModel;

        public function __construct() {
            $this->provinceModel = new ProvinceModel();
            $this->districtModel = new DistrictModel();
            $this->wardModel = new WardModel();
        }

        public function getAllProvinces() {
            $result = $this->provinceModel->getAllProvinces();
            $provinces = [];

            foreach ($result as $row) {
                $provinces[] = new ProvinceModel(
                    $row['id'],
                    $row['name']
                );
            }

            return $provinces;
        }

        public function getAllDistricts($province_id) {
            return $this->districtModel->getAllDistricts($province_id);
        }

        public function getAllWards($district_id) {
            return $this->wardModel->getAllWards($district_id);
        }
 
        public function getWardById($id) {
            $result = $this->wardModel->getWardById($id);

            if ($result) {
                return new WardModel(
                    $result['id'],
                    $result['name'],
                    $result['district_id'],
                );
            }

            return null;
        }

        public function getDistrictById($id) {
            $result = $this->districtModel->getDistrictById($id);

            if ($result) {
                return new DistrictModel(
                    $result['id'],
                    $result['name'],
                    $result['province_id'],
                );
            }

            return null;
        }

        public function getProvinceById($id) {
            $result = $this->provinceModel->getProvinceById($id);

            if ($result) {
                return new ProvinceModel(
                    $result['id'],
                    $result['name'],
                );
            }

            return null;
        }
    }
?>
