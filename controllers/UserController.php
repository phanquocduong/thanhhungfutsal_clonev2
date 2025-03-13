<?php
    class UserController {
        private $userView;
        private $userService;

        public function __construct() {
            $this->userView = new UserView();
            $this->userService = new UserService();
        }

        public function showLogin() {
            $this->userView->login();
        }

        public function showRegister() {
            $this->userView->register();
        }

        public function handleRegister() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    if (empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['repassword'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $fullname = trim($_POST['lastname']) . ' ' . trim($_POST['firstname']);
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    $repassword = trim($_POST['repassword']);

                    // Kiểm tra định dạng email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Email không hợp lệ.");
                    }

                    // Kiểm tra độ mạnh của mật khẩu
                    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                        throw new Exception("Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.");
                    }

                    if ($password !== $repassword) {
                        throw new Exception("Mật khẩu nhập lại không đúng!");
                    }

                    $this->userService->register($fullname, $email, $password, $repassword);

                    $_SESSION['message'] = "Vui lòng kiểm tra email để xác thực tài khoản";
                    header("Location: /thanhhungfutsal_v2/login");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/register");
                    exit();
                }
            }
        }

        public function verify($code) {
            try {
                $this->userService->verifyAccount($code);
                $_SESSION['message'] = "Đăng ký thành công";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();   
            }
            header("Location: /thanhhungfutsal_v2/login");
            exit();
        }

        public function handleLogin() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    if (empty($_POST['email']) || empty($_POST['password'])) {
                        throw new Exception("Vui lòng nhập đầy đủ thông tin bắt buộc.");
                    }

                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);

                    $user = $this->userService->login($email, $password);
                    $user['password'] = null;

                    $_SESSION['user'] = $user;
                    if (isset($_SESSION['redirectto'])){
                        header("Location: $_SESSION[redirectto]");
                        unset($_SESSION['redirectto']);
                    } else {
                        if ($_SESSION['user']['role_id'] == 1) {
                            header("Location: /thanhhungfutsal_v2/admin");
                        } else {
                            header("Location: /thanhhungfutsal_v2/");
                        }
                        exit();
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/login");
                    exit();
                }
            }
        }

        public function logout() {
            unset($_SESSION['user']);
            header("Location: /thanhhungfutsal_v2/");
            exit;
        }
    }
?>