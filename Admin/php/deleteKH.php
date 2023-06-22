<?php
    session_start();
    $makh = $_GET['makh'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE khachhang set hienthi=0 where MaKH='$makh'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=khachhang&msg=success");
      echo "Đã xóa khách hàng";
    } else {
      // header("Location: admin.php?page=khachhang&msg=error");
      echo "Khách hàng chưa được xóa";
    }
    exit();
?>