<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen export don hanng
$username = $_SESSION['login'];
$sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
$id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

$sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
$result = mysqli_query($mysqli, $sql_check);
$id_cty = mysqli_fetch_assoc($result)['id_cty'];
$result1 = mysqli_num_rows($result);
if($result1 <=0){
    echo"Khong co quyen them khach hang";
    header("Location: http://localhost/QuanLyBanHang/customer.php");
}else{
    if(isset($_POST['export'])){
        $sql = "SELECT * FROM donhang WHERE id_cty = '".$id_cty."'  ";
        if(mysqli_query($mysqli, $sql)){
            $filename = "danh_sach_don_hang".date("Y-m-d_H-i-s").".txt";
            $file = fopen($filename, "w") or die("Error");
            while ($row = mysqli_fetch_assoc(mysqli_query($mysqli, $sql))) {
                fwrite($file, "ID DH: " . $row['id_donhang'] . ", ID KH: " . $row['id_kh'] . ",  Ten: " . $row['ten_donhang'].", Ngay: " . $row['ngay'] . "\n");
            }
            fclose($file);
        }
//         $sql = "SELECT * INTO OUTFILE 'C:\Users\Duyla\dskh.sql' FROM khachhang";
//         if (mysqli_query($mysqli, $sql)) {
//         echo "Database backup successfully created!";
//         } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
// }
    
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xuat don hang</title>
</head>
<body>
    <div>

    </div>
    <div>
        <form action="" method="post">
            <!-- <table>
                <tr>
                    <td>Xoa khach hang</td>
                </tr>
                <tr>
                    <td>Ten</td>
                    <td><input type="text" name="ten"></td>
                </tr>
                <tr>
                    <td>Tuoi</td>
                    <td><input type="number" name="tuoi"></td>
                </tr>
                <tr>
                    <td>Dia chi</td>
                    <td><input type="text" name="dia_chi"></td>
                </tr>
                <tr>
                    <td>Cong ty</td>
                    <td><input type="text" name="cong_ty"></td>
                </tr>
                <tr>
                    <td>Nghe nghiep</td>
                    <td><input type="text" name="nghe_nghiep"></td>
                </tr> -->
                <tr>
                    <td><input type="submit" name="export" value="Xuar danh sach don hang"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
