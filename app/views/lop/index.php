<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Lớp</title>
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
    <h1>Danh Sách Lớp Học</h1>

    <form class="form-search" action="/lop/index" method="GET">
        <input type="text" name="search" placeholder="Tìm theo mã, tên, ghi chú..."
            value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Tìm</button>
    </form>

    <a href="/lop/create">+ Thêm Lớp</a>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Lớp</th>
                <th>Tên Lớp</th>
                <th>Ghi Chú</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data) && !empty($currentPage)): ?>
                <?php
                // STT tính liên tục theo trang: trang 2 limit 10 thì bắt đầu từ 11
                $stt = ($currentPage - 1) * 10 + 1;
                ?>
                <?php foreach ($data as $lop): ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo htmlspecialchars($lop['ma_lop']); ?></td>
                        <td><?php echo htmlspecialchars($lop['ten_lop']); ?></td>
                        <td><?php echo htmlspecialchars($lop['ghi_chu']); ?></td>
                        <td>
                            <a href="/lop/edit/<?php echo $lop['ma_lop']; ?>">Sửa</a>
                            <a href="/lop/delete/<?php echo $lop['ma_lop']; ?>"
                                onclick="return confirm('Xóa lớp này sẽ xóa toàn bộ sinh viên thuộc lớp. Tiếp tục?')">Xoá</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center; font-style:italic;">Chưa có dữ liệu lớp học nào.</td>
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
                <a href="/lop/index/<?php echo $i; ?>?search=<?php echo $search; ?>"
                    class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</body>

</html>