<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ten = $_POST['ten'];
    $sql = "INSERT INTO taikhoan(username,password,ten ) VALUES('".$username."', '".$password."', '".$ten."')";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        echo "Thêm tài khoản thành công";
    }else{
        echo "Thêm tài khoản không thành công";
    }


?>

