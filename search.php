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
//tim kiem
$search = $_SESSION['se'];
$id_cty = $_SESSION['id_cty'];
$sql = "SELECT DISTINCT khachhang.* 
        FROM khachhang 
        INNER JOIN donhang ON donhang.id_kh = khachhang.id_kh
        WHERE donhang.id_cty = '".$id_cty."'
        AND (khachhang.ten LIKE '%".$search."%' OR khachhang.id_kh LIKE '%".$search."%')";


$result = mysqli_query($mysqli, $sql);
// if( mysqli_num_rows($result) > 0){
//     $row =mysqli_fetch_assoc($result);
//     $id_kh = $row['id_kh'];
// }else{
//     $error = "Không tìm thấy khách hàng";
// }
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
        .modal{
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
        .content{
            width: 380px;
            background-color: hsl(0deg 0% 100%);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border: 1px solid #888;
            margin-left: 35%;
            margin-top: 5%;

        }
        .close {
            float: right;
            cursor: pointer;
            font-size: 40px;
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
                <a href="role.php">Quản lý phân quyền</a>
                <a href="account.php">Quản lý tài khoản cá nhân</a>
                <a href="customer.php">Quản lý khách hàng</a>
                <a href="donhang.php">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <h1 style="font-size: 30px;
            margin-left: 7px;
            margin-bottom: 20px;" >
                Kết quả tìm kiếm
            </h1>
            <table class="table-list">
                <thead>
                    <tr>
                        <th>ID khách hàng</th>
                        <th>Tên</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // echo mysqli_num_rows($result);
                    if($result){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class  = "row" data-id_kh_data = "'.$row['id_kh'].'">';
                            echo '<td>' . $row['id_kh'] . '</td>';
                            echo '<td>' . $row['ten'] . '</td>';
                            echo '</tr>';
                        }
                    }else {
                        echo "Không có giá trị càn tìm kiếm";                    }
                    ?>
                    <script>
                        $(document).ready(function(){
                            $('.row').click(function (e) { 
                                e.preventDefault();
                                var id_kh = $(this).data('id_kh_data');
                                
                                $.ajax({
                                    url: 'detail_kh.php',
                                    method: 'POST',
                                    data: {id_kh:id_kh },
                                    success:function(response){
                                        $('.modal').css("display", "block");
                                        $('.detail_kh').html(response).addClass('show');
                                    }
                                })
                            });
                            $('.close').click(function(){
                                $('.modal').css("display", "none");
                                $('.detail_kh').removeClass('show');
                            })
                        })
                    </script>
                </tbody>
            </table>
            <div class="modal">
                <div class="content">
                    <span class="close">&times;</span>
                    <div class="detail_kh">
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>
</html>