<?php
    class MailController {
        private $mailService;
        private $mailView;

        public function __construct() {
            $this->mailService = new MailService();
            $this->mailView = new MailView();
        }

        public function sendVerificationEmail($email, $code) {
            $subject = "Xác thực Email của bạn";
            $body = $this->mailView->verification($code);

            return $this->mailService->sendEmail($email, $subject, $body);
        }

        public function sendSuccessOrderForCustomer($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note) {
            $subject = "Hóa đơn đặt hàng từ Thanh Hùng Futsal";
            $order_items = '';
            foreach ($_SESSION['cart'] as $item) {
                $order_items .= "
                    <tr>
                        <td style='text-align: left; padding: 10px; border: 1px solid #ddd;'>".$item['name']."</td>
                        <td style='text-align: center; padding: 10px; border: 1px solid #ddd;'>".$item['size']."</td>
                        <td style='text-align: center; padding: 10px; border: 1px solid #ddd;'>".$item['quantity']."</td>
                        <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($item['price']) . "₫</td>
                        <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($item['quantity'] * $item['price']) . "₫</td>
                    </tr>
                ";
            }
            $body = $this->mailView->successOrderForCustomer($fullname, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note, $order_items);

            return $this->mailService->sendEmail($email, $subject, $body);
        }

        public function sendOrderForAdmin($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note) {
            $subject = "Thông báo đơn hàng từ Thanh Hùng Futsal";
            $order_items = '';
            foreach ($_SESSION['cart'] as $item) {
                $order_items .= "
                    <tr>
                        <td style='text-align: left; padding: 10px; border: 1px solid #ddd;'>".$item['name']."</td>
                        <td style='text-align: center; padding: 10px; border: 1px solid #ddd;'>".$item['size']."</td>
                        <td style='text-align: center; padding: 10px; border: 1px solid #ddd;'>".$item['quantity']."</td>
                        <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($item['price']) . "₫</td>
                        <td style='text-align: right; padding: 10px; border: 1px solid #ddd;'>" . number_format($item['quantity'] * $item['price']) . "₫</td>
                    </tr>
                ";
            }
            $body = $this->mailView->orderForAdmin($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $discount_value, $transport_fee, $note, $order_items);
            return $this->mailService->sendEmail('phanquocduong.070905@gmail.com', $subject, $body);
        }
    }
?>
