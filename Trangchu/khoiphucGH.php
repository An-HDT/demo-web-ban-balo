<?php
session_start();
    if (isset($_POST['giohang'])) {
        $gioHang = json_decode($_POST['giohang'], true);
        unset($gioHang['tong']);
        $_SESSION['giohang'] = $gioHang;;
        echo 'Lưu giỏ hàng thành công.';
    } else {
        echo 'Không có dữ liệu giỏ hàng.';
    }
?>
