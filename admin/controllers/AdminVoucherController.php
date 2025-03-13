<?php
    class AdminVoucherController {
        private $voucherService;
        private $adminVoucherView;

        public function __construct() {
            $this->voucherService = new VoucherService();
            $this->adminVoucherView = new AdminVoucherView();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $vouchers = $this->voucherService->getAllVouchers($filters);
            $totalVouchers = count($this->voucherService->getAllVouchers());
            $totalPages = ceil($totalVouchers / $limit);

            $data = [ 
                'vouchers' => $vouchers,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];

            $this->adminVoucherView->index($data);
        }

        public function showAdd() {
            $this->adminVoucherView->showAdd();
        }

        public function showEdit($id) {
            $voucher = $this->voucherService->getVoucherById($id);
            if (!$voucher) {
                http_response_code(404);
                echo "Mã giảm giá không tồn tại.";
                return;
            }
            $data = [ 'voucher' => $voucher ];

            $this->adminVoucherView->showEdit($data);
        }

        public function handleAdd() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $code = $_POST['code'];
                    $discount_value = $_POST['discount_value'];
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
                    $usage_limit = $_POST['usage_limit'];
                    $min_order_value = $_POST['min_order_value'];
                    $status = $_POST['status'];

                    // Gọi service để thêm voucher
                    $inserted = $this->voucherService->insertVoucher(
                        $code,
                        $discount_value,
                        $start_date,
                        $end_date,
                        $usage_limit,
                        $min_order_value,
                        $status
                    );

                    if ($inserted) {
                        echo '<script>alert("Thêm voucher thành công")</script>';
                        echo '<script>window.location.href = "/thanhhungfutsal_v2/admin/vouchers";</script>';
                    } else {
                        throw new Exception("Thêm voucher thất bại do lỗi SQL.");
                    }
                } catch (Exception $e) {
                    echo '<script>alert("' . $e->getMessage() . '")</script>';
                    echo '<script>window.location.href = "/thanhhungfutsal_v2/admin/vouchers/add";</script>';
                }
            }
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $code = $_POST['code'];
                    $discount_value = $_POST['discount_value'];
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
                    $usage_limit = $_POST['usage_limit'];
                    $min_order_value = $_POST['min_order_value'];
                    $status = $_POST['status'];

                    $updated = $this->voucherService->updateVoucher(
                        $id,
                        $code,
                        $discount_value,
                        $start_date,
                        $end_date,
                        $usage_limit,
                        $min_order_value,
                        $status
                    );    

                    if ($updated && $updated->rowCount() > 0) {
                        echo '<script>alert("Cập nhật voucher thành công")</script>';
                        echo '<script>window.location.href = "/thanhhungfutsal_v2/admin/vouchers";</script>';
                    } else {
                        throw new Exception("Cập nhật voucher thất bại.");
                    }
                } catch (Exception $e) {
                    echo '<script>alert("' . $e->getMessage() . '")</script>';
                    echo '<script>window.location.href = "/thanhhungfutsal_v2/admin/vouchers/edit/' . $id . '";</script>';
                }
            }
        }

        public function handleDelete($id) {
            try {
                $deleted = $this->voucherService->deleteVoucher($id);
                if ($deleted) {
                    echo '<script>alert("Xóa voucher thành công");</script>';
                } else {
                    throw new Exception("Xóa voucher thất bại.");
                }
            } catch (Exception $e) {
                echo '<script>alert("' . $e->getMessage() . '");</script>';
            }
            echo '<script>window.location.href = "/thanhhungfutsal_v2/admin/vouchers";</script>';
        }
    }
?>