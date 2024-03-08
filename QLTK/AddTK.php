<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['addtk'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ten = $_POST['ten'];
    $sql = "INSERT INTO taikhoan(username,password,ten ) VALUES('".$username."', '".$password."', '".$ten."')";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        echo "Them thành công";
    }else{
        echo "Them không thành công";
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
                    <td>Thêm tài khoản</td>
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
                    <td><input type="submit" name="addtk" value="Thêm tài khoản"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
