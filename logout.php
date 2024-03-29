<?php
session_start();
if(isset($_SESSION['login'])){
    session_unset();
    session_destroy();
    http_response_code(200);
    echo "Đăng xuất thành công.";
    exit();
}else{
    http_response_code(400);
    echo "Người dùng chưa đăng nhập.";
    exit();
}
?>