<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
    $username = $_POST['username'];
    $ten = $_POST['ten'];
    $password = md5($_POST['password']);
    $sql = "UPDATE taikhoan SET password = '".$password."', ten = '".$ten."' WHERE username = '".$username."'";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        echo "Cập nhật thành công";
    }else{
        echo "Cập nhật không thành công";
    }

?>

