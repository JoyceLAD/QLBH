<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen export don hanng
// $username = $_SESSION['login'];
// $sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
// $id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

// $sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
// $result = mysqli_query($mysqli, $sql_check);
// $id_cty = mysqli_fetch_assoc($result)['id_cty'];
// $result1 = mysqli_num_rows($result);
//WHERE id_cty = '".$id_cty."'
$sql = "SELECT * FROM donhang ";
if(mysqli_query($mysqli, $sql)){
    $filename = "danh_sach_don_hang".date("Y-m-d_H-i-s").".txt";
    $file = fopen($filename, "w") or die("Error");
    while ($row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))) {
        fwrite($file, "ID DH: " . $row['id_donhang'] . ", ID KH: " . $row['id_kh'] . ",  Ten: " . $row['ten_donhang'].", Ngay: " . $row['ngay'] . "\n");
    }
    fclose($file);
}
    

?>

