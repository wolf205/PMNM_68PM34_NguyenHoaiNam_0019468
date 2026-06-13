<div class="container container-sm">
    <h1 class="main-title">Sửa Sinh Viên</h1>

    <?php if (!empty($student)): ?>
        <form action="/student/update/<?php echo $student['id']; ?>" method="POST">
            <div class="form-group">
                <label for="hoten">Họ Tên:</label>
                <input type="text" id="hoten" name="hoten" class="form-control" value="<?php echo htmlspecialchars($student['hoten']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gioitinh">Giới Tính:</label>
                <select id="gioitinh" name="gioitinh" class="form-select" required>
                    <option value="">--Chọn Giới Tính--</option>
                    <option value="Nam" <?php echo $student['gioitinh'] === 'Nam'  ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $student['gioitinh'] === 'Nữ'   ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $student['gioitinh'] === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mssv">MSSV:</label>
                <input type="text" id="mssv" name="mssv" class="form-control" value="<?php echo htmlspecialchars($student['mssv']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ma_lop">Lớp:</label>
                <select id="ma_lop" name="ma_lop" class="form-select" required>
                    <option value="">--Chọn Lớp--</option>
                    <?php $lopList = isset($lopList) ? $lopList : []; ?>
                    <?php foreach ($lopList as $lop): ?>
                        <option value="<?php echo htmlspecialchars($lop['ma_lop']); ?>" <?php echo $student['ma_lop'] === $lop['ma_lop'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($lop['ten_lop']); ?> (<?php echo htmlspecialchars($lop['ma_lop']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-top: 30px; display: flex; gap: 15px;">
                <button type="submit" class="btn btn-success">Cập Nhật</button>
                <a href="/student/index" class="btn btn-danger">Huỷ</a>
            </div>
        </form>
    <?php else: ?>
        <p>Không tìm thấy sinh viên. <a href="/student/index" style="color:#00ff66;">Quay lại</a></p>
    <?php endif; ?>
</div>