<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] =="admin"){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>
    <li><a href="role.php">Quan ly phan quyen</a></li>
    <li><a href="account.php">Quan ly tai khoan ca nhan</a></li>
    <li><a href="customer.php">Quan ly khach hang</a></li>
    <li><a href="donhang.php">Quan ly don hang</a></li>
</body>
</html>