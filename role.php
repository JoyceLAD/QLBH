<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['login'])) {
    $username_admin = $_SESSION['login'];
    $sql = "SELECT * FROM taikhoan WHERE username='".$username_admin."'";
    $id_admincty = mysqli_query($mysqli, $sql);
    $id_admin = mysqli_fetch_assoc($id_admincty)['id_tk'];

    $check = "SELECT * FROM congty WHERE id_admincty='".$id_admin."'";
    $result1 = mysqli_query($mysqli, $check);
    $result2 = mysqli_num_rows($result1);

    if ($result2 > 0) {
        $row = mysqli_fetch_assoc($result1);
        $sqllistid_tk = "SELECT id_tk FROM phanquyen WHERE id_cty = '".$row['id_cty']."'";
        $listid_tk_result = mysqli_query($mysqli, $sqllistid_tk);
    }else{
        header("Location: user.php");
        exit();    
    }

    //Phan Quyen
    if (isset($_POST['role'])) {
        $user_name = $_POST['username'];
        $tencongty = $_POST['tencongty'];
        $sql1 = "SELECT id_tk FROM `taikhoan` WHERE username='".$user_name."'";
        $sql2 = "SELECT id_cty FROM `congty` WHERE ten_congty='".$tencongty."'";
        $r1 = mysqli_query($mysqli, $sql1);
        $r2 = mysqli_query($mysqli, $sql2);
        if ($r1 && $r2) {
            $id_taikhoan = mysqli_fetch_assoc($r1)['id_tk'];
            $id_congty = mysqli_fetch_assoc($r2)['id_cty'];
            
            $sql3 = "INSERT INTO phanquyen(id_tk, id_cty) VALUES('$id_taikhoan', '$id_congty')";
            
            if ($mysqli->query($sql3) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql3 . "<br>" . $mysqli->error;
            }
        } else {
            echo "Error";
        }
        $mysqli->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .role{
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
            Xin chào, <br> <?php echo $username_admin?>
        </div>
    </div>
    <section class="main">
        <div class="tab-left">
                <a href="user.php">Trang chủ</a>
                <a href="role.php" class="active">Quản lý phân quyền</a>
                <a href="account.php">Quản lý tài khoản cá nhân</a>
                <a href="customer.php">Quản lý khách hàng</a>
                <a href="donhang.php">Quản lý đơn hàng</a>
        </div>
        <div class="tab-right">
            <!-- <div style="font-size: 25px;margin-left: 40px;">
            Danh sách các tài khoản đã được phân quyền
            </div>
            <table class="table-list">
                        <tbody>
                            
                            while ($listid_tk = mysqli_fetch_assoc($listid_tk_result)) {
                                $id_tk = $listid_tk['id_tk'];
                                $sqllist_ten = "SELECT * FROM taikhoan WHERE id_tk = '".$id_tk."'";
                                $list_ten_result = mysqli_query($mysqli, $sqllist_ten);
                                $list_ten = mysqli_fetch_assoc($list_ten_result);
                                echo '<td>' . $list_ten['ten'] . '</td>';
                            }
                            ?>
                        </tbody>
                    </table> -->
            <div class="role">
                <form action="" method="post">
                    <div class="title">
                        Nhập các thông tin cần thiết để phân quyền cho tài khoản
                    </div>
                    <div class="input">
                        Username 
                        <input type="text" name="username">
                    </div>
                    <div class="input">
                        Tên công ty 
                        <input type="text" name="tencongty">
                    </div>
                    <div class="btn">
                    <input type="submit" name="role" value="Phân quyền">
                    </div>
                </form>

            </div>
                </div>
    </section>
</body>
</html>
