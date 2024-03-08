<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen chinh sua khach hanng
$username = $_SESSION['login'];
$sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
$id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

$sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
$result = mysqli_query($mysqli, $sql_check);
$result1 = mysqli_num_rows($result);
if($result1 <=0){
    echo"Khong co quyen them khach hang";
    header("Location: http://localhost/QuanLyBanHang/customer.php");
}else{
    if(isset($_POST['updatekh'])){
        $ten = $_POST['ten'];
        $tuoi = $_POST['tuoi'];
        $dia_chi = $_POST['dia_chi'];
        $cong_ty = $_POST['cong_ty'];
        $nghe_nghiep = $_POST['nghe_nghiep'];
        $sql = "UPDATE khachhang SET dia_chi = '".$dia_chi."',cong_ty = '".$cong_ty."',nghe_nghiep = '".$nghe_nghiep."' WHERE ten = '".$ten."' AND tuoi = '".$tuoi."'";
        $sql_updatekh = mysqli_query($mysqli, $sql);
        if($sql_updatekh){
            echo "Chinh sua thành công";
        }else{
            echo "Chinh sua không thành công";
        }
    
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản</title>
</head>
<body>
    <div>

    </div>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Chinh sua khach hang</td>
                </tr>
                <tr>
                    <td>Ten</td>
                    <td><input type="text" name="ten"></td>
                </tr>
                <tr>
                    <td>Tuoi</td>
                    <td><input type="number" name="tuoi"></td>
                </tr>

                <!-- //cac truong co the thay doi -->
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
                </tr>

                <tr>
                    <td><input type="submit" name="updatekh" value="Chinh sua khach hang"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
