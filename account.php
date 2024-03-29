<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
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
            /* margin-top: 20px; */

        }
        .title{
            font-size: 25px;
            margin-left: 40px;
            margin-bottom: 20px;
            text-align: center;
            margin-right: 20px;

        }
        .btn {
            text-align: center;
            margin-top: 30px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            /* padding: 10px 20px; */
            padding-top: 10px;
            padding-bottom: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 25%;
            height: 25%;
            font-size: 14px;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="header">
        <img src="logo.jpg" alt="">
        <div style="margin-right: 53.5em;font-size: 20px;">
            QUẢN LÝ BÁN HÀNG
        </div>
        <div class="acc" style="margin-right: 10px;">
            Xin chào, <?php echo $_SESSION['login']?>
            <div id="logout">
                Đăng xuất
            </div>
            <script>
                $(document).ready(function(){
                    $('#logout').click(function(){
                        $.ajax({
                            url:'logout.php',
                            type: 'POST',
                            success:function(data){
                                window.location.href = 'login.php';                            }
                        })
                    })
                })
            </script>
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
                <form id="accountForm"action="" method="post">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa tài khoản
                    </div>
                    <div class="input">
                        Tên 
                        <input type="text" id="ten">
                    </div>
                    <div class="input">
                        Password 
                        <input type="text" id="password">
                    </div>
                    <div class="btn">
                        <input type="submit" name="updatetk" value="Chỉnh sửa" id="change">
                    </div>
                </form>
            </div>

            <script>
                $(document).ready(function(){
                    $('#accountForm').submit(function(e){
                    var ten = $("#ten").val();
                    var password = $("#password").val();
                        $.ajax({
                            url: 'ACCOUNT/Change_Account.php',
                            type: 'POST',
                            data:{
                                ten: ten,
                                password: password
                            },
                            success: function(data){
                                alert(data);
                            },
                            error: function(xhr, status, error){
                                alert('Đã xảy ra lỗi: ' + xhr.responseText);
                            }
                        });
                    })
                    })
            </script>


        </div>
    </section>
</body>
</html>
