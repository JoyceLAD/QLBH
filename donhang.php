<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quan ly don hang</title>
</head>
<body>
    <li><a href="QLDH/AddDH.php">Them don hang</a></li>
    <li><a href="QLDH/DeleteDH.php">Xoa don hang</a></li>
    <li><a href="QLDH/UpdateDH.php">Chinh sua don hang</a></li>
    <li><a href="QLDH/Import.php">Nhap don hang</a></li>
    <li><a href="QLDH/Export.php">Xuat don hang</a></li>
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
    <title>Quản lý đơn hàng</title>
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
        .adddh, .deletedh, .updatedh, .importdh{
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
                <a href="user.php">Trang chủ</a>
                <a href="role.php" >Quản lý phân quyền</a>
                <a href="account.php">Quản lý tài khoản cá nhân</a>
                <a href="customer.php">Quản lý khách hàng</a>
                <a href="donhang.php" class="active">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <button class="function-btn" id="add-btn">Thêm đơn hàng</button>
            <button class="function-btn" id="delete-btn">Xóa đơn hàng</button>
            <button class="function-btn" id="update-btn">Chỉnh sửa thông tin đơn hàng</button>
            <button class="function-btn" id="import-btn">Import</button>
            <button class="function-btn" id="export-btn">Export</button>

            <div class="adddh" id="addform" style="display: none;">
                <form action="" method="post" id="addCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để thêm đơn hàng
                    </div>
                    <div class="input" id="addtenkh">
                        Tên khách hàng
                        <input type="text" >
                        <!-- name="ten" -->
                    </div>
                    <div class="input" id="addtencty">
                        Tên công ty
                        <input type="text" name="tencty">
                    </div>
                    <div class="input" id="addtendh">
                        Tên đơn hàng
                        <input type="text" name="tendh">
                    </div>
                    <div class="input" id="addngay">
                        Ngày
                        <input type="date" name="ngay">
                    </div>
                    <div class="btn">
                    <input type="submit" name="adddh" value="Thêm" id="addsubmit">
                    </div>
                </form>
            </div>
            <div class="deletedh" id="deleteform" style="display: none;">
                <form action="" method="post" id="deleteCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để xóa đơn hàng
                    </div>
                    <div class="input" id="deletetenkh">
                        Tên khách hàng
                        <input type="text" >
                    </div>
                    <div class="input" id="deletetencty">
                        Tên công ty
                        <input type="text">
                    </div>
                    <div class="input" id="deletetendh">
                        Tên đơn hàng
                        <input type="text">
                    </div>
                    <div class="input" id="deletengay">
                        Ngày
                        <input type="date">
                    </div>
                    <div class="btn">
                    <input type="submit" name="deletekh" value="Xóa" id="deletesubmit">
                    </div>
                </form>
            </div>
            <div class="updatedh" id="updateform" style="display: none;">
                <form action="" method="post" id="updateCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa khách hàng
                    </div>
                    <div class="input" id="updatetenkh">
                        Tên khách hàng
                        <input type="text" >
                    </div>
                    <div class="input" id="updatetencty">
                        Tên công ty
                        <input type="text">
                    </div>
                    <div class="input" id="updatetendh">
                        Tên đơn hàng
                        <input type="text">
                    </div>
                    <div class="input" id="updatengay">
                        Ngày
                        <input type="date">
                    </div>
                    <div class="input" id="updatetenkh1">
                        Tên khách hàng muốn sửa
                        <input type="text" >
                    </div>
                    <div class="input" id="updatetencty1">
                        Tên công ty muốn sửa
                        <input type="text">
                    </div>
                    <div class="input" id="updatetendh1">
                        Tên đơn hàng muốn sửa
                        <input type="text">
                    </div>
                    <div class="input" id="updatengay1">
                        Ngày muốn sửa
                        <input type="date">
                    </div>

                    <div class="btn">
                    <input type="submit" name="updatekh" value="Chỉnh sửa" id="updatesubmit">
                    </div>
                </form>
            </div>
            <div class="importdh" id="importform" style="display: none;">
                <form action="" method="post" id="importCustomerForm">
                    <div class="title">
                        Chọn file để import
                    </div>
                    <div class="input" id="importfile">
                        File 
                        <input type="file" name="file">
                    </div>
                    <div class="btn">
                    <input type="submit" name="importkh" value="Import" id="importsubmit">
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
                    $('#export-btn').click(function(){
                        $.ajax({
                            url: 'QLDH/export.php', 
                            type: 'POST',
                            success: function(response) {
                                alert(response); 
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });                    
                    })
                    $('#import-btn').click(function(){
                        toggleForm('#importform');
                    })
                    
                    $('#addCustomerForm').submit(function(e){
    
                        var addtenkh = $("#addtenkh input").val();
                        var addtencty = $("#addtencty input").val();
                        var addtendh = $("#addtendh input").val();
                        var addngay = $("#addngay input").val();
                        
                        $.ajax({
                            url: 'QLDH/AddDH.php',
                            type: 'POST',
                            data:{
                                tenkh: addtenkh,
                                tencty: addtencty,
                                tendh: addtendh,
                                ngay: addngay,
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
                        var deletetenkh = $("#deletetenkh input").val();
                        var deletetencty = $("#deletetencty input").val();
                        var deletetendh = $("#deletetendh input").val();
                        var deletengay = $("#deletengay input").val();
                        $.ajax({
                            url: 'QLDH/DeleteDH.php',
                            type: 'POST',
                            data:{
                                tenkh: deletetenkh,
                                tencty: deletetencty,
                                tendh: deletetendh,
                                ngay: deletengay,
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
    
                        var updatetenkh = $("#updatetenkh input").val();
                        var updatetencty = $("#updatetencty input").val();
                        var updatetendh = $("#updatetendh input").val();
                        var updatengay = $("#updatengay input").val();
                        var updatetenkh1 = $("#updatetenkh1 input").val();
                        var updatetencty1 = $("#updatetencty1 input").val();
                        var updatetendh1 = $("#updatetendh1 input").val();
                        var updatengay1 = $("#updatengay1 input").val();

                        $.ajax({
                            url: 'QLDH/UpdateDH.php',
                            type: 'POST',
                            data:{
                                tenkh: updatetenkh,
                                tencty: updatetencty,
                                tendh: updatetendh,
                                ngay: updatengay,
                                tenkh1: updatetenkh1,
                                tencty1: updatetencty1,
                                tendh1: updatetendh1,
                                ngay1: updatengay1,

                            },
                            success: function(data){
                                alert(data);
                            },
                            error: function(xhr, status, error){
                                alert('Đã xảy ra lỗi: ' + xhr.responseText); 
                            }
                        });
                    });

                    $('#importCustomerForm').submit(function(e){
                        var filedata = new FormData();
                        var file = $('#importfile input')[0].files[0];
                        filedata.append('file', file);
                        $.ajax({
                            url: 'QLDH/Import.php',
                            type: 'POST',
                            data:filedata,
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