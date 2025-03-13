<?php 
    class VoucherModel extends Connect {
        private $id;
        private $code;
        private $discount_value;
        private $start_date;
        private $end_date;
        private $usage_limit;
        private $min_order_value;
        private $status;

        public function __construct() {
            parent::__construct();
            if (func_num_args() > 0) {
                $this->id = func_get_arg(0);
                $this->code = func_get_arg(1);
                $this->discount_value = func_get_arg(2);
                $this->start_date = func_get_arg(3);
                $this->end_date = func_get_arg(4);
                $this->usage_limit = func_get_arg(5);
                $this->min_order_value = func_get_arg(6);
                $this->status = func_get_arg(7);
            }
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getCode() {
            return $this->code;
        }

        public function setCode($code) {
            $this->code = $code;
        }

        public function getDiscountValue() {
            return $this->discount_value;
        }

        public function setDiscountValue($discount_value) {
            $this->discount_value = $discount_value;
        }

        public function getStartDate() {
            return $this->start_date;
        }

        public function setStartDate($start_date) {
            $this->start_date = $start_date;
        }

        public function getEndDate() {
            return $this->end_date;
        }

        public function setEndDate($end_date) {
            $this->end_date = $end_date;
        }

        public function getUsageLimit() {
            return $this->usage_limit;
        }

        public function setUsageLimit($usage_limit) {
            $this->usage_limit = $usage_limit;
        }

        public function getMinOrderValue() {
            return $this->min_order_value;
        }

        public function setMinOrderValue($min_order_value) {
            $this->min_order_value = $min_order_value;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function validateCoupon($code, $provisional_price, $current_date) {
            $sql = "SELECT * FROM vouchers 
                    WHERE code = :code
                    AND :current_date BETWEEN start_date AND end_date 
                    AND (usage_limit IS NULL OR usage_limit > 0)
                    AND :provisional_price >= min_order_value
                    AND status = 1";
            $params = [
                'code' => $code,
                'current_date' => $current_date,
                'provisional_price' => $provisional_price
            ];
            return $this->get($sql, $params); 
        }

        public function reduceUsageLimit($id) {
            $sql = "UPDATE vouchers SET usage_limit = usage_limit - 1 WHERE id = :id";
            $params = ['id' => $id];
            return $this->get($sql, $params);
        }

        public function getAllVouchers($filters = []) {
            $sql = "SELECT * FROM vouchers WHERE 1=1";
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
        
        public function getVoucherById($id, $status = null) {
            $sql = "SELECT * FROM vouchers WHERE id = :id";
            $params = ['id' => $id];

            if ($status !== null) {
                $sql .= " AND status = :status";
                $params['status'] = $status;
            }

            return $this->get($sql, $params);
        }

        public function insertVoucher($data) {
            $sql = "INSERT INTO vouchers (code, discount_value, start_date, end_date, usage_limit, min_order_value, status) 
                    VALUES (:code, :discount_value, :start_date, :end_date, :usage_limit, :min_order_value, :status)";
        
            return $this->execute($sql, $data);
        }     

        public function updateVoucher($id, $data) {
            $sql = "UPDATE vouchers 
                    SET code = :code, discount_value = :discount_value, start_date = :start_date, end_date = :end_date,
                        usage_limit = :usage_limit, min_order_value = :min_order_value, status = :status
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }  

        public function deleteVoucherById($id) {
            $sql = "DELETE FROM vouchers WHERE id = :id";
            $params = ['id' => $id];
            return $this->execute($sql, $params);
        }   
    }
?>