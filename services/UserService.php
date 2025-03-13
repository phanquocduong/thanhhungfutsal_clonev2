<?php
    class UserService {
        private $userModel;
        private $mailController;

        public function __construct() {
            $this->userModel = new UserModel();
            $this->mailController = new MailController();
        }

        public function getAllUsers($filters = []) {
            $result = $this->userModel->getAllUsers($filters = []);
            $users = [];

            foreach ($result as $row) {
                $user = new UserModel(
                    $row['id'],
                    $row['email'],
                    null,
                    $row['fullname'],
                    $row['phone'],
                    $row['address'],
                    $row['role_id'],
                    $row['status'],
                    $row['verification_code'],
                    $row['is_verified'],
                    $row['created_at'],
                    $row['reset_code']
                );
                if ($user->getStatus()) {
                    $user->setStatus('<i style="color: green" class="fa-solid fa-circle"></i>');
                } else {
                    $user->setStatus('<i style="color: red" class="fa-solid fa-circle"></i>');
                }

                $users[] = $user;
            }

            return $users;
        }

        public function getUserById($id, $filters = []) {
            $result = $this->userModel->getUserById($id, $filters);

            if ($result) {
                return new UserModel(
                    $result['id'],
                    $result['email'],
                    $result['password'],
                    $result['fullname'],
                    $result['phone'],
                    $result['address'],
                    $result['role_id'],
                    $result['status'],
                    $result['verification_code'],
                    $result['is_verified'],
                    $result['created_at'],
                    $result['reset_code']
                );
            }

            return null;
        }

        public function register($fullname, $email, $password, $repassword) {
            if ($this->userModel->getUserByEmailIncludingUnverified($email)) {
                throw new Exception("Email đã tồn tại!");
            }
    
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $verification_code = bin2hex(random_bytes(32)); 

            $data = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $hashed_password,
                'verification_code' => $verification_code
            ];
    
            if (!$this->userModel->insertUser($data)) {
                throw new Exception("Có lỗi xảy ra. Vui lòng thử lại!");
            }
    
            // Gửi email xác nhận
            if(!$this->mailController->sendVerificationEmail($email, $verification_code)) {
                throw new Exception("Không thể gửi email xác nhận. Vui lòng thử lại.");
            };
        }

        public function verifyAccount($code) {
            $data = [ 'code' => $code ];
            if (!$this->userModel->verify($data)) {
                throw new Exception("Liên kết xác minh không hợp lệ hoặc đã hết hạn.");
            }
        }

        public function login($email, $password) {
            $user = $this->userModel->getUserByEmail($email);
    
            if (!$user || !password_verify($password, $user['password'])) {
                throw new Exception("Thông tin đăng nhập không hợp lệ.");
            }
    
            return $user;
        }

        public function editUser($id, $role_id, $status) {
            $user = $this->getUserById($id);
            if (!$user) {
                throw new Exception("Người dùng không tồn tại.");
            }

            $data = [
                'role_id' => $role_id,
                'status' => $status,
            ];

            return $this->userModel->updateUser($id, $data);
        }

        public function deleteUser($id) {
            return $this->userModel->deleteUserById($id);
        } 
    }
?>