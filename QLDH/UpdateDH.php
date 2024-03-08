<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
//Kiem tra quyen truy cap don hang
$username = $_SESSION['login'];
$sql1 = "SELECT id_tk FROM taikhoan WHERE username = '".$username."'";
$id =mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['id_tk'];

$sql_check = "SELECT * FROM phanquyen WHERE id_tk = '".$id."'";
$result = mysqli_query($mysqli, $sql_check);
$result1 = mysqli_num_rows($result);
if($result1 <=0){
    echo"Khong co quyen them don hang";
    header("Location: http://localhost/QuanLyBanHang/customer.php");
}else{
    if(isset($_POST['updatedh'])){
        $tenkh = $_POST['tenkh'];
        $tencty = $_POST['tencty'];
        $tendh = $_POST['tendh'];
        $ngay = $_POST['ngay'];

        $tenkh1 = $_POST['tenkh1'];
        $tencty1 = $_POST['tencty1'];
        $tendh1 = $_POST['tendh1'];
        $ngay1 = $_POST['ngay1'];


        $sql1 = "SELECT * FROM khachhang WHERE ten = '".$tenkh."'";
        $sql2 = "SELECT * FROM congty WHERE ten_congty = '".$tencty."'";
        $sql3 = "SELECT * FROM khachhang WHERE ten = '".$tenkh1."'";
        $sql4 = "SELECT * FROM congty WHERE ten_congty = '".$tencty1."'";

        $result1 = mysqli_query($mysqli, $sql1);
        $result2 = mysqli_query($mysqli, $sql2);
        $result3 = mysqli_query($mysqli, $sql3);
        $result4 = mysqli_query($mysqli, $sql4);


        if($result1 && $result2 && $result3 && $result4){
            $id_kh = mysqli_fetch_assoc($result1)['id_kh'];
            $id_cty = mysqli_fetch_assoc($result2)['id_cty'];
            $id_kh1 = mysqli_fetch_assoc($result3)['id_kh'];
            $id_cty1 = mysqli_fetch_assoc($result4)['id_cty'];

            $sql3 ="UPDATE donhang SET id_kh = '".$id_kh1."',id_cty = '".$id_cty1."',ten_donhang = '".$tendh1."', ngay = '".$ngay1."' 
            WHERE id_kh = '".$id_kh."' AND id_cty = '".$id_cty."'AND ten_donhang = '".$tendh."'AND ngay = '".$ngay."'" ;
            $result3 = mysqli_query($mysqli, $sql3);
            if($result3){
                echo "Chinh sua don hang thanh cong";
            }else{
                echo "Chinh sua don hang khong thanh cong";
            }
        }else{
            echo "Ten khach hang hoac ten cong ty khong ton tai";
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
                    <td>Chinh sua don hang</td>
                </tr>
                <tr>
                    <td>Ten khach hang</td>
                    <td><input type="text" name="tenkh"></td>
                </tr>
                <tr>
                    <td>Ten cong ty</td>
                    <td><input type="text" name="tencty"></td>
                </tr>
                <tr>
                    <td>Ten don hang</td>
                    <td><input type="text" name="tendh"></td>
                </tr>
                <tr>
                    <td>Ngay</td>
                    <td><input type="date" name="ngay"></td>
                </tr>

                <td>Ten khach hang muon sua</td>
                    <td><input type="text" name="tenkh1"></td>
                </tr>
                <tr>
                    <td>Ten cong ty muon sua</td>
                    <td><input type="text" name="tencty1"></td>
                </tr>
                <tr>
                    <td>Ten don hang muon sua</td>
                    <td><input type="text" name="tendh1"></td>
                </tr>
                <tr>
                    <td>Ngay muon sua</td>
                    <td><input type="date" name="ngay1"></td>
                </tr>



                <tr>
                    <td><input type="submit" name="updatedh" value="Chinh sua don hang"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
