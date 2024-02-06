<?php
require_once '../models/user.php';

class AuthController {

    public function __construct() {
        require_once '../../sys/config.php';
        $this->userModel = new User();
    }

    public function showLoginForm() {
        require 'admin/views/login.php';
    }

    public function processLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $user = $this->userModel->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['username'] = $user['username'];
            $_SESSION['user']['name'] = $user['name'];
            $_SESSION['user']['ava'] = $user['ava'];
            $_SESSION['user']['phone'] = $user['phone'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['role'] = $user['role'];

            return "success";
        } else {
            return 'false';
        }
    }
    

    public function logout() {
        // Xử lý đăng xuất, ví dụ như xóa thông tin đăng nhập trong session và chuyển hướng về trang đăng nhập
        header('Location: ' . BASE_URL . 'login');
    }
}

?>


