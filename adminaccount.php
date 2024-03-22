<!-- 
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] =="user"){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>
    <li><a href="QLCT/AddCTy.php">Them cong ty</a></li>
    <li><a href="QLCT/DeleteCty.php">Xoa cong ty</a></li>
    <li><a href="QLCT/UpdateCTy.php">Chinh sua cong ty</a></li>
    <li><a href="QLTK/AddTK.php">Them tai khoan</a></li>
    <li><a href="QLTK/DeleteTK.php">Xoa tai khoan</a></li>
    <li><a href="QLTK/UpdateTK.php">Chinh sua tai khoan</a></li>

</body>
</html> -->

<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .function-btn{
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
        .addtk, .deletetk, .updatetk{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 20px;

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
        .input{
            margin-top: 5px;
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
            font-size: 14px;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="admin.php" >Quản lý công ty</a>
                <a href="adminaccount.php" class="active">Quản lý tài khoản</a>
        </div>
        <div class="tab-right">
            <button class="function-btn" id="add-btn">Thêm tài khoản</button>
            <button class="function-btn" id="delete-btn">Xóa tài khoản</button>
            <button class="function-btn" id="update-btn">Chỉnh sửa tài khoản</button>

            <div class="addtk" id="addform" style="display: none;">
                <form action="" method="post" id="addCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để thêm tài khoản
                    </div>
                    <div class="input" id="addusername">
                        Username
                        <input type="text">
                    </div>
                    <div class="input" id="addpassword">
                        Password
                        <input type="text" >
                    </div>
                    <div class="input" id="addten">
                        Tên
                        <input type="text">
                    </div>
                    <div class="btn">
                    <input type="submit" name="addtk" value="Thêm" id="addsubmit">
                    </div>
                </form>
            </div>
            <div class="deletetk" id="deleteform" style="display: none;">
                <form action="" method="post" id="deleteCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để xóa tài khoản
                    </div>
                    <div class="input" id="deleteusername">
                        Username
                        <input type="text">
                    </div>
                    <div class="input" id="deleteten">
                        Tên
                        <input type="text" >
                    </div>
                    <div class="btn">
                    <input type="submit" name="deletetk" value="Xóa" id="deletesubmit">
                    </div>
                </form>
            </div>
            <div class="updatetk" id="updateform" style="display: none;">
                <form action="" method="post" id="updateCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa tài khoản
                    </div>
                    <div class="input" id="updateusername">
                        Username
                        <input type="text">
                    </div>
                    <div class="input" id="updatepassword">
                        Password chỉnh sửa
                        <input type="text">
                    </div>
                    <div class="input" id="updateten">
                        Tên chỉnh sửa
                        <input type="text">
                    </div>
                    <div class="btn">
                    <input type="submit" name="updatekh" value="Chỉnh sửa" id="updatesubmit">
                    </div>
                </form>
            </div>

            <script>
                $(document).ready(function(){

                    function toggleForm(formid){
                    var form = $(formid);
                    if(form.is(':visible')){
                        form.hide();
                    }else {
                        $('.addkh').hide();
                        form.show();
                    }
                    }
                    $('#add-btn').click(function(){
                        toggleForm('#addform');
                    })
                    $('#delete-btn').click(function(){
                        toggleForm('#deleteform');
                    })
                    $('#update-btn').click(function(){
                        toggleForm('#updateform');
                    })
                    
                    $('#addCustomerForm').submit(function(e){
    
                        var addusername = $("#addusername input").val();
                        var addpassword = $("#addpassword input").val();
                        var addten = $("#addten input").val();
                        $.ajax({
                            url: 'QLTK/AddTK.php',
                            type: 'POST',
                            data:{
                                username: addusername,
                                password: addpassword,
                                ten: addten,
                            },
                            success: function(data){
                                alert(data);
                            },
                            error: function(xhr, status, error){
                                alert('Đã xảy ra lỗi: ' + xhr.responseText);
                            }
                        });
                    });
                    $('#deleteCustomerForm').submit(function(e){
    
                        var deleteusername = $("#deleteusername input").val();
                        var deleteten = $("#deleteten input").val();
                        $.ajax({
                            url: 'QLTK/DeleteTK.php',
                            type: 'POST',
                            data:{
                                username: deleteusername,
                                ten: deleteten,
                            },
                            success: function(data){
                                alert(data);
                            },
                            error: function(xhr, status, error){
                                alert('Đã xảy ra lỗi: ' + xhr.responseText); 
                            }
                        });
                    });
                    $('#updateCustomerForm').submit(function(e){
    
                        var updateusername = $("#updateusername input").val();
                        var updatepassword = $("#updatepassword input").val();
                        var updateten = $("#updateten input").val();
                        $.ajax({
                            url: 'QLTK/UpdateTK.php',
                            type: 'POST',
                            data:{
                                username: updateusername,
                                password: updatepassword,
                                ten: updateten,
                            },
                            success: function(data){
                                alert(data);
                            },
                            error: function(xhr, status, error){
                                alert('Đã xảy ra lỗi: ' + xhr.responseText); 
                            }
                        });
                    });
                })
            </script>
        </div>
    </section>
</body>
</html>