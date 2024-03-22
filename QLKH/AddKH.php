<?php
 session_start();
 $mysqli = new mysqli("localhost", "root", "", "qlbh");
 if ($mysqli->connect_errno) {
     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
     exit();
 }
    $ten = $_POST['ten'];
    $tuoi = $_POST['tuoi'];
    $dia_chi = $_POST['dia_chi'];
    $cong_ty = $_POST['cong_ty'];
    $nghe_nghiep = $_POST['nghe_nghiep'];
    $sql = "INSERT INTO khachhang(ten,tuoi,dia_chi,cong_ty,nghe_nghiep ) VALUES('".$ten."', '".$tuoi."', '".$dia_chi."', '".$cong_ty."', '".$nghe_nghiep."')";
    $sql_addkh = mysqli_query($mysqli, $sql);

 if (!$sql_addkh) {
    echo "Lỗi: " . mysqli_error($mysqli);
}else{
    echo "Thêm khách hàng thành công";
}


?>