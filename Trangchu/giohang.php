<?php
session_start();
$s = 0;
$msp = $_GET['masp'];
include '../Login/connectDB.php';
$sql = "SELECT SoLuong FROM sanpham WHERE MaSP = '$msp'";
$kq = mysqli_query($con, $sql);
if ($kq->num_rows > 0) {
    $rows = mysqli_fetch_array($kq);
    if ($_GET['quantity'] > $rows['SoLuong']) {
        echo "Không đủ hàng";
    } else {
        $sql = "SELECT * FROM sanpham WHERE MaSP = '$msp'";
        $kq = mysqli_query($con, $sql);
        $sl = $_GET['quantity'];
        if ($kq->num_rows > 0) {
            $rows = mysqli_fetch_array($kq);
            if (!isset($_SESSION['giohang'])) {
                $_SESSION['giohang'] = array();
            }

            $found = false;
            for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
                if ($_SESSION['giohang'][$i]['MaSP'] == $rows['MaSP']) {
                    $_SESSION['giohang'][$i]['SoLuong'] += $sl;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $i = count($_SESSION['giohang']);
                $_SESSION['giohang'][$i]['MaSP'] = $rows['MaSP'];
                $_SESSION['giohang'][$i]['TenSP'] = $rows['TenSP'];
                $_SESSION['giohang'][$i]['Hinhanh'] = $rows['Hinhanh'];
                $_SESSION['giohang'][$i]['Gia'] = $rows['Gia'];
                $_SESSION['giohang'][$i]['SoLuong'] = $_GET['quantity'];
            }
        }
    }
}
?>