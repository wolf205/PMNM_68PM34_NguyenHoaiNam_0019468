<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Create Student</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode */
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
            /* Bo hẹp lại một chút cho form cân đối */
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

        /* Các ô dữ liệu vào (Input, Select) */
        .form-control {
            width: 100%;
            padding: 12px;
            background-color: #0d1117;
            border: 1px solid #21262d;
            border-radius: 6px;
            color: #ffffff;
            font-size: 1rem;
            box-sizing: border-box;
            /* Đảm bảo không bị tràn viền */
            transition: all 0.3s ease;
        }

        /* Hiệu ứng khi click vào ô nhập liệu */
        .form-control:focus {
            outline: none;
            border-color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.5);
        }

        /* Tùy chỉnh riêng cho thẻ select (mũi tên góc phải) */
        select.form-control {
            cursor: pointer;
        }

        select.form-control option {
            background-color: #161b22;
            color: #ffffff;
        }

        /* Khối chứa các nút bấm */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }

        /* Nút Submit Create */
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
            /* Chuyển đỏ neon khi muốn hủy */
            text-shadow: 0 0 5px rgba(255, 51, 51, 0.5);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="main-title">Create Student</h1>

        <form action="/student/store" method="POST">

            <div class="form-group">
                <label for="hoten" class="form-label">Họ Tên:</label>
                <input type="text" id="hoten" name="hoten" class="form-control" placeholder="Nhập họ và tên..." required>
            </div>

            <div class="form-group">
                <label for="gioitinh" class="form-label">Giới Tính:</label>
                <select id="gioitinh" name="gioitinh" class="form-control" required>
                    <option value="">--Chọn Giới Tính--</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mssv" class="form-label">MSSV:</label>
                <input type="text" id="mssv" name="mssv" class="form-control" placeholder="Nhập mã số sinh viên..." required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Create</button>
                <a href="/student" class="btn-cancel">Hủy</a>
            </div>

        </form>
    </div>
</body>

</html>