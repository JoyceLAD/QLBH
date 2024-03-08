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
    $sql = "SELECT id_tk FROM taikhoan WHERE username='".$username_admin."'";
    $id_admincty = mysqli_query($mysqli, $sql);
    $id_admin = mysqli_fetch_assoc($id_admincty)['id_tk'];

    $check = "SELECT * FROM congty WHERE id_admincty='".$id_admin."'";
    $result1 = mysqli_query($mysqli, $check);
    $result2 = mysqli_num_rows($result1);

    if ($result2 > 0) {
        $row = mysqli_fetch_assoc($result1);
        $sqllistid_tk = "SELECT id_tk FROM phanquyen WHERE id_cty = '".$row['id_cty']."'";
        $listid_tk_result = mysqli_query($mysqli, $sqllistid_tk);
        echo "Danh sach cac thanh vien duoc phan quyen: <br>";
        while ($listid_tk = mysqli_fetch_assoc($listid_tk_result)) {
            $id_tk = $listid_tk['id_tk'];
            $sqllist_ten = "SELECT ten FROM taikhoan WHERE id_tk = '".$id_tk."'";
            $list_ten_result = mysqli_query($mysqli, $sqllist_ten);
            $list_ten = mysqli_fetch_assoc($list_ten_result);
            echo "Tên: " . $list_ten['ten'] . "<br>";
        }
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
</head>
<body>
    <div>

    </div>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Role</td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Ten cong ty</td>
                    <td><input type="text" name="tencongty"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="role" value="Phân quyền"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
