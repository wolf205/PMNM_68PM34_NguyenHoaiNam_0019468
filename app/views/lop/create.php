<div class="container container-sm">
    <h1 class="main-title">Thêm Lớp Học</h1>

    <form action="/lop/store" method="POST">
        <div class="form-group">
            <label for="ma_lop">Mã Lớp:</label>
            <input type="text" id="ma_lop" name="ma_lop" class="form-control" placeholder="Ví dụ: 68PM1" required>
        </div>

        <div class="form-group">
            <label for="ten_lop">Tên Lớp:</label>
            <input type="text" id="ten_lop" name="ten_lop" class="form-control" placeholder="Ví dụ: Công nghệ thông tin 1" required>
        </div>

        <div class="form-group">
            <label for="ghi_chu">Ghi Chú:</label>
            <textarea id="ghi_chu" name="ghi_chu" class="form-control" placeholder="Ghi chú về lớp học..."></textarea>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 15px;">
            <button type="submit" class="btn btn-success">Tạo Lớp</button>
            <a href="/lop/index" class="btn btn-danger">Huỷ</a>
        </div>
    </form>
</div>