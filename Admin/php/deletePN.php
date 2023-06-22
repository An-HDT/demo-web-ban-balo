<?php
    session_start();
    $mapn = $_GET['mapn'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE phieunhap set hienthi=0 where MaPN='$mapn'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=donhang&msg=success");
      echo "Đã xóa hóa đơn";
    } else {
      // header("Location: admin.php?page=donhang&msg=error");
      echo "Sản phẩm chưa được xóa";
    }
?>