<?php

?>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
/* CSS cho hộp thoại modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5); /* Tạo mờ */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    float: right;
    cursor: pointer;
}

</style>
</head>
<body>


<!-- Button để mở hộp thoại -->
<button id="openModal">Mở form chỉnh sửa</button>

<!-- Hộp thoại modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Form chỉnh sửa -->
        <div class="updatekh" id="updateform">
            <form action="update_customer.php" method="post" id="updateCustomerForm">
                <!-- Các trường input -->
                <div class="title">Nhập các thông tin cần thiết để chỉnh sửa khách hàng</div>
                <div class="input" id="updateidkh">
                    Mã khách hàng
                    <input type="text" name="ma_kh">
                </div>
                <div class="input" id="updateten">
                    Tên muốn chỉnh sửa
                    <input type="text" name="ten">
                </div>
                <!-- Các trường input khác -->
                <!-- Nút submit -->
                <div class="btn">
                    <input type="submit" name="updatekh" value="Chỉnh sửa" id="updatesubmit">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Khi click vào nút "Mở form chỉnh sửa"
document.getElementById("openModal").onclick = function() {
    // Hiển thị hộp thoại modal
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

// Khi click vào nút đóng
document.getElementsByClassName("close")[0].onclick = function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

// AJAX để gửi dữ liệu form khi submit
$('#updateCustomerForm').submit(function(e){
    e.preventDefault(); // Ngăn chặn sự kiện mặc định của form
    var formData = $(this).serialize(); // Lấy dữ liệu form
    $.ajax({
        url: 'update_customer.php', // Đường dẫn đến file xử lý
        type: 'POST',
        data: formData, // Dữ liệu gửi đi
        success: function(data){
            alert(data); // Hiển thị kết quả trả về từ file xử lý
        },
        error: function(xhr, status, error){
            alert('Đã xảy ra lỗi: ' + xhr.responseText);
        }
    });
});

</script>
</body>
</html>

