<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['id_kh'])) {
    $id_kh = $_POST['id_kh'];

    $sql = "DELETE FROM khachhang WHERE id_kh = '".$id_kh."'";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        echo "Xóa khách hàng thành công";
    } else {
        echo "Xóa khách hàng không thành công";
    }
} else {
    echo "Xóa khách hàng không thành công";
}
?>
