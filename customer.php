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
    <title>Quan ly khach hang</title>
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
        .addkh, .deletekh, .updatekh, .importkh{
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
                <a href="customer.php" class="active">Quản lý khách hàng</a>
                <a href="donhang.php">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <button class="function-btn" id="add-btn">Thêm khách hàng</button>
            <button class="function-btn" id="delete-btn">Xóa khách hàng</button>
            <button class="function-btn" id="update-btn">Chỉnh sửa thông tin khách hàng</button>
            <button class="function-btn" id="import-btn">Import</button>
            <button class="function-btn" id="export-btn">Export</button>

            <div class="addkh" id="addform" style="display: none;">
                <form action="" method="post" id="addCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để thêm khách hàng
                    </div>
                    <div class="input" id="addten">
                        Tên 
                        <input type="text" name="ten">
                    </div>
                    <div class="input" id="addtuoi">
                        Tuổi
                        <input type="text" name="tuoi">
                    </div>
                    <div class="input" id="adddc">
                        Địa chỉ
                        <input type="text" name="dia_chi">
                    </div>
                    <div class="input" id="addcty">
                        Công ty
                        <input type="text" name="cong_ty">
                    </div>

                    <div class="input" id="addnn">
                        Nghề nghiệp
                        <input type="text" name="nghe_nghiep">
                    </div>
                    <div class="btn">
                    <input type="submit" name="addkh" value="Thêm" id="addsubmit">
                    </div>
                </form>
            </div>
            <div class="deletekh" id="deleteform" style="display: none;">
                <form action="" method="post" id="deleteCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để xóa khách hàng
                    </div>
                    <div class="input" id="deleteten">
                        Tên 
                        <input type="text" name="ten">
                    </div>
                    <div class="input" id="deletetuoi">
                        Tuổi
                        <input type="text" name="tuoi">
                    </div>
                    <div class="btn">
                    <input type="submit" name="deletekh" value="Xóa" id="deletesubmit">
                    </div>
                </form>
            </div>
            <div class="updatekh" id="updateform" style="display: none;">
                <form action="" method="post" id="updateCustomerForm">
                    <div class="title">
                        Nhập các thông tin cần thiết để chỉnh sửa khách hàng
                    </div>
                    <div class="input" id="updateten">
                        Tên 
                        <input type="text" name="ten">
                    </div>
                    <div class="input" id="updatetuoi">
                        Tuổi
                        <input type="text" name="tuoi">
                    </div>
                    <div class="input" id="updatedc">
                        Địa chỉ
                        <input type="text" name="dia_chi">
                    </div>
                    <div class="input" id="updatecty">
                        Công ty
                        <input type="text" name="cong_ty">
                    </div>

                    <div class="input" id="updatenn">
                        Nghề nghiệp
                        <input type="text" name="nghe_nghiep">
                    </div>

                    <div class="btn">
                    <input type="submit" name="updatekh" value="Chỉnh sửa" id="updatesubmit">
                    </div>
                </form>
            </div>
            <div class="importkh" id="importform" style="display: none;">
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
                            url: 'QLKH/export.php', 
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
    
                        var addten = $("#addten input").val();
                        var addtuoi = $("#addtuoi input").val();
                        var adddia_chi = $("#adddc input").val();
                        var addcong_ty = $("#addcty input").val();
                        var addnghe_nghiep = $("#addnn input").val();
                        
                        $.ajax({
                            url: 'QLKH/AddKH.php',
                            type: 'POST',
                            data:{
                                ten: addten,
                                tuoi: addtuoi,
                                dia_chi: adddia_chi,
                                cong_ty: addcong_ty,
                                nghe_nghiep: addnghe_nghiep
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
    
                        var deleteten = $("#deleteten input").val();
                        var deletetuoi = $("#deletetuoi input").val();                        
                        $.ajax({
                            url: 'QLKH/DeleteKH.php',
                            type: 'POST',
                            data:{
                                ten: deleteten,
                                tuoi: deletetuoi,
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
    
                        var updateten = $("#updateten input").val();
                        var updatetuoi = $("#updatetuoi input").val();
                        var updatedia_chi = $("#updatedc input").val();
                        var updatecong_ty = $("#updatecty input").val();
                        var updatenghe_nghiep = $("#updatenn input").val();
                        $.ajax({
                            url: 'QLKH/UpdateKH.php',
                            type: 'POST',
                            data:{
                                ten: updateten,
                                tuoi: updatetuoi,
                                dia_chi: updatedia_chi,
                                cong_ty: updatecong_ty,
                                nghe_nghiep: updatenghe_nghiep
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
                            url: 'QLKH/Import.php',
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