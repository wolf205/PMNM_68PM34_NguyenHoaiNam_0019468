<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Lớp Học</title>
    <style>
        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
    </style>
</head>

<body>
    <h1>Sửa Lớp Học</h1>

    <?php if (!empty($lop)): ?>
        <form action="/lop/update/<?php echo $lop['ma_lop']; ?>" method="POST">

            <div class="form-group">
                <label>Mã Lớp:</label>
                <!-- Mã lớp không cho sửa, chỉ hiển thị -->
                <input type="text" value="<?php echo htmlspecialchars($lop['ma_lop']); ?>" disabled>
                <input type="hidden" name="ma_lop" value="<?php echo htmlspecialchars($lop['ma_lop']); ?>">
            </div>

            <div class="form-group">
                <label for="ten_lop">Tên Lớp:</label>
                <input type="text" id="ten_lop" name="ten_lop"
                    value="<?php echo htmlspecialchars($lop['ten_lop']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ghi_chu">Ghi Chú:</label>
                <textarea id="ghi_chu" name="ghi_chu"><?php echo htmlspecialchars($lop['ghi_chu']); ?></textarea>
            </div>

            <button type="submit">Cập Nhật</button>
            <a href="/lop/index">Huỷ</a>
        </form>
    <?php else: ?>
        <p>Không tìm thấy lớp học. <a href="/lop/index">Quay lại</a></p>
    <?php endif; ?>
</body>

</html>