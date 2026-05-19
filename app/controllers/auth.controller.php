<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class auth
{
    public $user = [
        "namnh" => "0019468",
        "admin" => "12345"
    ];

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST["username"] ?? '';
            $password = $_POST["password"] ?? '';

            if (!$username || !$password) {
                return "Username and password are required.";
            }

            if (isset($this->user[$username]) && $this->user[$username] == $password) {
                $_SESSION['username'] = $username;
                header("Location: /home");
                exit();
            } else {
                return "Invalid username or password.";
            }
        }
        return null;
    }
}
