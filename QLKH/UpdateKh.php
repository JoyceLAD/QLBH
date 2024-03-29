<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$id_kh = $_POST['id_kh'];
$ten = $_POST['ten'];
$tuoi = $_POST['tuoi'];
$dia_chi = $_POST['dia_chi'];
$cong_ty = $_POST['cong_ty'];
$nghe_nghiep = $_POST['nghe_nghiep'];
$sql1 = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh."'";
$result1 = mysqli_query($mysqli, $sql1);
if(mysqli_num_rows($result1)>0){
    $sql = "UPDATE khachhang SET ten = '".$ten."', tuoi = '".$tuoi."' , dia_chi = '".$dia_chi."',cong_ty = '".$cong_ty."',nghe_nghiep = '".$nghe_nghiep."' WHERE id_kh = '".$id_kh."'";
    $sql_updatekh = mysqli_query($mysqli, $sql);
    if($sql_updatekh){
        echo "Chỉnh sửa thành công";
    }else{
        echo "Chỉnh sửa không thành công";
    }
}else{
    echo "Mã khách hàng không tồn tại";
}
?>
