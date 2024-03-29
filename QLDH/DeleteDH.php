<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$id_kh = $_POST['id_kh'];
// $tencty = $_POST['tencty'];
$tendh = $_POST['tendh'];
$ngay = $_POST['ngay'];
$id_cty =  $_SESSION['id_cty_tk'] ;
$id_dh = $_POST['id_dh'];


$sql1 = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh."'";
$sql2 = "SELECT * FROM donhang WHERE id_donhang = '".$id_dh."'";
$result1 = mysqli_query($mysqli, $sql1);
$result2 = mysqli_query($mysqli, $sql2);

if(mysqli_num_rows($result1) >0 && mysqli_num_rows($result2)>0 ){
    // $id_kh = mysqli_fetch_assoc($result1)['id_kh'];
    // $id_cty = mysqli_fetch_assoc($result2)['id_cty'];
    $sql3 = "DELETE FROM donhang WHERE id_kh = '".$id_kh."' AND id_cty = '".$id_cty."' AND ten_donhang = '".$tendh."' AND ngay = '".$ngay."' AND id_donhang = '".$id_dh."'";
    $result3 = mysqli_query($mysqli, $sql3);
    if($result3){
        echo "Xóa đơn hàng thành công";
    }else{
        echo "Xóa đơn hàng thành công";
    }
}else{
    echo "Mã khách hàng hoặc mã đơn hàng không tồn tại";
}
?>



