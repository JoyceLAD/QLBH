<?php
$login_message = "";
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
            $login_message =  "Tên đăng nhập hoặc mật khẩu không đúng.";
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
            $login_message =  "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: hsl(218deg 50% 91%);
            margin: 0;
            padding: 0;
        }

        .login {
            width: 380px;
            margin: 100px auto;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
        }

        .c2 {
            /* margin-bottom: 8px; */
            padding: 15px 15px 5px 15px;
        }
        .c3 {
            padding: 15px 15px 5px 15px;
            width: 40%;
        }

        input[type="text"],
        input[type="password"] {
            padding-top: 8px;
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 8px;
            height: 15px;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 25%;
            height: 25%;
            font-size: 18px;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>
    <div class="login">
        <form action="" method="post">
            <h1>Login</h1>
                <div class="c2">
                    Username:
                    <input type="text" name="username">
                </div>
                <div class="c2">
                    Password: </td>
                    <input type="password" name="password">
                </div>
                <div class= "c3">
                    Role:
                    <select name="role" id="">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class = "btn">
                    <input type="submit" name="login" value="Login">
                </div>
                <div id="loginMessage" style="text-align: center; margin-top: 10px; font-weight: bold; color: red;"><?php if($login_message)echo $login_message; ?></div>
        </form>
    </div>

</body>
</html>
