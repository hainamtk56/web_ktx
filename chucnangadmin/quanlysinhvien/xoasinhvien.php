<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $conn= mysqli_connect("localhost","root","","kytucxa");
    if(!$conn){
        die("Ket noi that bai");
    } else {
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            $sql= "DELETE FROM sinhvien WHERE MaSV = '".$_GET['MaSV']."'";
            $result= mysqli_query($conn,$sql);
            if(!$result){
                echo "Xóa thất bại";
            } else {
                echo "Xóa thành côngg";
            }
        }
    }
    header("location:index.php?action=sinhvien");
    ?>
</body>
</html>
