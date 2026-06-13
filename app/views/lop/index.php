<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Class List</title>
    <style>
        /* Toàn cục - Phong cách Neon Dark Mode */
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #0d1117;
            /* Nền tối sâu */
            margin: 0;
            padding: 20px;
            color: #c9d1d9;
        }

        .container {
            max-width: 1200px;
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
            margin-bottom: 25px;
        }

        /* Toolbar: Chứa nút Thêm và form Tìm kiếm */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Các input và select */
        .form-control,
        .form-select {
            background-color: #0d1117;
            color: #c9d1d9;
            border: 1px solid #21262d;
            padding: 10px 15px;
            border-radius: 6px;
            font-family: inherit;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.4);
        }

        /* Nút thêm / Nút Tìm kiếm */
        .btn-add,
        .btn-search {
            display: inline-block;
            background-color: transparent;
            color: #00ff66;
            padding: 10px 20px;
            text-decoration: none;
            border: 2px solid #00ff66;
            border-radius: 6px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add:hover,
        .btn-search:hover {
            background-color: #00ff66;
            color: #0d1117;
            box-shadow: 0 0 15px #00ff66;
        }

        /* Định dạng Bảng Neon */
        .class-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #0d1117;
        }

        .class-table th,
        .class-table td {
            border: 1px solid #21262d;
            padding: 14px;
            text-align: left;
        }

        .class-table th {
            background-color: #1f2937;
            color: #00ff66;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .class-table th.text-center,
        .class-table td.text-center {
            text-align: center;
        }

        .class-table tr:hover {
            background-color: rgba(0, 255, 102, 0.05);
        }

        /* Nút Hành động (Sửa / Xóa) */
        .btn-action {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-right: 5px;
            transition: all 0.2s ease;
            display: inline-block;
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
            border: 1px solid #ff3333;
        }

        .btn-delete:hover {
            background-color: rgba(255, 51, 51, 0.2);
            box-shadow: 0 0 8px #ff3333;
        }

        /* Footer Bảng: Chứa info phân trang và nút phân trang */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-info {
            color: #8b949e;
            font-size: 0.95rem;
        }

        .page-info strong {
            color: #00ff66;
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
            cursor: pointer;
            font-family: inherit;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .page-link:hover:not(.disabled) {
            border-color: #00ff66;
            color: #00ff66;
            box-shadow: 0 0 8px rgba(0, 255, 102, 0.4);
        }

        .page-link.active {
            background-color: #00ff66;
            color: #0d1117;
            border-color: #00ff66;
            font-weight: bold;
        }

        .page-link.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Khi không có dữ liệu */
        .no-data {
            text-align: center !important;
            color: #8b949e;
            font-style: italic;
            padding: 30px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="main-title">Danh Sách Lớp Học</h1>

        <div class="toolbar">
            <a href="/lop/create" class="btn-add">+ Thêm Lớp</a>

            <div class="filter-group">
                <select id="limitSelect" class="form-select" onchange="applyFilters(1)">
                    <option value="5" <?= isset($limit) && $limit == 5 ? 'selected' : '' ?>>5 dòng/trang</option>
                    <option value="10" <?= !isset($limit) || $limit == 10 ? 'selected' : '' ?>>10 dòng/trang</option>
                    <option value="20" <?= isset($limit) && $limit == 20 ? 'selected' : '' ?>>20 dòng/trang</option>
                    <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50 dòng/trang</option>
                </select>

                <input type="text" id="searchInput" class="form-control"
                    value="<?php echo htmlspecialchars($_GET['search'] ?? ($search ?? '')); ?>"
                    placeholder="Tìm theo mã, tên, ghi chú..." style="width: 250px;">

                <button type="button" class="btn-search" onclick="applyFilters(1)">Tìm</button>
            </div>
        </div>

        <table class="class-table">
            <thead>
                <tr>
                    <th class="text-center" width="5%">STT</th>
                    <th width="20%">Mã Lớp</th>
                    <th width="30%">Tên Lớp</th>
                    <th width="25%">Ghi Chú</th>
                    <th class="text-center" width="20%">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data) && !empty($currentPage)): ?>
                    <?php
                    // Lấy limit hiện tại (mặc định là 10 nếu không có)
                    $currentLimit = isset($limit) ? $limit : 10;
                    $stt = ($currentPage - 1) * $currentLimit + 1;
                    ?>
                    <?php foreach ($data as $lop): ?>
                        <tr>
                            <td class="text-center"><?php echo $stt++; ?></td>
                            <td><?php echo htmlspecialchars($lop['ma_lop']); ?></td>
                            <td><?php echo htmlspecialchars($lop['ten_lop']); ?></td>
                            <td><?php echo htmlspecialchars($lop['ghi_chu']); ?></td>
                            <td class="text-center">
                                <a href="/lop/edit/<?php echo $lop['ma_lop']; ?>" class="btn-action btn-edit">Sửa</a>
                                <a href="/lop/delete/<?php echo $lop['ma_lop']; ?>" class="btn-action btn-delete"
                                    onclick="return confirm('Xóa lớp này sẽ xóa toàn bộ sinh viên thuộc lớp. Tiếp tục?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-data">Chưa có dữ liệu lớp học nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="table-footer">
            <div class="page-info">
                Trang <strong><?= isset($currentPage) ? $currentPage : 1 ?></strong> / <strong><?= !empty($totalPage) && $totalPage > 0 ? $totalPage : 1 ?></strong>
            </div>

            <?php if (!empty($totalPage) && $totalPage > 1): ?>
                <div class="pagination">
                    <button class="page-link <?= ($currentPage <= 1) ? 'disabled' : '' ?>"
                        <?= ($currentPage <= 1) ? 'disabled' : '' ?>
                        onclick="applyFilters(<?= $currentPage - 1 ?>)">Trước</button>

                    <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                        <button class="page-link <?= ($i == $currentPage) ? 'active' : '' ?>"
                            onclick="applyFilters(<?= $i ?>)"><?= $i ?></button>
                    <?php endfor; ?>

                    <button class="page-link <?= ($currentPage >= $totalPage) ? 'disabled' : '' ?>"
                        <?= ($currentPage >= $totalPage) ? 'disabled' : '' ?>
                        onclick="applyFilters(<?= $currentPage + 1 ?>)">Sau</button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function applyFilters(page) {
            const limit = document.getElementById('limitSelect').value;
            let search = document.getElementById('searchInput').value.trim();

            // Cấu trúc URL mặc định: /lop/index/{page}/{limit}
            let url = `/lop/index/${page}/${limit}`;

            if (search !== "") {
                url += `/${encodeURIComponent(search)}`;
            }

            window.location.href = url;
        }

        // Bắt sự kiện Enter khi gõ vào ô tìm kiếm
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters(1);
            }
        });
    </script>
</body>

</html>