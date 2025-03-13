<?php
    class VoucherService {
        private $voucherModel;

        public function __construct() {
            $this->voucherModel = new VoucherModel();
        }

        public function getAllVouchers($filters = []) {
            $result = $this->voucherModel->getAllVouchers($filters);
            $vouchers = [];

            foreach ($result as $row) {
                $vouchers[] = new VoucherModel(
                    $row['id'],
                    $row['code'],
                    $row['discount_value'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['usage_limit'],
                    $row['min_order_value'],
                    $row['status']
                );
            }

            return $vouchers;
        }

        public function validateVoucher($code, $provisional_price) {
            $current_date = date('Y-m-d');
            $coupon = $this->voucherModel->validateCoupon($code, $provisional_price, $current_date);
            if ($coupon) {
                $discount_value = $coupon['discount_value'];
                $new_provisional_price = round($provisional_price - ($provisional_price * $discount_value / 100));
        
                $_SESSION['discount_applied'] = true;
        
                echo json_encode([
                    'success' => true,
                    'message' => "Áp dụng thành công! Bạn được giảm " . $discount_value . "%.",
                    'newProvisionalPrice' => $new_provisional_price,
                    'discountId' => $coupon['id']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Mã giảm giá không hợp lệ hoặc đã hết hạn!"
                ]);
            }
        }

        public function getVoucherById($id, $status = null) {
            $result = $this->voucherModel->getVoucherById($id, $status);

            if ($result) {
                return new VoucherModel(
                    $result['id'],
                    $result['code'],
                    $result['discount_value'],
                    $result['start_date'],
                    $result['end_date'],
                    $result['usage_limit'],
                    $result['min_order_value'],
                    $result['status']
                );
            }

            return null;
        }

        public function insertVoucher($code, $discount_value, $start_date, $end_date, $usage_limit, $min_order_value, $status) {
            $data = [
                'code' => $code,
                'discount_value' => $discount_value,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'usage_limit' => $usage_limit,
                'min_order_value' => $min_order_value,
                'status' => $status
            ];
    
            return $this->voucherModel->insertVoucher($data);
        }

        public function updateVoucher($id, $code, $discount_value, $start_date, $end_date, $usage_limit, $min_order_value, $status) {
            $data = [
                'code' => $code,
                'discount_value' => $discount_value,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'usage_limit' => $usage_limit,
                'min_order_value' => $min_order_value,
                'status' => $status
            ];

            return $this->voucherModel->updateVoucher($id, $data);
        }

        public function deleteVoucher($id) {
            return $this->voucherModel->deleteVoucherById($id);
        }   
    }
?>