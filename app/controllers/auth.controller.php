<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class auth
{
    function index($error_message = "")
    {
        require_once("../app/views/login/login.view.php");
    }

    function login()
    {
        $error_message = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($username === "admin" && $password === "123") {
                $_SESSION["username"] = $username;

                if (isset($_POST["remember"])) {
                    setcookie("username", $username, time() + 3600,  "/");
                } else {
                    setcookie("username", "", time() - 3600,  "/");
                }

                header("Location: /home");
                exit();
            } else {
                $error_message = "Invalid username or password.";
            }
        }
        $this->index($error_message);
    }

    function logout()
    {
        session_unset();
        session_destroy();
        setcookie("username", "", time() - 3600,  "/");
        header("Location: /auth");
        exit();
    }
}
