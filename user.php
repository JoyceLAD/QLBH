<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] =="admin"){
    header("Location: login.php");
}
$mysqli = new mysqli("localhost","root","","qlbh");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}


$tkh = 0;
$tdh = 0;
$list_dh= 0;
$list_kh= 0;


//kiem tra xem tai khoan co thuoc cong ty nao khong
$username = $_SESSION['login'];
$sql = "SELECT phanquyen.id_cty 
FROM taikhoan 
inner join phanquyen on taikhoan.id_tk = phanquyen.id_tk
WHERE username = '".$username."'";
$result  = mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)){
    $id_cty = mysqli_fetch_assoc($result)['id_cty'];
// }
// if($id_cty){
    $sql_kh = "SELECT DISTINCT khachhang.* 
    FROM khachhang 
    INNER JOIN donhang ON donhang.id_kh = khachhang.id_kh
    WHERE donhang.id_cty = '".$id_cty."'
    ORDER BY khachhang.id_kh DESC 
    LIMIT 10";
    $list_kh = mysqli_query($mysqli, $sql_kh);

    //tong so khach hang
    $sql_tkh = "SELECT  COUNT(DISTINCT id_kh) AS tkh
    FROM donhang 
    Where id_cty = '".$id_cty."'";
    $tkh = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_tkh))['tkh'];
    // echo $tkh."<br>";
    
    //danh sach don hang moi
    $sql_dh = "SELECT  * 
    FROM donhang 
    WHERE id_cty = '".$id_cty."'
    ORDER BY donhang.ngay 
    DESC LIMIT 10";
    
    $list_dh = mysqli_query($mysqli, $sql_dh);

    //tong so don hang
    $sql_tdh = "SELECT  COUNT(*) AS tdh
    FROM donhang 
    WHERE id_cty = '".$id_cty."'";
    $tdh = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_tdh))['tdh'];
    // echo $tdh."<br>";

    if(isset($_POST['tk'])){
        $se = $_POST['key'];
        $_SESSION['se'] =$se;
        $_SESSION['id_cty'] = $id_cty; 
        header("Location: search.php");
    }

}else{
    $user_message = "Ban khong thuoc cong ty nao ";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .modalkh {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modaldh{
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);

        }

        /* .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        } */

        .close1 {
            float: right;
            cursor: pointer;
            font-size: 40px;
        }
        .close2 {
            float: right;
            cursor: pointer;
            font-size: 40px;
        }

        .updatekh{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border: 1px solid #888;
            margin-left: 35%;
            margin-top: 5%;
            /* width: 80%; */

        }
        .updatedh{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            /* margin-top: 20px; */
            /* background-color: #fefefe; */
            /* margin: 25% auto; */
            /* padding: 20px; */
            border: 1px solid #888;
            margin-left: 35%;
            margin-top: 5%;

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
            margin-top: 20px;
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
    <div class="header">
        <img src="logo.jpg" alt="">
        <div style="margin-right: 54em;font-size: 20px;">
            QUẢN LÝ BÁN HÀNG
        </div>
        <div class="acc" style="margin-right: 5px;">
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
                <a href="user.php" class="active">Trang chủ</a>
                <a href="role.php">Quản lý phân quyền</a>
                <a href="account.php">Quản lý tài khoản cá nhân</a>
                <a href="customer.php">Quản lý khách hàng</a>
                <a href="donhang.php">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <div class="chiso">
            <div class="card">
                    <div class="big">
                        <?php
                        echo $tdh;            
                        ?>
                    </div>
                    Tổng sô đơn hàng
                </div>
                <div class="card">
                    <div class="big">
                        <?php
                        echo $tkh;            
                        ?>
                    </div>
                    Tổng sô khách hàng
                </div>
                <div class="search">
                    <form action="" method="post">
                        <input type="text" name="key">
                        <div class="btns" >
                        <input type="submit" name="tk" value="Search" style="    width: 50%; align-items: center;
">
                        </div>
                    </form>
                </div>

            </div>
            <div class="list">
                <div class="list_dh">
                    <div style="font-size: 25px;margin-left: 15px;">
                        Danh sách đơn hàng mới nhất
                    </div>
                    <table class="table-list">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã khách hàng</th>
                                <th>Tên đơn hàng</th>
                                <th>Ngày</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($list_dh == null) {
                        } else {
                            while ($row1 = mysqli_fetch_assoc($list_dh)) {
                                echo '<tr class  = "rowdh" data-id_dh_data = "'.$row1['id_donhang'].'">';
                                echo '<td>' . $row1['id_donhang'] . '</td>';
                                echo '<td>' . $row1['id_kh'] . '</td>';
                                echo '<td>' . $row1['ten_donhang'] . '</td>';
                                echo '<td>' . $row1['ngay'] . '</td>';
                                echo '<td><i class="fa fa-trash xdh" style="font-size:15px;color:red"></i></td>';                               
                                echo '<td><i class="fa fa-pencil sdh" style="font-size:15px"></i> </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function(){
                            $('.xdh').click(function () { 
                                var id_donhang = $(this).closest('.rowdh').data('id_dh_data');
                                console.log('ID đơn hàng:', id_donhang);                                
                                $.ajax({
                                    url: 'QLDH/DeleteByClick.php',
                                    method: 'POST',
                                    data: {id_donhang:id_donhang },
                                    success:function(data1){
                                        alert(data1);
                                        window.location.href = 'user.php';             
                                    }
                                })
                            });
                            //Sửa đơn hàng
                            $('.sdh').click(function (e) { 
                                $(".modaldh").css("display", "block");
                                var id_donhang = $(this).closest('.rowdh').data('id_dh_data');
                                console.log( id_donhang);    
                                $('#updatedhform').submit(function(){
                                    var updateidkh1 = $("#updateidkh1 input").val();
                                    var updatetendh1 = $("#updatetendh1 input").val();
                                    var updatengay1 = $("#updatengay1 input").val();
                                    $.ajax({
                                        url: 'QLDH/UpdateDH.php',
                                        type: 'POST',
                                        data:{
                                            id_donhang: id_donhang,
                                            id_kh1: updateidkh1,
                                            tendh1: updatetendh1,
                                            ngay1: updatengay1,

                                        },
                                        success: function(data0){
                                            alert(data0);
                                        },
                                        error: function(xhr, status, error){
                                            alert('Đã xảy ra lỗi: ' + xhr.responseText); 
                                        }
                                    });
                                });
                                $(".close2").click(function() {
                                    $(".modaldh").css("display", "none");
                                });
                            });


                        })
                    </script>
                </div>
                <div class="list_kh">
                    <div style="font-size: 25px;margin-left: 50px">
                        Danh sách khách hàng mới nhất
                    </div>
                    <table class="table-list" style="margin-left: 50px;">
                        <thead>
                            <tr>
                                <th>Mã khách hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Tuổi</th>
                                <th>Địa chỉ</th>
                                <th>Nghề nghiệp</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($list_kh == null){

                            }else
                            while ($row2 = mysqli_fetch_assoc($list_kh)) {
                                echo '<tr class  = "rowkh" data-id_kh_data = "'.$row2['id_kh'].'">';
                                echo '<td>' . $row2['id_kh'] . '</td>';
                                echo '<td>' . $row2['ten'] . '</td>';
                                echo '<td>' . $row2['tuoi'] . '</td>';
                                echo '<td>' . $row2['dia_chi'] . '</td>';
                                echo '<td>' . $row2['nghe_nghiep'] . '</td>';
                                echo '<td><i class="fa fa-trash xkh" style="font-size:15px;color:red"></i></td>';                               
                                echo '<td><i class="fa fa-pencil skh" style="font-size:15px"></i> </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <script>
                        $(document).ready(function(){
                            //Xóa khách hàng
                            $('.xkh').click(function (e) { 
                                e.preventDefault();
                                var id_kh = $(this).closest('.rowkh').data('id_kh_data');
                                $.ajax({
                                    url: 'QLKH/DeleteByClick.php',
                                    method: 'POST',
                                    data: {id_kh:id_kh },
                                    success:function(data2){
                                        alert(data2);
                                        window.location.href = 'user.php';             
                                    }
                                })
                            });
                            //Sửa khách hàng
                            $('.skh').click(function (e) { 
                                $(".modalkh").css("display", "block");
                                var id_kh = $(this).closest('.rowkh').data('id_kh_data');
                                console.log( id_kh);                                
                                $('#updateCustomerForm').submit(function(e){
                                // var updateidkh = $("#updateidkh input").val();
                                    var updateten = $("#updateten input").val();
                                    var updatetuoi = $("#updatetuoi input").val();
                                    var updatedia_chi = $("#updatedc input").val();
                                    var updatecong_ty = $("#updatecty input").val();
                                    var updatenghe_nghiep = $("#updatenn input").val();
                                    $.ajax({
                                        url: 'QLKH/UpdateKH.php',
                                        type: 'POST',
                                        data:{
                                            id_kh:id_kh,
                                            ten: updateten,
                                            tuoi: updatetuoi,
                                            dia_chi: updatedia_chi,
                                            cong_ty: updatecong_ty,
                                            nghe_nghiep: updatenghe_nghiep
                                        },
                                        success: function(data3){
                                            alert(data3);
                                        },
                                        error: function(xhr, status, error){
                                            alert('Đã xảy ra lỗi: ' + xhr.responseText); 
                                        }
                                    });
                                });
                                $(".close1").click(function() {
                                    $(".modalkh").css("display", "none");
                                });
                            });
                        })
                    </script>

                </div>

            </div>
        <div id="modalkh" class="modalkh">
            <div class="modal-content1">
                <div class="updatekh" id="updatekhdhform" >
                    <span class="close1">&times;</span>
                    <form action="" method="post" id="updateCustomerForm">
                        <div class="title">
                            Nhập các thông tin cần thiết để chỉnh sửa khách hàng
                        </div>
                        <!-- <div class="input" id="updateidkh">
                            Mã khách hàng
                            <input type="text" >
                        </div> -->
                        <div class="input" id="updateten">
                            Tên muốn chỉnh sửa
                            <input type="text" name="ten">
                        </div>
                        <div class="input" id="updatetuoi">
                            Tuổi muốn chỉnh sửa
                            <input type="text" name="tuoi">
                        </div>
                        <div class="input" id="updatedc">
                            Địa chỉ muốn chỉnh sửa
                            <input type="text" name="dia_chi">
                        </div>
                        <div class="input" id="updatecty">
                            Công ty muốn chỉnh sửa
                            <input type="text" name="cong_ty">
                        </div>

                        <div class="input" id="updatenn">
                            Nghề nghiệp muốn chỉnh sửa
                            <input type="text" name="nghe_nghiep">
                        </div>

                        <div class="btn">
                        <input type="submit" name="updatekh" value="Chỉnh sửa" id="updatesubmitkh">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modaldh" class="modaldh">
            <div class="modal-content2">
                <div class="updatedh" id="updatedhform" >
                    <span class="close2">&times;</span>
                    <form action="" method="post" id="updatedhForm">
                        <div class="title">
                            Nhập các thông tin cần thiết để chỉnh sửa đơn hàng
                        </div>
                        <!-- <div class="input" id="updatemdh">
                            Mã đơn hàng
                            <input type="text">
                        </div> -->
                        <div class="input" id="updateidkh1">
                            Mã khách hàng muốn sửa
                            <input type="text" >
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
                        <input type="submit" name="updatedh" value="Chỉnh sửa" id="updatesubmitdh">
                        </div>
                </form>
                </div>
            </div>
        </div>





        </div>
    </section>
    
</body>
</html>