<?php
session_start();
require_once 'PHPExcel/Classes/PHPExcel.php';
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen import khach hanng
$username = $_SESSION['login'];
$sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
$id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

$sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
$result = mysqli_query($mysqli, $sql_check);
$result1 = mysqli_num_rows($result);
if($result1 <=0){
    echo"Khong co quyen them khach hang";
    header("Location: http://localhost/QuanLyBanHang/customer.php");
}
if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $excel = PHPExcel_IOFactory::load($file);
    $sheet = $excel->getActiveSheet();
    foreach ($sheet->getRowIterator() as $row) {
        $rowData = $row->getCellIterator();
        $data = array();
        
        // Lặp qua từng ô trong dòng
        foreach ($rowData as $cell) {
            $data[] = $cell->getValue();
        }

        // Thực hiện truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO khachhang (ten, tuoi, dia_chi, nghe_nghiep) VALUES (?, ?, ?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("siss", $data[0], $data[1], $data[2], $data[3]);
        $stmt->execute();
        $stmt->close();
    }

    echo "Import thành công!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <input type="submit" value="import" name="submit">;
    </form>
</body>
</html>
