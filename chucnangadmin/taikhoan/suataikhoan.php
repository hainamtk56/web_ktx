<?php
$conn = mysqli_connect("localhost", "root", "", "kytucxa");
if (!$conn) {
    die("Kết nối thất bại");
}

$TenDangNhap = $_GET['TenDangNhap'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnGhi'])) {
    // Lấy tên đăng nhập mới từ form
    $TenDangNhapMoi = $_POST['txtTenDangNhap'];

    // Truy vấn để kiểm tra tính duy nhất của tên đăng nhập (ngoại trừ tên đăng nhập đang sửa)
    $sqlCheckExist = "SELECT * FROM taikhoan WHERE TenDangNhap = '$TenDangNhapMoi'";
    $resultCheckExist = mysqli_query($conn, $sqlCheckExist);

    if (mysqli_num_rows($resultCheckExist) > 0) {
        echo "Lỗi: Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
    } else {
        // Tiếp tục cập nhật thông tin tài khoản
        $sqlUpdate = "UPDATE taikhoan SET TenDangNhap = '$TenDangNhapMoi', MatKhau = '" . $_POST['txtMatKhau'] . "', TenLTK = '" . $_POST['txtTenLTK'] . "' WHERE TenDangNhap = '" . $TenDangNhap . "'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        if ($resultUpdate) {
            echo "Sửa thông tin thành công";
        } else {
            echo "Lỗi SQL: " . mysqli_error($conn);
        }

        // Cập nhật lại biến $TenDangNhap sau khi cập nhật
        $TenDangNhap = $TenDangNhapMoi;
    }
}

$sql = "SELECT * FROM taikhoan WHERE TenDangNhap = '" . $TenDangNhap . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Không tìm thấy tài khoản có tên đăng nhập: " . $TenDangNhap;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa</title>
</head>
<body>
    <form method="POST">
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>TenDangNhap</td>
                        <td>
                            <input type="text" name="txtTenDangNhap" value="<?php echo $row['TenDangNhap']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>MatKhau</td>
                        <td>
                            <input type="text" name="txtMatKhau" value="<?php echo $row['MatKhau']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>TenLTK</td>
                        <td>
                            <input type="text" name="txtTenLTK" value="<?php echo $row['TenLTK']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" name="btnGhi">Ghi Dữ Liệu</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
    <a href="../admin"><button>Quay lại trang chủ</button></a>
</body>
</html>
