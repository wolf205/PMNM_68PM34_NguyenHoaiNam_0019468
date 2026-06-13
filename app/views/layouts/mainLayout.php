<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Sinh viên</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php require_once "partial/header.php"; ?>

    <div class="content">
        <?php if (!empty($view)): require_once '../app/views/' . $view . '.php';
        endif; ?>
    </div>

    <?php require_once "partial/footer.php"; ?>
</body>

</html>