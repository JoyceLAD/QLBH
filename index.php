<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
// if(isset($_POST['role'])){
//     // $_SESSION['user'] =$_SESSION['login'];
//     header("Location: role.php");
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="" method="post">
    <ul>
        <li><input type="submit" name="role" value="Role"></li>
    </ul>
    </form> -->
    <a href="role.php">Role</a>
</body>
</html>