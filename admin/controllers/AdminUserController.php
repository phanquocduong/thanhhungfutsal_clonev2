<?php
    class AdminUserController {
        private $userService;
        private $adminUserView;

        public function __construct() {
            $this->userService = new UserService();
            $this->adminUserView = new AdminUserView();
        }

        public function index() {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 20;
            $offset = ($page - 1) * $limit;

            $filters = [
                'limit' => $limit,
                'offset' => $offset,
            ];

            $users = $this->userService->getAllUsers($filters);
            $totalUsers = count($this->userService->getAllUsers());
            $totalPages = ceil($totalUsers / $limit);

            $data = [ 
                'users' => $users,
                'totalPages' => $totalPages,
                'currentPage' => $page
            ];

            $this->adminUserView->index($data);
        }

        public function showEdit($id) {
            $user = $this->userService->getUserById($id);
            if (!$user) {
                http_response_code(404);
                echo "Người dùng không tồn tại.";
                return;
            }
            $data = [ 'user' => $user ];

            $this->adminUserView->showEdit($data);
        }

        public function handleEdit($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $role_id = $_POST['role_id'] ?? 0;
                    $status = $_POST['status'] ?? 1;

                    $this->userService->editUser($id, $role_id, $status);

                    $_SESSION['message'] = "Cập nhật người dùng thành công!";
                    header("Location: /thanhhungfutsal_v2/admin/users");
                    exit();
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->getMessage();
                    header("Location: /thanhhungfutsal_v2/admin/users/edit/' . $id . '");
                    exit();
                }
            }
        }

        public function handleDelete($id) {
            try {
                // Kiểm tra mã người dùng hợp lệ
                if (!is_numeric($id) || $id <= 0) {
                    throw new Exception("Mã người dùng không hợp lệ.");
                }

                // Xóa người dùng
                if (!$this->userService->deleteUser($id)) {
                    throw new Exception("Xóa người dùng thất bại.");
                }

                $_SESSION['message'] = "Xóa người dùng thành công!";
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
            header("Location: /thanhhungfutsal_v2/admin/users");
            exit();
        }
    }
?>