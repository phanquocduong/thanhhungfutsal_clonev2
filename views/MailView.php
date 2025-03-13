<?php
    class MailView {
        public function verification($code) {
            ob_start();
            include './views/email/verification.php';
            return ob_get_clean();
        }

        public function successOrderForCustomer($fullname, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note, $order_items) {
            ob_start();
            include './views/email/success-order-for-user.php';
            return ob_get_clean();
        }

        public function orderForAdmin($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note, $order_items) {
            ob_start();
            include './views/email/order-for-admin.php';
            return ob_get_clean();
        }
    }
    
?>