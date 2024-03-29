<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

//Phan Quyen
$user_name = $_POST['username'];
$id_congty = $_SESSION['id_cty_tk'];
$sql1 = "SELECT id_tk FROM `taikhoan` WHERE username='".$user_name."'";
$r1 = mysqli_query($mysqli, $sql1);
if (mysqli_num_rows($r1)) {
    $id_taikhoan = mysqli_fetch_assoc($r1)['id_tk'];
    
    $sql3 = "INSERT INTO phanquyen(id_tk, id_cty) VALUES('$id_taikhoan', '$id_congty')";
    $result = mysqli_query($mysqli, $sql3);
    if ($result) {
        echo "Phân quyền thành công";
    } else {
        echo "Error: ";
    }
} else {
    echo $_POST['username'];
}

?>
