<?php
$mysqli = new mysqli("localhost","root","","qlbh");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$id_kh = $_POST['id_kh'];
$sql = "SELECT * FROM khachhang WHERE id_kh = '".$id_kh."'";
$result = mysqli_query($mysqli, $sql);

$sql1 = "SELECT COUNT(*) as tdh 
FROM donhang 
WHERE id_kh = '".$id_kh."' ";
    $tdh = mysqli_fetch_assoc(mysqli_query($mysqli, $sql1))['tdh'];
    if(mysqli_num_rows($result) >0){
    while($row  = mysqli_fetch_assoc($result)){
        echo "<h1>Thông tin tổng quan của khách hàng</h1>";
        echo "<p>ID khách hàng: " . $row['id_kh'] . "</p>";
        echo "<p>Tên: " . $row['ten'] . "</p>";
        echo "<p>Số đơn hàng đã mua: " . $tdh . "</p>";

    }
}else{
    echo "Error";
}
?>