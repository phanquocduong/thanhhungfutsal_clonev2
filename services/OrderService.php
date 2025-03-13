<?php
    class OrderService {
        private $orderModel;

        public function __construct() {
            $this->orderModel = new OrderModel();
        }

        public function getAllOrders($filters = []) {
            $result = $this->orderModel->getAllOrders($filters = []);
            $orders = [];

            foreach ($result as $row) {
                $orders[] = new OrderModel(
                    $row['id'],
                    $row['customer'],
                    $row['email'],
                    $row['phone'],
                    $row['shipping_address'],
                    $row['province_id'],
                    $row['district_id'],
                    $row['ward_id'],
                    $row['delivery_fee'],
                    $row['total_amount'],
                    $row['payment_method'],
                    $row['created_at'],
                    $row['status'],
                    $row['note'],
                    $row['user_id'],
                    $row['voucher_id']
                );
            }

            return $orders;
        }

        public function getOrderById($id) {
            $result = $this->orderModel->getOrderById($id);

            if ($result) {
                $order = new OrderModel(
                    $result['id'],
                    $result['customer'],
                    $result['email'],
                    $result['phone'],
                    $result['shipping_address'],
                    $result['province_id'],
                    $result['district_id'],
                    $result['ward_id'],
                    $result['delivery_fee'],
                    $result['total_amount'],
                    $result['payment_method'],
                    $result['created_at'],
                    $result['status'],
                    $result['note'],
                    $result['user_id'],
                    $result['voucher_id']
                );
                $order->discount_value = $result['discount_value'];
                $order->discount_code = $result['discount_code'];
                $order->province_name = $result['province_name'];
                $order->district_name = $result['district_name'];
                $order->ward_name = $result['ward_name'];
                return $order;
            }

            return null;
        }

        public function editOrder($id, $status) {
            $order = $this->getOrderById($id);
            if (!$order) {
                throw new Exception("Đơn hàng không tồn tại.");
            }

            return $this->orderModel->updateOrder($id, $status);
        }
    }
?>