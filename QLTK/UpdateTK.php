<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['updatetk'])){
    $username = $_POST['username'];
    $ten = $_POST['ten'];
    $password = md5($_POST['password']);
    $sql = "UPDATE taikhoan SET password = '".$password."', ten = '".$ten."' WHERE username = '".$username."'";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        echo "Cap nhat thành công";
    }else{
        echo "Cap nhat không thành công";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chinh sua tài khoản</title>
</head>
<body>
    <div>

    </div>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Chinh sua tài khoản</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td>Tên</td>
                    <td><input type="text" name="ten"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="updatetk" value="Chinh sua tài khoản"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
