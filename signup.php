<?php
include('DB/connect.php');
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ten = $_POST['ten'];
    $sql = "INSERT INTO taikhoan(username,password,ten ) VALUES('".$username."', '".$password."', '".$ten."')";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        echo "Đăng kí thành công";
    }else{
        echo "Đăng kí không thành công";
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <p>Sign up</p>
    <form action="" method="post">
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="text" name="password"></td>
        </tr>
        <tr>
            <td>Họ và tên: </td>
            <td><input type="text" name="ten"></td>
        </tr>
        <tr>
            <td><input type="submit" name="signup" value="Sign up"></td>
        </tr>

    </table>
    </form>
</body>
</html>