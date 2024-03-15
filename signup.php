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
        $_SESSION['loginE_message'] = "Đăng kí khonh thành công";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            /* margin-bottom: 8px; */
            padding: 15px 15px 5px 15px;
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
                <div class = "btn">
                    <input type="submit" name="signup" value="Sign up">
                </div>
        </form>
        <!-- <div id="loginSuccesMessage" style="text-align: center; margin-top: 10px; font-weight: bold; color: green;"><?php if($loginS_message)echo $loginS_message; ?></div>
        <div id="loginErrorMessage" style="text-align: center; margin-top: 10px; font-weight: bold; color: red;"><?php if($loginE_message)echo $loginE_message; ?></div> -->
    </div>

</body>
</html>