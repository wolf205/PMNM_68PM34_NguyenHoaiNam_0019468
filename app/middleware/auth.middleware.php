<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class authMiddleware
{
    function handle()
    {
        if (!isset($_SESSION["username"]) && isset($_COOKIE["username"])) {
            $_SESSION["username"] = $_COOKIE["username"];
        }

        $publicRoutes = ['auth', 'auth/login'];
        $currentUri = trim($_SERVER['REQUEST_URI'], '/');

        if (!isset($_SESSION["username"]) && !isset($_COOKIE["username"]) && !in_array($currentUri, $publicRoutes)) {
            header("Location: /auth");
            exit();
        }
    }
}
