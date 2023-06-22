<?php
    session_start();
    $mahd = $_GET['mahd'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE hoadon set hienthi=0 where MaHD='$mahd'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=donhang&msg=success");
      echo "Đã xóa hóa đơn";
    } else {
      // header("Location: admin.php?page=donhang&msg=error");
      echo "Sản phẩm chưa được xóa";
    }
?>