<?php
session_start();
$mysqli = new mysqli("localhost","root","","qlbh");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}$user_name = $_SESSION['login'];
$sql = "SELECT * FROM phanquyen inner join taikhoan
on phanquyen.id_tk = taikhoan.id_tk
where taikhoan.username = '".$user_name."'";

$result = mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)>0){
    echo "1";
    $_SESSION['id_cty_tk'] = mysqli_fetch_assoc($result)['id_cty'];
}else{
    echo "0";
}
?>