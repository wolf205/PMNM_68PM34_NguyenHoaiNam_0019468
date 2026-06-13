<div class="container">
    <h1 class="main-title">Danh Sách Sinh Viên</h1>

    <?php
    // Ensure pagination variables are defined to avoid undefined variable notices
    $currentPage = isset($currentPage) ? $currentPage : 1;
    $limit = isset($limit) ? $limit : 10;
    ?>

    <div class="toolbar">
        <a href="/student/create" class="btn btn-success">+ Thêm Sinh viên</a>

        <div class="filter-group">
            <select id="limitSelect" class="form-select" onchange="applyFilters(1)" style="width: auto;">
                <option value="5" <?= isset($limit) && $limit == 5 ? 'selected' : '' ?>>5 dòng/trang</option>
                <option value="10" <?= !isset($limit) || $limit == 10 ? 'selected' : '' ?>>10 dòng/trang</option>
                <option value="20" <?= isset($limit) && $limit == 20 ? 'selected' : '' ?>>20 dòng/trang</option>
                <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50 dòng/trang</option>
            </select>

            <input type="text" id="searchInput" class="form-control"
                value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                placeholder="Nhập MSSV, Tên hoặc Lớp..." style="width: 250px;">

            <button type="button" class="btn btn-success" onclick="applyFilters(1)">Tìm kiếm</button>
        </div>
    </div>

    <table class="class-table">
        <thead>
            <tr>
                <th class="text-center" width="5%">STT</th>
                <th width="15%">MSSV</th>
                <th width="25%">Họ và tên</th>
                <th width="15%">Giới tính</th>
                <th width="20%">Tên lớp</th>
                <th class="text-center" width="20%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php
                // Tính STT
                $currentPg = isset($currentPage) ? $currentPage : 1;
                $lim = isset($limit) ? $limit : 10;
                $stt = ($currentPg - 1) * $lim + 1;
                ?>
                <?php foreach ($students as $sv): ?>
                    <tr>
                        <td class="text-center"><?= $stt++ ?></td>
                        <td><?= htmlspecialchars($sv['mssv']) ?></td>
                        <td><?= htmlspecialchars($sv['hoten']) ?></td>
                        <td><?= htmlspecialchars($sv['gioitinh']) ?></td>
                        <td><?= htmlspecialchars($sv['ten_lop']) ?></td>
                        <td class="text-center">
                            <a href="/student/edit/<?= $sv['id'] ?>" class="btn-action btn-edit">Sửa</a>
                            <a href="/student/delete/<?= $sv['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Không tìm thấy dữ liệu sinh viên.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="table-footer">
        <div class="page-info">
            Trang <strong><?= isset($currentPage) ? $currentPage : 1 ?></strong> / <strong><?= isset($totalPage) && $totalPage > 0 ? $totalPage : 1 ?></strong>
        </div>

        <?php if (isset($totalPage) && $totalPage > 1): ?>
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

        let url = `/student/index/${page}/${limit}`;

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