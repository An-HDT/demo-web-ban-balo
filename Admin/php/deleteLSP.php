<?php
    session_start();
    $matl = $_GET['matl'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE theloai SET hienthi=0 WHERE MaTL='$matl'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=loaisp&msg=success");
      echo "Đã xóa loại sản phẩm";
    } else {
      // header("Location: admin.php?page=loaisp&msg=error");
      echo "Loại sản phẩm đã được xóa";
    }
    exit();
?>