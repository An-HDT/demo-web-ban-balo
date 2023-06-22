<?php
    session_start();
    $maNCC = $_GET['maNCC'];
    require_once('connectDB.php');
    $dql = new connectDB();
    $sql = "UPDATE nhacungcap SET hienthi=0 WHERE MaNCC='$maNCC'";
    $result = $dql->query($sql,false);
    if ($result) {
      // header("Location: admin.php?page=nhacungcap&msg=success");
      echo "Đã xóa nhà cung cấp";
    } else {
      // header("Location: admin.php?page=nhacungcap&msg=error");
      echo "Nhà cung cấp chưa được xóa";
    }
    exit();
?>