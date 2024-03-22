<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$ten = $_POST['ten'];
$tuoi = $_POST['tuoi'];
$sql = "DELETE FROM khachhang WHERE khachhang.ten = '".$ten."' AND khachhang.tuoi = '".$tuoi."'";
$sql_deletekh = mysqli_query($mysqli, $sql);
if (!$sql_deletekh) {
    echo "Lỗi: " . mysqli_error($mysqli);
}else{
    echo "Xóa khách hàng thành công";
}  
?>
