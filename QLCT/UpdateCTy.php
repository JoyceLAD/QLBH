<?php
$mysqli = new mysqli("localhost", "root", "", "qlbh");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$ten_congty = $_POST['ten_congty'];
$admincty = $_POST['admincty'];
$giamdoc = $_POST['giamdoc'];

$idadmincty = "SELECT id_tk FROM taikhoan WHERE username = '".$admincty."'";
$idgiamdoccty = "SELECT id_tk FROM taikhoan WHERE username = '".$giamdoc."'";

$r1 = mysqli_query($mysqli, $idadmincty);
$r2 = mysqli_query($mysqli, $idgiamdoccty);

if ($r1 && $r2) {
    if(mysqli_num_rows($r1) > 0 && mysqli_num_rows($r2) > 0) {
        $id_admincty = mysqli_fetch_assoc($r1)['id_tk'];
        $id_giamdoc = mysqli_fetch_assoc($r2)['id_tk'];

        $sql3 = "UPDATE congty SET id_giamdoc='".$id_giamdoc."', id_admincty='".$id_admincty."' WHERE ten_congty='".$ten_congty."'";

        if ($mysqli->query($sql3) === TRUE) {
            echo "Chỉnh sửa công ty thành công";
        } else {
            echo "Error: " . $sql3 . "<br>" . $mysqli->error;
        }
    } else {
        echo "Không tìm thấy thông tin người dùng";
    }
} else {
    echo "Error";
}

?>
