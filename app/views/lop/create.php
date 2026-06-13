<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Lớp Học</title>
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
    <h1>Thêm Lớp Học</h1>

    <form action="/lop/store" method="POST">
        <div class="form-group">
            <label for="ma_lop">Mã Lớp:</label>
            <input type="text" id="ma_lop" name="ma_lop" placeholder="Ví dụ: 68PM1" required>
        </div>

        <div class="form-group">
            <label for="ten_lop">Tên Lớp:</label>
            <input type="text" id="ten_lop" name="ten_lop" placeholder="Ví dụ: Công nghệ thông tin 1" required>
        </div>

        <div class="form-group">
            <label for="ghi_chu">Ghi Chú:</label>
            <textarea id="ghi_chu" name="ghi_chu" placeholder="Ghi chú về lớp học..."></textarea>
        </div>

        <button type="submit">Tạo Lớp</button>
        <a href="/lop/index">Huỷ</a>
    </form>
</body>

</html>