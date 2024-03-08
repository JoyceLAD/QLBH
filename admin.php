<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] =="user"){
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
    <li><a href="QLCT/AddCTy.php">Them cong ty</a></li>
    <li><a href="QLCT/DeleteCty.php">Xoa cong ty</a></li>
    <li><a href="QLCT/UpdateCTy.php">Chinh sua cong ty</a></li>
    <li><a href="QLTK/AddTK.php">Them tai khoan</a></li>
    <li><a href="QLTK/DeleteTK.php">Xoa tai khoan</a></li>
    <li><a href="QLTK/UpdateTK.php">Chinh sua tai khoan</a></li>
</body>
</html>