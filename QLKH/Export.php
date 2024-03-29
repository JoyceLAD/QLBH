<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$sql = "SELECT DISTINCT khachhang.id_kh, khachhang.ten, khachhang.dia_chi
        FROM khachhang 
        INNER JOIN donhang ON khachhang.id_kh = donhang.id_kh
        WHERE donhang.id_cty = '".$_SESSION['id_cty_tk']."'";
$result = mysqli_query($mysqli, $sql);
if ($result) {
    $filename = "danh_sach_khach_hang" . date("Y-m-d_H-i-s") . ".txt";
    $file = fopen($filename, "w") or die("Error");
    while ($row = mysqli_fetch_assoc($result)) {
        fwrite($file, "ID: " . $row['id_kh'] . ", Tên: " . $row['ten'] . ", Địa chỉ: " . $row['dia_chi'] . "\n");
    }
    fclose($file);
    echo "Tạo file thành công!";
} else {
    echo "Lỗi truy vấn!";
}
?>
