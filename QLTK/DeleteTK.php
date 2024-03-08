<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['deletetk'])){
    $username = $_POST['username'];
    $ten = $_POST['ten'];
    $sql = "DELETE FROM taikhoan WHERE username = '".$username."' AND ten ='".$ten."'";
    $sql_delete = mysqli_query($mysqli, $sql);
    if($sql_delete){
        echo "Xoa thành công";
    }else{
        echo "Xoa không thành công";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xoa tài khoản</title>
</head>
<body>
    <div>

    </div>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Xoa tài khoản</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Tên</td>
                    <td><input type="text" name="ten"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="deletetk" value="Xoa tài khoản"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
