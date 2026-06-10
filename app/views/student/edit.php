<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Edit Student</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode giống Index và Create */
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #0d1117;
            /* Nền tối sâu */
            margin: 0;
            padding: 40px 20px;
            color: #c9d1d9;
        }

        .container {
            max-width: 600px;
            /* Bo hẹp lại giống form create */
            margin: 0 auto;
            background-color: #161b22;
            /* Khối nền tối nhẹ */
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #00ff66;
            /* Viền xanh neon */
            box-shadow: 0 0 15px rgba(0, 255, 102, 0.2);
            /* Đổ bóng phát sáng */
        }

        /* Tiêu đề chính */
        .main-title {
            margin-top: 0;
            color: #ffffff;
            font-size: 2rem;
            text-shadow: 0 0 10px rgba(0, 255, 102, 0.6);
            /* Chữ phát sáng */
            border-bottom: 2px solid #00ff66;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        /* Định dạng Form & Nhãn dữ liệu */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #00ff66;
            /* Nhãn chữ màu xanh neon */
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        /* Các ô nhập liệu (Input, Select) */
        .form-control {
            width: 100%;
            padding: 12px;
            background-color: #0d1117;
            border: 1px solid #21262d;
            border-radius: 6px;
            color: #ffffff;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        /* Hiệu ứng khi click vào ô nhập liệu */
        .form-control:focus {
            outline: none;
            border-color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.5);
        }

        select.form-control {
            cursor: pointer;
        }

        select.form-control option {
            background-color: #161b22;
            color: #ffffff;
        }

        /* Khối chứa nút bấm */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }

        /* Nút Submit Update */
        .btn-submit {
            background-color: transparent;
            color: #00ff66;
            padding: 12px 24px;
            border: 2px solid #00ff66;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #00ff66;
            color: #0d1117;
            box-shadow: 0 0 15px #00ff66;
        }

        /* Nút Hủy */
        .btn-cancel {
            display: inline-block;
            color: #8b949e;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 1rem;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            color: #ff3333;
            /* Đỏ neon khi rê chuột vào nút Hủy */
            text-shadow: 0 0 5px rgba(255, 51, 51, 0.5);
        }

        /* Hộp thông báo lỗi Neon */
        .error-box {
            background-color: rgba(255, 51, 51, 0.05);
            border: 1px solid #ff3333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 51, 51, 0.15);
            text-align: center;
        }

        .error-message {
            color: #ff3333;
            margin-top: 0;
            font-weight: bold;
            text-shadow: 0 0 5px rgba(255, 51, 51, 0.3);
        }

        .error-box a {
            color: #00ff66;
            text-decoration: none;
            font-weight: bold;
        }

        .error-box a:hover {
            text-shadow: 0 0 5px #00ff66;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="main-title">Edit Student</h1>

        <?php if (!empty($student)): ?>

            <form action="/student/update/<?php echo $student['id']; ?>" method="POST">

                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                <div class="form-group">
                    <label for="hoten" class="form-label">Họ Tên:</label>
                    <input type="text" id="hoten" name="hoten" class="form-control" value="<?php echo htmlspecialchars($student['hoten']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="gioitinh" class="form-label">Giới Tính:</label>
                    <select id="gioitinh" name="gioitinh" class="form-control" required>
                        <option value="">--Chọn Giới Tính--</option>
                        <option value="Nam" <?php echo ($student['gioitinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo ($student['gioitinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                        <option value="Khác" <?php echo ($student['gioitinh'] === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mssv" class="form-label">MSSV:</label>
                    <input type="text" id="mssv" name="mssv" class="form-control" value="<?php echo htmlspecialchars($student['mssv']); ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update</button>
                    <a href="/student" class="btn-cancel">Huỷ</a>
                </div>
            </form>

        <?php else: ?>
            <div class="error-box">
                <p class="error-message">Lỗi: Không tìm thấy thông tin sinh viên hoặc dữ liệu không hợp lệ.</p>
                <a href="/student">Quay lại danh sách</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>