<?php
$loginE_message = "";
$loginS_message = "";

include('DB/connect.php');
if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $ten = $_POST['ten'];
    $sql = "INSERT INTO taikhoan(username,password,ten ) VALUES('".$username."', '".$password."', '".$ten."')";
    $sql_signup = mysqli_query($mysqli, $sql);
    if($sql_signup){
        $_SESSION['loginS_message'] = "Đăng kí thành công";
    }else{
        $_SESSION['loginE_message'] = "Đăng kí không thành công";
    }
    if(isset($_SESSION['loginS_message'])){
        $loginS_message = $_SESSION['loginS_message'];
        sleep(2);
        header("Location: login.php");
        unset($_SESSION['loginS_message']);
    }
    
    if(isset($_SESSION['loginE_message'])){
        $loginE_message = $_SESSION['loginE_message'];
        sleep(2);
        header("Location: signup.php");
        unset($_SESSION['loginE_message']);
    }
}
if(isset($_POST['login'])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body {
            font-family: "Be Vietnam Pro", sans-serif;
            background-color: hsl(218deg 50% 91%);
            margin: 0;
            padding: 0;
        }

        .signup {
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
            padding: 15px 15px 5px 15px;
            margin-right: 15px;
        }
        .c3 {
            padding: 15px 15px 5px 15px;
            width: 40%;
        }
        .c4{
            text-align: center;
            margin-top: 20px;
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

        .btn1 {
            text-align: center;
            margin-top: 20px;
            margin-left: 15px;
            margin-right: 15px;
            input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 25%;
            font-size: 18px;
            width: 100%;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }
            
        }
        .btn2 {
            text-align: center;
            margin-top: 5px;
            margin-left: 15px;
            margin-right: 15px;
            margin-bottom: 30px;
            input[type="submit"] {
            background-color: #f0fff0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 25%;
            font-size: 18px;
            width: 100%;
            color: #4CAF50;
            }

            input[type="submit"]:hover {
                background-color: #ccc;
            }
            
        }
    </style>

</head>
<body>
    <div class="signup">
        <form action="" method="post">
            <h1>Sign up</h1>
                <div class="c2">
                    Username:
                    <input type="text" name="username">
                </div>
                <div class="c2">
                    Password:
                    <input type="password" name="password">
                </div>
                <div class= "c2">
                    Họ và tên:
                    <input type="text" name="ten">
                </div>
                <div class = "btn1">
                    <input type="submit" name="signup" value="Sign up">
                </div>
        </form>
        <div class="login">
            <div class="c4">
                Đã có tài khoản?
            </div>
            <div class = "btn2">
                <input type="submit" name="login" value="Đăng nhập ngay">
            </div>
        </div>
        <!-- <div id="loginSuccesMessage" style="text-align: center; margin-top: 10px; font-weight: bold; color: green;"><?php if($loginS_message)echo $loginS_message; ?></div>
        <div id="loginErrorMessage" style="text-align: center; margin-top: 10px; font-weight: bold; color: red;"><?php if($loginE_message)echo $loginE_message; ?></div> -->


    </div>

</body>
</html>