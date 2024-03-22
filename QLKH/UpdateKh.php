<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$ten = $_POST['ten'];
$tuoi = $_POST['tuoi'];
$dia_chi = $_POST['dia_chi'];
$cong_ty = $_POST['cong_ty'];
$nghe_nghiep = $_POST['nghe_nghiep'];
$sql = "UPDATE khachhang SET dia_chi = '".$dia_chi."',cong_ty = '".$cong_ty."',nghe_nghiep = '".$nghe_nghiep."' WHERE ten = '".$ten."' AND tuoi = '".$tuoi."'";
$sql_updatekh = mysqli_query($mysqli, $sql);
if($sql_updatekh){
    echo "Chỉnh sửa thành công";
}else{
    echo "Chinhr sửa không thành công";
}
?>
