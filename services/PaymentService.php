<?php
    class PaymentService {
        private $orderModel;
        private $productModel;
        private $voucherModel;
        private $productVariantsModel;
        private $orderItemsModel;
        private $mailController;

        public function __construct() {
            $this->orderModel = new OrderModel();
            $this->productModel = new ProductModel();
            $this->voucherModel = new VoucherModel();
            $this->productVariantsModel = new ProductVariantsModel();
            $this->orderItemsModel = new OrderItemsModel();
            $this->mailController = new MailController();
        }

        public function payment($idClient, $fullname, $email, $phone, $address, $province, $district, $ward, $transport_fee, $total, $method, $note, $voucher) {
            // Tạo đơn hàng
            $data = [
                'user_id' => $idClient,
                'customer' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'shipping_address' => $address,
                'province_id' => $province->getId(),
                'district_id' => $district->getId(),
                'ward_id' => $ward->getId(),
                'delivery_fee' => $transport_fee,
                'total_amount' => $total,
                'payment_method' => $method,
                'note' => $note,
                'voucher_id' => $voucher->getId()
            ];
            $orderId = $this->orderModel->createOrder($data);
        
            if (isset($_SESSION['cart']) && (count($_SESSION['cart']) > 0)) {
                foreach ($_SESSION['cart'] as $item) {
                    // Tạo hoá đơn chi tiết
                    $data = [
                        'order_id' => $orderId,
                        'product_id' => $item['id'],
                        'size' => $item['size'],
                        'unit_price' => $item['price'],
                        'quantity' => $item['quantity']
                    ];
                    $this->orderItemsModel->createOrderItems($data);

                    // Tăng số lượng đã bán của sản phẩm
                    $this->productModel->increaseSold($item['id'], $item['quantity']);

                    // Giảm số lượng tồn kho của biến thể sản phẩm
                    if ($item['size'] != null) {
                        $this->productVariantsModel->reduceStock($item['quantity'], $item['size'], $item['id']);
                    }
                }

                // Giảm số lần sử dụng của voucher
                if ($voucher->getUsageLimit() != null) {
                    $this->voucherModel->reduceUsageLimit($voucher->getId());
                }

                // Gửi email hóa đơn
                $success = $this->mailController->sendSuccessOrderForCustomer($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $voucher->getDiscountValue(), $transport_fee, $note);
                $success = $this->mailController->sendOrderForAdmin($fullname, $email, $address, $ward, $district, $province, $phone, $method, $total, $voucher->getDiscountValue(), $transport_fee, $note);
                if (!$success) {
                    throw new Exception("Không thể gửi email thông báo đơn hàng");
                }
                
                unset($_SESSION['cart']);
                if (isset($_SESSION['discount_applied'])) {
                    unset($_SESSION['discount_applied']);
                }
        
                $_SESSION['success-order'] = "Đặt hàng thành công, vui lòng kiểm tra email!";
                header("Location: /thanhhungfutsal_v2");
                exit;
            }
        }
    }
?>