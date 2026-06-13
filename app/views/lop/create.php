<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Create Class</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode */
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

        /* Định dạng riêng cho khung nhập liệu ghi chú textarea */
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
    </style>
</head>

<body>
    <div class="container">
        <h1 class="main-title">Create Class</h1>

        <form action="/lop/store" method="POST">

            <div class="form-group">
                <label for="ma_lop" class="form-label">Mã Lớp:</label>
                <input type="text" id="ma_lop" name="ma_lop" class="form-control" placeholder="Nhập mã lớp học (Ví dụ: 68PM1)..." required>
            </div>

            <div class="form-group">
                <label for="ten_lop" class="form-label">Tên Lớp:</label>
                <input type="text" id="ten_lop" name="ten_lop" class="form-control" placeholder="Nhập tên lớp học (Ví dụ: Công nghệ thông tin 1)..." required>
            </div>

            <div class="form-group">
                <label for="ghi_chu" class="form-label">Ghi Chú:</label>
                <textarea id="ghi_chu" name="ghi_chu" class="form-control" placeholder="Nhập ghi chú hoặc mô tả về lớp học..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Create</button>
                <a href="/lop" class="btn-cancel">Hủy</a>
            </div>

        </form>
    </div>
</body>

</html>