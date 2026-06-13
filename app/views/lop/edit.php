<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Edit Class</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode tương thích hệ thống */
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #0d1117;
            margin: 0;
            padding: 40px 20px;
            color: #c9d1d9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #161b22;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #00ff66;
            box-shadow: 0 0 15px rgba(0, 255, 102, 0.2);
        }

        .main-title {
            margin-top: 0;
            color: #ffffff;
            font-size: 2rem;
            text-shadow: 0 0 10px rgba(0, 255, 102, 0.6);
            border-bottom: 2px solid #00ff66;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #00ff66;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

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

        .form-control:focus {
            outline: none;
            border-color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.5);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }

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
            text-shadow: 0 0 5px rgba(255, 51, 51, 0.5);
        }

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
        <h1 class="main-title">Edit Class</h1>

        <?php if (!empty($lop)): ?>

            <form action="/lop/update/<?php echo $lop['ma_lop']; ?>" method="POST">

                <input type="hidden" name="ma_lop" value="<?php echo $lop['ma_lop']; ?>">

                <div class="form-group">
                    <label for="ten_lop" class="form-label">Tên Lớp học:</label>
                    <input type="text" id="ten_lop" name="ten_lop" class="form-control" value="<?php echo htmlspecialchars($lop['ten_lop']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="ghi_chu" class="form-label">Ghi Chú:</label>
                    <textarea id="ghi_chu" name="ghi_chu" class="form-control"><?php echo htmlspecialchars($lop['ghi_chu']); ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Update</button>
                    <a href="/lop" class="btn-cancel">Huỷ</a>
                </div>
            </form>

        <?php else: ?>
            <div class="error-box">
                <p class="error-message">Lỗi: Không tìm thấy dữ liệu thông tin lớp học này hoặc đường dẫn không hợp lệ.</p>
                <a href="/lop">Quay lại danh sách lớp học</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>