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
$search = $_SESSION['search'];
$sql = "SELECT * FROM khachhang WHERE ten LIKE '%".$search."%' ";
$result = mysqli_query($mysqli, $sql);
if($result && mysqli_num_rows($result) > 0){
    $id_kh = mysqli_fetch_assoc($result)['id_kh'];
    $ten = mysqli_fetch_assoc($result)['ten'];
    $tuoi = mysqli_fetch_assoc($result)['tuoi'];
    $dia_chi = mysqli_fetch_assoc($result)['diachi'];
    $nghe_nghiep = mysqli_fetch_assoc($result)['nghe_nghiep'];
}else{
    $error = "Không tìm thấy khách hàng";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        :root {
            --c-text-primary: #282a32;
            --c-text-secondary: #686b87;
            --c-text-action: #404089;
            --c-accent-primary: #434ce8;
            --c-border-primary: #eff1f6;
            --c-background-primary: #ffffff;
            --c-background-secondary: #fdfcff;
            --c-background-tertiary: #ecf3fe;
            --c-background-quaternary: #e9ecf4;        }
        .body {
            line-height: 1.5;
            min-height: 100vh;
            font-family: "Be Vietnam Pro", sans-serif;
            background-color: var(--c-background-secondary);
            color: var(--c-text-primary);
        }
        .header{
            display: flex;
            flex-grow: 1;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            border-bottom: 1px solid var(--c-border-primary);
            background-color: var(--c-background-primary);
            img{
                width: 5%;
                padding-left:2em ;
                padding-bottom: 5px;
                padding-right: 2em;
            }
        }
        .header-link{
            display: flex;
            align-items: center;
            a{
                text-decoration: none;
                color: var(--c-text-action);
                font-size: 2rem ;
                font-weight: 500;
                transition: 0.15s ease;
                border-bottom: 3px solid transparent;
                & + *{
                    margin-left: 1.5rem;
                }
                &:hover, &:focus{
                    color: var(--c-accent-primary);
                    border-bottom-color: var(--c-accent-primary);
                }
            }
        }
        .main{
            width: 100%;
            display: flex;
            justify-content: space-around;
        }
        .tab-left{
            display: flex;
            flex-direction: column;
            width: 25%;
            border: 1px solid var(--c-border-primary);
            a {
                display: flex;
                align-items: center;
                padding: 0.75em 1em;
                background-color: transparent;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 500;
                color: var(--c-text-action);
                transition: 0.15s ease;
                &:hover,
                &:focus,
                &.active {
                    background-color: var(--c-background-tertiary);
                    color: var(--c-accent-primary);
                }

                & + * {
                    margin-top: 0.25rem;
                }
            }
        }
        .tab-right{
            width: 65%;
            display: block;
        }
        .chiso{
            display: flex;
            margin-bottom: 30px;
        }
        .card{
            box-sizing: border-box;
            padding: 2rem 2rem 2rem 2rem;
            background: #e9ecf4;
			height: 160px;
			align-items: center;
			justify-content: flex-start;
			border: 1px solid #eff1f6;
			border-radius: 5px;
            margin-left: 40px;
            margin-right: 131px;
            .big{
                display: block;
                font-size: 2em;
                line-height: 150%;
                color: #1b253d;
            }
        }
        .list{
            display: flex;
        }
        .table-list{
            border-collapse:collapse ;
            margin-left: 40px;
            margin-top: 10px;
            margin-right: 30px;

        }
        .table-list th,.table-list td{
            border: 1px solid #eff1f6;
            text-align: left;
            padding: 2rem;
        }
        .search{
            position: relative;
            display: flex;
            input{
                font: inherit;
                color: inherit;
                text-decoration: none;
                height: 40px;
                border-radius: 8px;
                border: 2px solid var(--c-border-primary);
                color: var(--c-text-action);
                font-size: 0.875rem;
                transition: 0.15s ease;
                width: 150%;
                line-height: 1;
            }

        }
        .btns{
            width: 50%;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.jpg" alt="">
        <div style="margin-right: 58em;font-size: 20px;">
            QUẢN LÝ BÁN HÀNG
        </div>
        <!-- <div style="margin-right: 15px;">
            Xin chào, <br> <?php echo $ten?>
        </div> -->
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
            <div class="search-result">

            </div>

        </div>
    </section>

</body>
</html>