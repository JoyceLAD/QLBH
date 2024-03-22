<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
    $username = $_POST['username'];
    $ten = $_POST['ten'];
    $sql = "DELETE FROM taikhoan WHERE username = '".$username."' AND ten ='".$ten."'";
    $sql_delete = mysqli_query($mysqli, $sql);
    if($sql_delete){
        echo "Xóa thành công";
    }else{
        echo "Xóa không thành công";
    }

?>

