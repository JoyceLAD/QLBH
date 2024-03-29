<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['id_donhang'])) {
    $id_donhang = $_POST['id_donhang'];

    $sql = "DELETE FROM donhang WHERE id_donhang = '".$id_donhang."'";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        echo "Xóa đơn hàng thành công";
    } else {
        echo "Xóa đơn hàng không thành công";
    }
} else {
    echo "Xóa đơn hàng không thành công";
}
?>
