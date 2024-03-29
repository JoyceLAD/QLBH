<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$id_donhang = $_POST['id_donhang'];
$id_kh1 = $_POST['id_kh1'];
$tendh1 = $_POST['tendh1'];
$ngay1 = $_POST['ngay1'];
$id_cty =  $_SESSION['id_cty_tk'] ;


$sql2 = "SELECT * FROM donhang WHERE id_donhang = '".$id_donhang."' AND id_cty = '".$id_cty."'";
$sql3 = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh1."'";

$result2 = mysqli_query($mysqli, $sql2);
$result3 = mysqli_query($mysqli, $sql3);


if( mysqli_num_rows($result2)>0 && mysqli_num_rows($result3)>0){
    $sql ="UPDATE donhang SET id_kh = '".$id_kh1."',ten_donhang = '".$tendh1."', ngay = '".$ngay1."' 
    WHERE id_donhang = '".$id_donhang."'" ;
    $result = mysqli_query($mysqli, $sql);
    if($result){
        echo "Chỉnh sửa đơn hàng thành công";
    }else{
        echo "Chỉnh sửa đơn hàng không thành công";
    }
    }else{
    echo "Mã khách hàng muốn sửa không tồn tại hoặc mã đơn hàng không tồn tại";
}
?>

