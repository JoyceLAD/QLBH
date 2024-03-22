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

$tenkh1 = $_POST['tenkh1'];
$tencty1 = $_POST['tencty1'];
$tendh1 = $_POST['tendh1'];
$ngay1 = $_POST['ngay1'];


$sql1 = "SELECT * FROM khachhang WHERE ten = '".$tenkh."'";
$sql2 = "SELECT * FROM congty WHERE ten_congty = '".$tencty."'";
$sql3 = "SELECT * FROM khachhang WHERE ten = '".$tenkh1."'";
$sql4 = "SELECT * FROM congty WHERE ten_congty = '".$tencty1."'";

$result1 = mysqli_query($mysqli, $sql1);
$result2 = mysqli_query($mysqli, $sql2);
$result3 = mysqli_query($mysqli, $sql3);
$result4 = mysqli_query($mysqli, $sql4);


if($result1 && $result2 && $result3 && $result4){
    $id_kh = mysqli_fetch_assoc($result1)['id_kh'];
    $id_cty = mysqli_fetch_assoc($result2)['id_cty'];
    $id_kh1 = mysqli_fetch_assoc($result3)['id_kh'];
    $id_cty1 = mysqli_fetch_assoc($result4)['id_cty'];

    $sql3 ="UPDATE donhang SET id_kh = '".$id_kh1."',id_cty = '".$id_cty1."',ten_donhang = '".$tendh1."', ngay = '".$ngay1."' 
    WHERE id_kh = '".$id_kh."' AND id_cty = '".$id_cty."'AND ten_donhang = '".$tendh."'AND ngay = '".$ngay."'" ;
    $result3 = mysqli_query($mysqli, $sql3);
    if($result3){
        echo "Chỉnh sửa đơn hàng thành công";
    }else{
        echo "Chỉnh sửa đơn hàng không thành công";
    }
    }else{
    echo "Tên khách hàng hoặc tên công ty không tồn tại";
}
?>

