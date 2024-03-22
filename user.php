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
FROM taikhoan inner join phanquyen on taikhoan.id_tk = phanquyen.id_tk
WHERE username = '".$username."'";
$result  = mysqli_query($mysqli, $sql);
$sql_ten = "SELECT * FROM taikhoan WHERE username = '".$username."'";
$ten = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_ten))['ten'];
if($row = mysqli_fetch_assoc($result)){
    $id_cty = $row['id_cty'];
    //danh sach khach hang moi
    $sql_kh = "SELECT  * 
    FROM khachhang 
    inner join congty on khachhang.cong_ty = congty.ten_congty 
    ORDER BY khachhang.id_kh 
    DESC LIMIT 10";
    $list_kh = mysqli_query($mysqli, $sql_kh);
    //tong so khach hang
    $sql_tkh = "SELECT  COUNT(*) AS tkh
    FROM khachhang 
    inner join congty on khachhang.cong_ty = congty.ten_congty";
    $tkh = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_tkh))['tkh'];
    // echo $tkh."<br>";
    
    //danh sach don hang moi
    $sql_dh = "SELECT  * 
    FROM donhang 
    inner join khachhang on donhang.id_cty = khachhang.id_kh 
    WHERE id_cty = '".$id_cty."'";
    $list_dh = mysqli_query($mysqli, $sql_dh);

    //tong so don hang
    $sql_tdh = "SELECT  COUNT(*) AS tdh
    FROM donhang 
    inner join khachhang on donhang.id_cty = khachhang.id_kh 
    WHERE id_cty = '".$id_cty."'";
    $tdh = mysqli_fetch_assoc(mysqli_query($mysqli, $sql_tdh))['tdh'];
    // echo $tdh."<br>";
    if(isset($_POST['tk'])){
        $se = $_POST['key'];
        $_SESSION['se'] =$se;
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
</head>
<body>
    <div class="header">
        <img src="logo.jpg" alt="">
        <div style="margin-right: 58em;font-size: 20px;">
            QUẢN LÝ BÁN HÀNG
        </div>
        <div style="margin-right: 15px;">
            Xin chào, <br> <?php echo $ten?>
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
                        <div class="btns">
                        <input type="submit" name="tk" value="Search">
                        </div>
                    </form>
                </div>

            </div>
            <div class="list">
                <div class="list_dh">
                    <div style="font-size: 25px;margin-left: 40px;">
                        Danh sách đơn hàng mới nhất
                    </div>
                    <table class="table-list">
                        <thead>
                            <tr>
                                <th>Tên đơn hàng</th>
                                <th>Ngày</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($list_dh == null){
                                
                            }else while ($row1 = mysqli_fetch_assoc($list_dh)) {
                                echo '<tr>';
                                echo '<td>' . $row1['ten_donhang'] . '</td>';
                                echo '<td>' . $row1['ngay'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="list_kh">
                    <div style="font-size: 25px;margin-left: 40px">
                        Danh sách khách hàng mới nhất
                    </div>
                    <table class="table-list">
                        <thead>
                            <tr>
                                <th>Têm khách hàng</th>
                                <th>Tuổi</th>
                                <th>Địa chỉ</th>
                                <th>Nghề nghiệp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($list_kh == null){

                            }else
                            while ($row2 = mysqli_fetch_assoc($list_kh)) {
                                echo '<tr>';
                                echo '<td>' . $row2['ten'] . '</td>';
                                echo '<td>' . $row2['tuoi'] . '</td>';
                                echo '<td>' . $row2['dia_chi'] . '</td>';
                                echo '<td>' . $row2['nghe_nghiep'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </section>

</body>
</html>