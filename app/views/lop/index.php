<div class="container">
    <h1 class="main-title">Danh Sách Lớp Học</h1>

    <div class="toolbar">
        <a href="/lop/create" class="btn btn-success">+ Thêm Lớp</a>

        <div class="filter-group">
            <select id="limitSelect" class="form-select" onchange="applyFilters(1)" style="width: auto;">
                <option value="5" <?= isset($limit) && $limit == 5 ? 'selected' : '' ?>>5 dòng/trang</option>
                <option value="10" <?= !isset($limit) || $limit == 10 ? 'selected' : '' ?>>10 dòng/trang</option>
                <option value="20" <?= isset($limit) && $limit == 20 ? 'selected' : '' ?>>20 dòng/trang</option>
                <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50 dòng/trang</option>
            </select>

            <input type="text" id="searchInput" class="form-control"
                value="<?php echo htmlspecialchars($_GET['search'] ?? ($search ?? '')); ?>"
                placeholder="Tìm theo mã, tên, ghi chú..." style="width: 250px;">

            <button type="button" class="btn btn-success" onclick="applyFilters(1)">Tìm kiếm</button>
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