<?php
    class OrderModel extends Connect {
        private $id;
        private $customer;
        private $email;
        private $phone;
        private $shipping_address;
        private $province_id;
        private $district_id;
        private $ward_id;
        private $delivery_fee;
        private $total_amount;
        private $payment_method;
        private $created_at;
        private $status;
        private $note;
        private $user_id;
        private $voucher_id;

        public function __construct() {
            parent::__construct();
            if (func_num_args() > 0) {
                $this->id = func_get_arg(0);
                $this->customer = func_get_arg(1);
                $this->email = func_get_arg(2);
                $this->phone = func_get_arg(3);
                $this->shipping_address = func_get_arg(4);
                $this->province_id = func_get_arg(5);
                $this->district_id = func_get_arg(6);
                $this->ward_id = func_get_arg(7);
                $this->delivery_fee = func_get_arg(8);
                $this->total_amount = func_get_arg(9);
                $this->payment_method = func_get_arg(10);
                $this->created_at = func_get_arg(11);
                $this->status = func_get_arg(12);
                $this->note = func_get_arg(13);
                $this->user_id = func_get_arg(14);
                $this->voucher_id = func_get_arg(15);
            }
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getCustomer() {
            return $this->customer;
        }

        public function setCustomer($customer) {
            $this->customer = $customer;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
        }

        public function getShippingAddress() {
            return $this->shipping_address;
        }

        public function setShippingAddress($shipping_address) {
            $this->shipping_address = $shipping_address;
        }

        public function getProvinceId() {
            return $this->province_id;
        }

        public function setProvinceId($province_id) {
            $this->province_id = $province_id;
        }

        public function getDistrictId() {
            return $this->district_id;
        }

        public function setDistrictId($district_id) {
            $this->district_id = $district_id;
        }

        public function getWardId() {
            return $this->ward_id;
        }

        public function setWardId($ward_id) {
            $this->ward_id = $ward_id;
        }

        public function getDeliveryFee() {
            return $this->delivery_fee;
        }

        public function setDeliveryFee($delivery_fee) {
            $this->delivery_fee = $delivery_fee;
        }

        public function getTotalAmount() {
            return $this->total_amount;
        }

        public function setTotalAmount($total_amount) {
            $this->total_amount = $total_amount;
        }

        public function getPaymentMethod() {
            return $this->payment_method;
        }

        public function setPaymentMethod($payment_method) {
            $this->payment_method = $payment_method;
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

        public function getNote() {
            return $this->note;
        }

        public function setNote($note) {
            $this->note = $note;
        }

        public function getUserId() {
            return $this->user_id;
        }

        public function setUserId($user_id) {
            $this->user_id = $user_id;
        }

        public function getVoucherId() {
            return $this->voucher_id;
        }

        public function setVoucherId($voucher_id) {
            $this->voucher_id = $voucher_id;
        }

        function createOrder($data) {
            $sql = "INSERT INTO orders (`user_id`, `customer`, `email`, `phone`, `shipping_address`, `province_id`, `district_id`, `ward_id`, `delivery_fee`, `total_amount`, `payment_method`, `note`, `voucher_id`) 
                    VALUES (:user_id, :customer, :email, :phone, :shipping_address, :province_id, :district_id, :ward_id, :delivery_fee, :total_amount, :payment_method, :note, :voucher_id)";
            $this->execute($sql, $data);
            return $this->lastInsertId();
        }

        public function getAllOrders($filters = []) {
            $sql = "SELECT * FROM orders WHERE 1=1";
            $params = [];

            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }

            return $this->getAll($sql);
        }   

        public function getOrderById($id) {
            $sql = "SELECT 
                        orders.*, 
                        vouchers.discount_value,
                        vouchers.code AS discount_code,
                        provinces.name AS province_name,
                        districts.name AS district_name,
                        wards.name AS ward_name
                    FROM orders 
                    INNER JOIN vouchers 
                    ON orders.voucher_id = vouchers.id
                    INNER JOIN provinces
                    ON orders.province_id = provinces.id
                    INNER JOIN districts
                    ON orders.district_id = districts.id
                    INNER JOIN wards
                    ON orders.ward_id = wards.id
                    WHERE orders.id = :id";

            $params = ['id' => $id];
            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }
            return $this->get($sql, $params);
        }

        public function updateOrder($id, $status) {
            $sql = "UPDATE orders 
                    SET status = :status
                    WHERE id = :id";

            $params = ['id' => $id, 'status' => $status];
            
            return $this->execute($sql, $params);
        }  
    }
?>