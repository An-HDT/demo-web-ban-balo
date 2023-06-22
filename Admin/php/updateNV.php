<?php
        session_start();
        require_once('connectDB.php');
        $dql = new connectDB();
        $manv=$_POST['maNV'];
        $tennv=$_POST['TenNV'];
        $sdt=$_POST['sdt'];
        $diachi=$_POST['diachi'];
        $sql="UPDATE nhanvien SET MaNV='$manv',TenNV='$tennv',SDT='$sdt',DIACHI='$diachi' WHERE MaNV='$manv'";
        $result = $dql->query($sql,false);
        if ($result) {
          // header("Location: admin.php?page=sanpham");
          echo "Update nhân viên thành công";
        } else {
          // header("Location: admin.php?page=sanpham");
          echo "Update nhân viên không thành công";
        }
?>