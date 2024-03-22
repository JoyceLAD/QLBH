<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen export khach hanng
// $username = $_SESSION['login'];
// $sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
// $id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

// $sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
// $result = mysqli_query($mysqli, $sql_check);
// $result1 = mysqli_num_rows($result);
// if($result1 <=0){
//     echo"Khong co quyen them khach hang";
//     header("Location: http://localhost/QuanLyBanHang/customer.php");
// }else{
    // if(isset($_POST['export'])){
// $sql = "SELECT * FROM khachhang ";
// if(mysqli_query($mysqli, $sql)){
//     $filename = "danh_sach_khach_hang".date("Y-m-d_H-i-s").".txt";
//     $file = fopen($filename, "w") or die("Error");
//     while ($row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))) {
//         fwrite($file, "ID: " . $row['id_kh'] . ", Tên: " . $row['ten'] . ", Địa chỉ: " . $row['dia_chi'] . "\n");
//     }
//     fclose($file);
// }
    // }
// }

$sql = "SELECT * FROM khachhang";
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

