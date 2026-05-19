<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../app/core/App.php';
class authMiddleware
{

    public function handle()
    {
        $currentRoute = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
        $publicRoutes = ['home/login', 'auth/login'];

        if (!isset($_SESSION['username']) && !in_array($currentRoute, $publicRoutes)) {
            header("Location: /home/login");
            exit();
        }
    }
}
