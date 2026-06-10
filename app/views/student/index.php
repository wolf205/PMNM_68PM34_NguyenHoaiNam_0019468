<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Student List</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode */
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #0d1117;
            /* Nền tối sâu */
            margin: 0;
            color: #c9d1d9;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #161b22;
            /* Khối nền tối nhẹ hơn body */
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
        }

        /* Nút thêm sinh viên */
        .btn-add {
            display: inline-block;
            background-color: transparent;
            color: #00ff66;
            padding: 10px 20px;
            text-decoration: none;
            border: 2px solid #00ff66;
            border-radius: 6px;
            margin-bottom: 25px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            background-color: #00ff66;
            color: #0d1117;
            box-shadow: 0 0 15px #00ff66;
            /* Bung hiệu ứng glow mạnh khi hover */
        }

        /* Định dạng Bảng Neon */
        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background-color: #0d1117;
        }

        .student-table th,
        .student-table td {
            border: 1px solid #21262d;
            padding: 14px;
            text-align: left;
        }

        .student-table th {
            background-color: #1f2937;
            color: #00ff66;
            /* Chữ tiêu đề bảng màu xanh neon */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .student-table tr:hover {
            background-color: rgba(0, 255, 102, 0.05);
            /* Highlight hàng khi rê chuột */
        }

        /* Nút Hành động (Sửa / Xóa) */
        .btn-action {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-right: 8px;
            transition: all 0.2s ease;
        }

        .btn-edit {
            color: #00ff66;
            border: 1px solid #00ff66;
        }

        .btn-edit:hover {
            background-color: rgba(0, 255, 102, 0.2);
            box-shadow: 0 0 8px #00ff66;
        }

        .btn-delete {
            color: #ff3333;
            /* Màu đỏ neon cảnh báo */
            border: 1px solid #ff3333;
        }

        .btn-delete:hover {
            background-color: rgba(255, 51, 51, 0.2);
            box-shadow: 0 0 8px #ff3333;
        }

        /* Thanh phân trang */
        .pagination-container {
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            gap: 8px;
        }

        .page-link {
            display: inline-block;
            padding: 8px 16px;
            border: 1px solid #21262d;
            color: #c9d1d9;
            text-decoration: none;
            border-radius: 6px;
            background-color: #161b22;
            transition: all 0.2s ease;
        }

        .page-link:hover {
            border-color: #00ff66;
            color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.4);
        }

        /* Khi không có dữ liệu */
        .no-data {
            text-align: center;
            color: #8b949e;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="main-title">Student List</h1>
        <a href="/student/create" class="btn-add">Add student</a>

        <table class="student-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>MSSV</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo $student['hoten']; ?></td>
                            <td><?php echo $student['gioitinh']; ?></td>
                            <td><?php echo $student['mssv']; ?></td>
                            <td>
                                <a href="/student/edit/<?php echo $student['id'] ?>" class="btn-action btn-edit">Sửa</a>
                                <a href="/student/delete/<?php echo $student['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xoá</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-data">Chưa có dữ liệu sinh viên nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination-container">
            <?php if (!empty($totalPage)): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                        <a href="/student/<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>