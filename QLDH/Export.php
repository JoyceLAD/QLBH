<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$sql = "SELECT * FROM donhang 
where donhang.id_cty = '".$_SESSION['id_cty_tk']."'" ;
$result = mysqli_query($mysqli, $sql);
if ($result) {
    $filename = "danh_sach_don_hang" . date("Y-m-d_H-i-s") . ".txt";
    $file = fopen($filename, "w") or die("Error");
    while ($row = mysqli_fetch_assoc($result)) {
        fwrite($file, "ID: " . $row['id_donhang'] . ", Mã khách hàng: " . $row['id_kh'] . ",Tên đơn hàng: " . $row['ten_donhang'] . ", Ngày: " . $row['ngay'] . "\n");
    }
    fclose($file);
    echo "Tạo file thành công!";
} else {
    echo "Lỗi truy vấn!";
}
?>
