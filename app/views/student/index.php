<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-search {
            margin-bottom: 12px;
        }

        .pagination {
            display: flex;
            gap: 6px;
            margin-top: 12px;
        }

        .pagination a {
            padding: 6px 12px;
            border: 1px solid #ccc;
            text-decoration: none;
        }

        .pagination a.active {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1>Danh Sách Sinh Viên</h1>

    <form class="form-search" action="/student/index" method="GET">
        <input type="text" name="search" placeholder="Tìm theo tên, MSSV, tên lớp..."
            value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Tìm</button>
    </form>

    <a href="/student/create">+ Thêm Sinh Viên</a>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>MSSV</th>
                <th>Lớp</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students) && !empty($currentPage)): ?>
                <?php
                // STT chạy liên tục theo trang
                $stt = ($currentPage - 1) * 10 + 1;
                ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo htmlspecialchars($student['hoten']); ?></td>
                        <td><?php echo htmlspecialchars($student['gioitinh']); ?></td>
                        <td><?php echo htmlspecialchars($student['mssv']); ?></td>
                        <td><?php echo htmlspecialchars($student['ten_lop']); ?></td>
                        <td>
                            <a href="/student/edit/<?php echo $student['id']; ?>">Sửa</a>
                            <a href="/student/delete/<?php echo $student['id']; ?>"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; font-style:italic;">Chưa có dữ liệu sinh viên nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (!empty($totalPage) && !empty($currentPage) && $totalPage > 1): ?>
        <div class="pagination">
            <?php
            $search = urlencode($_GET['search'] ?? '');
            for ($i = 1; $i <= $totalPage; $i++):
            ?>
                <a href="/student/index/<?php echo $i; ?>?search=<?php echo $search; ?>"
                    class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</body>

</html>