<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
</head>

<body>
    <h1>Create Student</h1>
    <form action="/student/store" method="POST">
        <label for="hoten">Họ Tên:</label><br>
        <input type="text" id="hoten" name="hoten" required><br><br>

        <label for="gioitinh">Giới Tính:</label><br>
        <select id="gioitinh" name="gioitinh" required>
            <option value="">--Chọn Giới Tính--</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>

        <label for="mssv">MSSV:</label><br>
        <input type="text" id="mssv" name="mssv" required><br><br>

        <input type="submit" value="Create">
    </form>
</body>

</html>