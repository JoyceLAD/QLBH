<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$ten = $_POST['ten'];
$tuoi = $_POST['tuoi'];
$id_kh = $_POST['id_kh'];
$sql1 = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh."'";
$result1 = mysqli_query($mysqli, $sql1);
if(mysqli_num_rows($result1)>0){
    $sql = "DELETE FROM khachhang 
    WHERE khachhang.ten = '".$ten."' AND khachhang.tuoi = '".$tuoi."' AND khachhang.id_kh = '".$id_kh."'";
    $sql_deletekh = mysqli_query($mysqli, $sql);
    if (!$sql_deletekh) {
        echo "Lỗi: " . mysqli_error($mysqli);
    }else{
        echo "Xóa khách hàng thành công";
    }  
}else{
    echo "Mã khách hàng không tồn tại";
}
?>
