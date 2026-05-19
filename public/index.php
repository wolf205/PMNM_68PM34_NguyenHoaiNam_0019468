<?php

require_once '../app/middleware/auth.middleware.php';

$authMiddleware = new authMiddleware();
$authMiddleware->handle();

$app = new App();
