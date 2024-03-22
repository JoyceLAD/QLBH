<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if(isset($_POST['updatetk'])){
    $username = $_SESSION['login'];
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
    <title>Chỉnh sửa tài khoản</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .account{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .title{
            font-size: 25px;
            margin-left: 40px;
            margin-bottom: 20px;
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
            font-size: 10px;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        input[type="text"] {
            padding-top: 8px;
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 8px;
            height: 15px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.jpg" alt="">
        <div style="margin-right: 58em;font-size: 20px;">
            QUẢN LÝ BÁN HÀNG
        </div>
        <div style="margin-right: 15px;">
            Xin chào, <br> <?php echo $_SESSION['login']?>
        </div>
    </div>
    <section class="main">
        <div class="tab-left">
                <a href="user.php">Trang chủ</a>
                <a href="role.php" >Quản lý phân quyền</a>
                <a href="account.php" class="active">Quản lý tài khoản cá nhân</a>
                <a href="customer.php">Quản lý khách hàng</a>
                <a href="donhang.php">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <div class="account">
                <form action="" method="post">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa tài khoản
                    </div>
                    <div class="input">
                        Tên 
                        <input type="text" name="ten">
                    </div>
                    <div class="input">
                        Password 
                        <input type="text" name="password">
                    </div>
                    <div class="btn">
                    <input type="submit" name="updatetk" value="Chỉnh sửa">
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>
</html>
