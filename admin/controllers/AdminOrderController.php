<?php
    class AdminOrderController {
        private $orderService;
        private $adminOrderView;
        private $orderItemsService;

        public function __construct() {
            $this->orderService = new OrderService();
            $this->adminOrderView = new AdminOrderView();
            $this->orderItemsService = new orderItemsService();
        }

        public function index() {
            $orders = $this->orderService->getAllOrders();
            $data = [ 'orders' => $orders ];

            $this->adminOrderView->index($data);
        }

        public function showEdit($id) {
            $order = $this->orderService->getOrderById($id);
            if (!$order) {
                http_response_code(404);
                echo "Đơn hàng không tồn tại.";
                return;
            }
            $orderItems = $this->orderItemsService->getOrderItemsById($id);
            
            $data = [ 'order' => $order,  'orderItems' => $orderItems];

            $this->adminOrderView->showEdit($data);
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $status = $_POST['status'];

                    $this->orderService->editOrder($id, $status);

                    $_SESSION['message'] = "Cập nhật đơn hàng thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/orders");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/orders/edit/' . $id . '");
                    exit();
                }
            }
        }
    }
?>