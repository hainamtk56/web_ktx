<?php
    include_once('../config/database.php');
    @session_start();

    if (isset($_SESSION['nv'])) {
        header('Location:index.php');
    }

    if (isset($_POST['login'])) {
        $ma = $_POST['manv'];
        $mk = $_POST['pass'];
        $sql_dangnhap = "SELECT * FROM taikhoan WHERE TenDangNhap = '".$ma."' && MatKhau = '".$mk."'";
        $run_dangnhap = mysqli_query($conn, $sql_dangnhap);
        $dangnhap = mysqli_fetch_array($run_dangnhap);
        $count_dangnhap = mysqli_num_rows($run_dangnhap);
        
        if ($count_dangnhap == 0) {
            echo '<script>alert("Sai tài khoản hoặc mật khẩu!")</script>';
        } else {
            $sql_nhanvien = "SELECT * FROM nhanvien WHERE MaNV = '".$ma."'";
            $run_nhanvien = mysqli_query($conn, $sql_nhanvien);
            $nhanvien = mysqli_fetch_array($run_nhanvien);
            $_SESSION['nv'] = $nhanvien;
            header('location:index.php');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
</head>
<body>
    <div class="box">
        <span class="borderline">
            <form method="POST" action="dangnhap.php" class="form-box">
                <h2>Đăng nhập tài khoản nhân viên</h2>
                <div class="inputBox">
                    <input type="text" id="inputEmail" name="manv" required autofocus>
                    <span>Mã nhân viên</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" id="inputPassword" name="pass" required>
                    <span>Mật khẩu</span>
                    <i></i>
                </div>
                <div class="links">
                    <a href="../admin/dangky.php">Chưa có tài khoản</a>
                    <a href="../admin/quenmatkhau.php">Quên mật khẩu</a>
                </div>
                <input type="submit" name="login" value="Đăng nhập">
            </form>
        </span>
    </div>
</body>
</html>