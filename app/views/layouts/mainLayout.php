<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content {
            min-height: 100vh;
            width: 60%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <?php require_once "partial/header.php"; ?>
    <div class="content"><?php if (!empty($view)): require_once '../app/views/' . $view . '.php';
                            endif; ?></div>
    <?php require_once "partial/footer.php"; ?>
</body>

</html>