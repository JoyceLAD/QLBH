<?php
session_start();
require_once 'PHPExcel/Classes/PHPExcel.php';

// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "qlbh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Kiểm tra xem tệp Excel đã được gửi lên chưa
if(isset($_FILES['file'])){
    $file = $_FILES['file'];

    // Xác định đường dẫn tạm thời của tệp Excel
    $file_tmp = $file['tmp_name'];

    // Load tệp Excel vào đối tượng PHPExcel
    $excel = PHPExcel_IOFactory::load($file_tmp);
    $sheet = $excel->getActiveSheet();

    // Lặp qua từng dòng trong tệp Excel và chèn dữ liệu vào cơ sở dữ liệu
    foreach ($sheet->getRowIterator() as $row) {
        $rowData = $row->getCellIterator();
        $data = array();

        // Lặp qua từng ô trong dòng
        foreach ($rowData as $cell) {
            $data[] = $cell->getValue();
        }

        // Thực hiện truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO donhang (id_donhang, id_kh, id_cty, ten_donhang, ngay) VALUES (?, ?, ?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("siss", $data[0], $data[1], $data[2], $data[3], $data[4]);
        $stmt->execute();
        $stmt->close();
    }

    // Thông báo import thành công
    echo "Import thành công!";
} else {
    // Thông báo lỗi nếu không tìm thấy tệp Excel
    echo "Không tìm thấy tệp Excel!";
}
?>
