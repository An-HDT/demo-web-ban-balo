<?php
    session_start();
    $masp = $_GET['masp'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE sanpham set hienthi=0 where MaSP='$masp'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=sanpham&msg=success");
      echo "Đã xóa sản phẩm";
    } else {
      // header("Location: admin.php?page=sanpham&msg=error");
      echo "Sản phẩm chưa được xóa";
    }
?>