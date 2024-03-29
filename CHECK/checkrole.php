<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$username_admin = $_SESSION['login'];
$sql = "SELECT * FROM taikhoan WHERE username='".$username_admin."'";
$id_admincty = mysqli_query($mysqli, $sql);
$id_admin = mysqli_fetch_assoc($id_admincty)['id_tk'];

$check = "SELECT * FROM congty WHERE id_admincty='".$id_admin."'";
$result = mysqli_query($mysqli, $check);


if(mysqli_num_rows($result)>0){
    echo "1";
    $_SESSION['id_cty_tk'] = mysqli_fetch_assoc($result)['id_cty'];
}else{
    echo "0";
}
?>
