<div class="container container-sm">
    <h1 class="main-title">Thêm Sinh Viên</h1>

    <form action="/student/store" method="POST">
        <div class="form-group">
            <label for="hoten">Họ Tên:</label>
            <input type="text" id="hoten" name="hoten" class="form-control" placeholder="Nhập họ và tên..." required>
        </div>

        <div class="form-group">
            <label for="gioitinh">Giới Tính:</label>
            <select id="gioitinh" name="gioitinh" class="form-select" required>
                <option value="">--Chọn Giới Tính--</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
        </div>

        <div class="form-group">
            <label for="mssv">MSSV:</label>
            <input type="text" id="mssv" name="mssv" class="form-control" placeholder="Nhập mã số sinh viên..." required>
        </div>

        <div class="form-group">
            <label for="ma_lop">Lớp:</label>
            <select id="ma_lop" name="ma_lop" class="form-select" required>
                <option value="">--Chọn Lớp--</option>
                <?php $lopList = isset($lopList) ? $lopList : []; ?>
                <?php foreach ($lopList as $lop): ?>
                    <option value="<?php echo htmlspecialchars($lop['ma_lop']); ?>">
                        <?php echo htmlspecialchars($lop['ten_lop']); ?> (<?php echo htmlspecialchars($lop['ma_lop']); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 15px;">
            <button type="submit" class="btn btn-success">Tạo Sinh Viên</button>
            <a href="/student/index" class="btn btn-danger">Huỷ</a>
        </div>
    </form>
</div>