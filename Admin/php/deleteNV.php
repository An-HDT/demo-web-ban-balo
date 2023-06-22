<?php
    session_start();
    $maNV = $_GET['maNV'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE nhanvien set hienthi=0 where MaNV='$maNV'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=nhanvien&msg=success");
      echo "Đã xóa nhân viên";
    } else {
      // header("Location: admin.php?page=knhanvien&msg=error");
      echo "Nhân viên chưa được xóa";
    }
    exit();
?>