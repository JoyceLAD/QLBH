<?php
session_start();
$mysqli = new mysqli("localhost","root","","qlbh");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if(isset($_POST['login'])){
    $taikhoan = $_POST['username'];
    $matkhau = md5($_POST['password']);
    $role = $_POST['role'];
    if(!$mysqli){
        die("Kết nối đến CSDL thất bại: " . mysqli_connect_error());
    }
    if($role = "admin"){
        $sql2 = "SELECT * FROM a WHERE username='".$taikhoan."' AND password='".$matkhau."'";
        $row2 = mysqli_query($mysqli, $sql2);
        $count2 = mysqli_num_rows($row2);
        if($count2 > 0){
            $_SESSION['login'] = $taikhoan;
            $_SESSION['role'] = "admin";
            header("Location: admin.php");
            exit();
        }else{
            echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }

    if($role = "user"){
        $sql1 = "SELECT * FROM taikhoan WHERE username='".$taikhoan."' AND password='".$matkhau."'";
        $row1 = mysqli_query($mysqli, $sql1);
        $count1 = mysqli_num_rows($row1);
        if($count1 > 0){
            $_SESSION['login'] = $taikhoan;
            $_SESSION['role'] = "user";
            header("Location: user.php");
            exit();
        }else{
            echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Login</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                    <select name="role" id="">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="login" value="Login"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
