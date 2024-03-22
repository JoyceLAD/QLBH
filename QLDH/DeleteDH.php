<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$tenkh = $_POST['tenkh'];
$tencty = $_POST['tencty'];
$tendh = $_POST['tendh'];
$ngay = $_POST['ngay'];

$sql1 = "SELECT * FROM khachhang WHERE ten = '".$tenkh."'";
$sql2 = "SELECT * FROM congty WHERE ten_congty = '".$tencty."'";
$result1 = mysqli_query($mysqli, $sql1);
$result2 = mysqli_query($mysqli, $sql2);

if($result1 && $result2){
    $id_kh = mysqli_fetch_assoc($result1)['id_kh'];
    $id_cty = mysqli_fetch_assoc($result2)['id_cty'];
    $sql3 = "DELETE FROM donhang WHERE id_kh = '".$id_kh."' AND id_cty = '".$id_cty."' AND ten_donhang = '".$tendh."' AND ngay = '".$ngay."'";
    $result3 = mysqli_query($mysqli, $sql3);
    if($result3){
        echo "Xóa đơn hàng thành công";
    }else{
        echo "Xóa đơn hàng thành công";
    }
}else{
    echo "Tên khách hàng hoặc tên công ty không tồn tại";
}
?>



