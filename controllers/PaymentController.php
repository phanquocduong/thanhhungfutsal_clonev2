<?php
    class PaymentController {
        private $paymentView;
        private $locationService;
        private $voucherService;
        private $orderService;
        private $cartService;
        private $paymentService;

        public function __construct() {
            $this->paymentView = new PaymentView();
            $this->locationService = new LocationService();
            $this->voucherService = new VoucherService();
            $this->orderService = new OrderService();
            $this->cartService = new CartService();
            $this->paymentService = new PaymentService();
        }

        public function index() {
            if (!isset($_SESSION['user'])) {
                $_SESSION['redirectto'] = $_SERVER['REQUEST_URI'];
                header("Location: /thanhhungfutsal_v2/login");
            } else {
                $provinces = $this->locationService->getAllProvinces();
                $grand_total = $this->cartService->calculateGrandTotal();
                $data = [ 'provinces' => $provinces, 'grand_total' => $grand_total ];
                $this->paymentView->index($data);
            }
        }

        public function getDistricts($province_id) {
            echo json_encode($this->locationService->getAllDistricts($province_id));
        } 

        public function getWards($district_id) {
            echo json_encode($this->locationService->getAllWards($district_id));
        } 

        public function handleApplyDiscount() {
            $input_data = json_decode(file_get_contents("php://input"), true);
        
            $code = isset($input_data['code']) ? trim($input_data['code']) : null;
            $provisional_price = isset($input_data['provisional']) ? $input_data['provisional'] : null;
        
            if (!$code || !$provisional_price) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ. Vui lòng thử lại!'
                ]);
                return;
            }
        
            if (isset($_SESSION['discount_applied']) && $_SESSION['discount_applied'] == true) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Chỉ áp dụng mã giảm giá được 1 lần!'
                ]);
                return;
            }
        
            $this->voucherService->validateVoucher($code, $provisional_price);
        }

        public function handlePayment() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    if 
                    (   
                        empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['ward']) ||
                        empty($_POST['district']) || empty($_POST['province']) || empty($_POST['address']) || empty($_POST['method']) ||
                        empty($_POST['total']) || empty($_POST['discount-id']) || empty($_POST['transport-fee'])
                    ) 
                    {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $id_client = $_SESSION['user']['id'];
                    $fullname = trim($_POST['fullname']);
                    $email = trim($_POST['email']);

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Email không hợp lệ");
                    }

                    $phone = preg_replace('/\D/', '', trim($_POST['phone']));

                    if (strlen($phone) < 10 || strlen($phone) > 11 || !ctype_digit($phone) || !preg_match('/^(03|05|07|08|09)\d+$/', $phone)) {
                        throw new Exception("Số điện thoại không hợp lệ");
                    }

                    $ward = $this->locationService->getWardById($_POST['ward']);
                    $district = $this->locationService->getDistrictById($_POST['district']);
                    $province = $this->locationService->getProvinceById($_POST['province']);
                    $address = trim($_POST['address']);
                    $method = $_POST['method'];
                    $total = $_POST['total'];
                    $note = $_POST['note'] ? trim($_POST['note']) : null;
                    $voucher = $this->voucherService->getVoucherById($_POST['discount-id']);
                    $transport_fee = $_POST['transport-fee'];

                    $this->paymentService->payment($id_client, $fullname, $email, $phone, $address, $province, $district, $ward, $transport_fee, $total, $method, $note, $voucher);
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/payment");
                    exit();
                }
            }
        }
    }
?>