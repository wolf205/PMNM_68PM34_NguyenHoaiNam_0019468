<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sinh Viên</title>
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
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <h1>Sửa Sinh Viên</h1>

    <?php if (!empty($student)): ?>
        <form action="/student/update/<?php echo $student['id']; ?>" method="POST">

            <div class="form-group">
                <label for="hoten">Họ Tên:</label>
                <input type="text" id="hoten" name="hoten"
                    value="<?php echo htmlspecialchars($student['hoten']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới Tính:</label>
                <select id="gioitinh" name="gioitinh" required>
                    <option value="">--Chọn Giới Tính--</option>
                    <option value="Nam" <?php echo $student['gioitinh'] === 'Nam'  ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $student['gioitinh'] === 'Nữ'   ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $student['gioitinh'] === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mssv">MSSV:</label>
                <input type="text" id="mssv" name="mssv"
                    value="<?php echo htmlspecialchars($student['mssv']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ma_lop">Lớp:</label>
                <select id="ma_lop" name="ma_lop" required>
                    <option value="">--Chọn Lớp--</option>
                    <?php $lopList = isset($lopList) ? $lopList : []; ?>
                    <?php foreach ($lopList as $lop): ?>
                        <option value="<?php echo htmlspecialchars($lop['ma_lop']); ?>"
                            <?php echo $student['ma_lop'] === $lop['ma_lop'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($lop['ten_lop']); ?> (<?php echo htmlspecialchars($lop['ma_lop']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Cập Nhật</button>
            <a href="/student/index">Huỷ</a>
        </form>
    <?php else: ?>
        <p>Không tìm thấy sinh viên. <a href="/student/index">Quay lại</a></p>
    <?php endif; ?>
</body>

</html>