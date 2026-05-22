<?php
require_once '../app/middleware/auth.middleware.php';
require_once '../app/core/App.php';

$authMiddlewarre = new authMiddleware();
$authMiddlewarre->handle();
$app = new App();
