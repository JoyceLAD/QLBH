<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$id_kh = $_POST['id_kh'];
// $tenkh = $_POST['tenkh'];
// $tencty = $_POST['tencty'];
$tendh = $_POST['tendh'];
$ngay = $_POST['ngay'];
$id_cty =  $_SESSION['id_cty_tk'] ;

$sql1 = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh."'";
// $sql2 = "SELECT * FROM congty WHERE ten_congty = '".$tencty."'";
$result1 = mysqli_query($mysqli, $sql1);
// $result2 = mysqli_query($mysqli, $sql2);

if(mysqli_num_rows($result1) >0){
    // $id_kh = mysqli_fetch_assoc($result1)['id_kh'];
    // $id_cty = mysqli_fetch_assoc($result2)['id_cty'];
    $sql3 = "INSERT INTO donhang(id_kh, id_cty,ten_donhang, ngay) VALUES('".$id_kh."', '".$id_cty."', '".$tendh."', '".$ngay."')";
    $result3 = mysqli_query($mysqli, $sql3);
    if($result3){
        echo "Thêm đơn hàng thành công".mysqli_insert_id($mysqli);
    }else{
        echo "Thêm đơn hàng không thành công";
    }
}else{
    echo "Mã khách hàng không tồn tại";
}
?>

