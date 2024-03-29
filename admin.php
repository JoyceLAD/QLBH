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
        .addcty, .deletecty, .updatecty, .importcty{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 20px;

        }
        .title{
            font-size: 25px;
            margin-left: 20px;
            margin-bottom: 20px;
            text-align: center;
            margin-right: 20px;
        }
        .btn {
            text-align: center;
            margin-top: 30px;
            /* margin-left: 15px;
            margin-right: 10px; */

        }
        .input{
            margin-top: 5px;
            margin-left: 15px;
            margin-right: 15px;
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
            <div id="logout" style="">
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
                <a href="admin.php" class="active">Quản lý công ty</a>
                <a href="adminaccount.php">Quản lý tài khoản</a>
        </div>
        <div class="tab-right">
            <button class="function-btn" id="add-btn">Thêm công ty</button>
            <button class="function-btn" id="delete-btn">Xóa công ty</button>
            <button class="function-btn" id="update-btn">Chỉnh sửa công ty</button>

            <div class="addcty" id="addform" style="display: none;">
                <form action="" method="post" id="addCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để thêm công ty
                    </div>
                    <div class="input" id="addtencty">
                        Tên công ty
                        <input type="text">
                    </div>
                    <div class="input" id="add_username_admincty">
                        Username admin công ty
                        <input type="text" >
                    </div>
                    <div class="input" id="add_username_gdcty">
                        Username giám đốc công ty
                        <input type="text">
                    </div>
                    <div class="btn">
                    <input type="submit" name="addcty" value="Thêm" id="addsubmit">
                    </div>
                </form>
            </div>
            <div class="deletecty" id="deleteform" style="display: none;">
                <form action="" method="post" id="deleteCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để xóa công ty
                    </div>
                    <div class="input" id="deletetencty">
                        Tên công ty
                        <input type="text">
                    </div>
                    <div class="input" id="delete_username_admincty">
                        Username admin công ty
                        <input type="text" >
                    </div>
                    <div class="input" id="delete_username_gdcty">
                        Username giám đốc công ty
                        <input type="text" >
                    </div>
                    <div class="btn">
                    <input type="submit" name="deletekh" value="Xóa" id="deletesubmit">
                    </div>
                </form>
            </div>
            <div class="updatecty" id="updateform" style="display: none;">
                <form action="" method="post" id="updateCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa công ty
                    </div>
                    <div class="input" id="updatetencty">
                        Tên công ty
                        <input type="text">
                    </div>
                    <div class="input" id="update_username_admincty">
                        Username admin công ty cần sửa
                        <input type="text">
                    </div>
                    <div class="input" id="update_username_gdcty">
                        Username giám đốc công ty cần sửa
                        <input type="text">
                    </div>
                    <div class="btn">
                    <input type="submit" name="updatedh" value="Chỉnh sửa" id="updatesubmit">
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
                        form.show();
                    }
                    }


                    $('#add-btn').click(function(){
                        toggleForm('#addform');
                        $('#deleteform').hide();
                        $('#updateform').hide();
                    })
                    $('#delete-btn').click(function(){
                        toggleForm('#deleteform');
                        $('#addform').hide();
                        $('#updateform').hide();
                    })
                    $('#update-btn').click(function(){
                        toggleForm('#updateform');
                        $('#deleteform').hide();
                        $('#addform').hide();

                    })
                    
                    $('#addCustomerForm').submit(function(e){
    
                        var addtencty = $("#addtencty input").val();
                        var add_username_admincty = $("#add_username_admincty input").val();
                        var add_username_gdcty = $("#add_username_gdcty input").val();
                        $.ajax({
                            url: 'QLCT/AddCTy.php',
                            type: 'POST',
                            data:{
                                ten_congty: addtencty,
                                admincty: add_username_admincty,
                                giamdoc: add_username_gdcty,
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
    
                        var deletetencty = $("#deletetencty input").val();
                        var delete_username_admincty = $("#delete_username_admincty input").val();
                        var delete_username_gdcty = $("#delete_username_gdcty input").val();
                        $.ajax({
                            url: 'QLCT/DeleteCty.php',
                            type: 'POST',
                            data:{
                                ten_congty: deletetencty,
                                admincty: delete_username_admincty,
                                giamdoc: delete_username_gdcty,
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
    
                        var updatetencty = $("#updatetencty input").val();
                        var update_username_admincty = $("#update_username_admincty input").val();
                        var update_username_gdcty = $("#update_username_gdcty input").val();
                        $.ajax({
                            url: 'QLCT/UpdateCTy.php',
                            type: 'POST',
                            data:{
                                ten_congty: updatetencty,
                                admincty: update_username_admincty,
                                giamdoc: update_username_gdcty,
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