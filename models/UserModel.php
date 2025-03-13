<?php
    class UserModel extends Connect {
        private $id;
        private $email;
        private $password;
        private $fullname;
        private $phone;
        private $address;
        private $role_id;
        private $status;
        private $verification_code;
        private $is_verified;
        private $created_at;
        private $reset_code;

        public function __construct(
            $id = null, 
            $email = null, 
            $password = null, 
            $fullname = null, 
            $phone = null, 
            $address = null, 
            $role_id = null, 
            $status = null, 
            $verification_code = null, 
            $is_verified = null, 
            $created_at = null, 
            $reset_code = null
        ) {
            parent::__construct();
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->fullname = $fullname;
            $this->phone = $phone;
            $this->address = $address;
            $this->role_id = $role_id;
            $this->status = $status;
            $this->verification_code = $verification_code;
            $this->is_verified = $is_verified;
            $this->created_at = $created_at;
            $this->reset_code = $reset_code;
        }        

        public function getId() { return $this->id; }
        public function getEmail() { return $this->email; }
        public function getFullname() { return $this->fullname; }
        public function getPhone() { return $this->phone; }
        public function getAddress() { return $this->address; }
        public function getRoleId() { return $this->role_id; }
        public function getStatus() { return $this->status; }
        public function setStatus($status) {
            $this->status = $status;
        }
        public function getVerificationCode() { return $this->verification_code; }
        public function getIsVerified() { return $this->is_verified; }
        public function getCreatedAt() { return $this->created_at; }
        public function getResetCode() { return $this->reset_code; }

        public function getAllUsers($filters = []) {
            $sql = "SELECT * FROM users WHERE 1=1";
            $params = [];

            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }

            if (isset($filters['limit']) && isset($filters['offset'])) {
                $sql .= " LIMIT " . $filters['offset'] . ", " . $filters['limit'];
            }

            return $this->getAll($sql, $params);
        }    

        public function getUserById($id, $filters = []) {
            $sql = "SELECT * FROM users WHERE id = :id";
            $params = ['id' => $id];

            if (isset($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }

            return $this->get($sql, $params);
        }

        public function getUserByEmail($email) {
            $sql = "SELECT * FROM users WHERE email = :email AND status = 1 AND is_verified = 1";
            $params = ['email' => $email];

            return $this->get($sql, $params);
        }

        public function getUserByEmailIncludingUnverified($email) {
            $sql = "SELECT * FROM users WHERE email = :email";
            $params = ['email' => $email];
            
            return $this->get($sql, $params);
        }        

        public function insertUser($data) {
            $sql = "INSERT INTO users (fullname, email, password, verification_code) 
                    VALUES (:fullname, :email, :password, :verification_code)";
        
            return $this->execute($sql, $data);
        }

        public function verify($data) {
            $sql = "UPDATE users SET is_verified = 1, verification_code = null
                    WHERE verification_code = :code AND is_verified = 0 AND status = 1";
            return $this->execute($sql, $data)->rowCount() > 0;
        }   
        
        public function updateUser($id, $data) {
            $sql = "UPDATE users 
                    SET role_id = :role_id, status = :status
                    WHERE id = :id";

            $data = ['id' => $id] + $data;
            
            return $this->execute($sql, $data);
        }  
        
        public function deleteUserById($id) {        
            $sql = "DELETE FROM users WHERE id = :id";
            $params = ['id' => $id];
            return $this->execute($sql, $params)->rowCount() > 0;
        }        
    }
?>