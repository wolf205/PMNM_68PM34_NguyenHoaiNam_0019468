<div class="container container-sm">
    <h1 class="main-title">Sửa Lớp Học</h1>

    <?php if (!empty($lop)): ?>
        <form action="/lop/update/<?php echo $lop['ma_lop']; ?>" method="POST">
            <div class="form-group">
                <label>Mã Lớp:</label>
                <input type="text" value="<?php echo htmlspecialchars($lop['ma_lop']); ?>" class="form-control" disabled>
                <input type="hidden" name="ma_lop" value="<?php echo htmlspecialchars($lop['ma_lop']); ?>">
            </div>

            <div class="form-group">
                <label for="ten_lop">Tên Lớp:</label>
                <input type="text" id="ten_lop" name="ten_lop" class="form-control" value="<?php echo htmlspecialchars($lop['ten_lop']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ghi_chu">Ghi Chú:</label>
                <textarea id="ghi_chu" name="ghi_chu" class="form-control"><?php echo htmlspecialchars($lop['ghi_chu']); ?></textarea>
            </div>

            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button type="submit" class="btn btn-success">Cập Nhật</button>
                <a href="/lop/index" class="btn btn-danger">Huỷ</a>
            </div>
        </form>
    <?php else: ?>
        <p>Không tìm thấy lớp học. <a href="/lop/index" style="color: #00ff66;">Quay lại</a></p>
    <?php endif; ?>
</div>