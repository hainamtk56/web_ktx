<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản</title>
</head>
<body>
    <form method="post">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap">
                        </td>
                    </tr>
                    <tr>
                        <td>MatKhau</td>
                        <td>
                            <input type="text" name="txtMatKhau">
                        </td>
                    </tr>
                    <tr>
                        <td>TenLTK</td>
                        <td>
                            <input type="text" name="txtTenLTK">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" name="btnLuu">Lưu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnLuu'])) {
        $conn = mysqli_connect("localhost", "root", "", "kytucxa");
        if (!$conn) {
            die("Kết nối thất bại");
            exit;
        }
        $TenDangNhap = $_POST['txtTenDangNhap'];
        $MatKhau = $_POST['txtMatKhau'];
        $TenLTK = $_POST['txtTenLTK'];

        $sql = "INSERT INTO taikhoan ( TenDangNhap,MatKhau,TenLTK) VALUES ( '$TenDangNhap','$MatKhau', '$TenLTK')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Insert error";
        } else {
            echo "Insert success";
        }
    }
    ?>
    <a href="../admin"><button><b>Quay lại trang đầu</b></button></a>
</body>
</html>
