<?php
    class OrderItemsService {
        private $orderItemsModel;

        public function __construct() {
            $this->orderItemsModel = new OrderItemsModel();
        }

        public function getOrderItemsById($id) {
            $result = $this->orderItemsModel->getOrderItemsById($id);
            $orderItems = [];

            foreach ($result as $row) {
                $orderItem = new OrderItemsModel(
                    $row['id'],
                    $row['product_id'],
                    $row['size'],
                    $row['unit_price'],
                    $row['quantity'],
                    $row['order_id']
                );
                $orderItem->product_name = $row['product_name'];
                $orderItems[] = $orderItem;
            }

            return $orderItems;
        }
    }
?>