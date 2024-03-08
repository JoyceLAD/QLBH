<?php
$mysqli = new mysqli("localhost","root","","qlbh");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
if(isset($_POST['addcty'])){
    $ten_congty = $_POST['ten_congty'];
    $admincty = $_POST['admincty'];
    $giamdoc = $_POST['giamdoc'];

    $idadmincty = "SELECT id_tk FROM taikhoan WHERE username = '".$admincty."'";
    $idgiamdoccty = "SELECT id_tk FROM taikhoan WHERE username = '".$giamdoc."'";
    
    $r1 = mysqli_query($mysqli,$idadmincty);
    $r2  =mysqli_query($mysqli, $idgiamdoccty);
    if($r1 && $r2){
        $id_admincty = mysqli_fetch_assoc($r1)['id_tk'];
        $id_giamdoc = mysqli_fetch_assoc($r2)['id_tk'];
        
        $sql3 = "INSERT INTO congty(id_giamdoc, id_admincty, ten_congty) VALUES('".$id_giamdoc."', '".$id_admincty."', '".$ten_congty."')";
        
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý công ty</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Thêm Công ty</td>
                </tr>
                <tr>
                    <td>Tên công ty</td>
                    <td><input type="text" name="ten_congty"></td>
                </tr>
                <tr>
                    <td>Username admin công ty</td>
                    <td><input type="text" name="admincty"></td>
                </tr>
                <tr>
                    <td>Username giám đốc công ty</td>
                    <td><input type="text" name="giamdoc"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="addcty" value="Thêm công ty"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>