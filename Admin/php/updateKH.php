<?php
        session_start();
        require_once('connectDB.php');
        $dql = new connectDB();
        $makh=$_POST['makh'];
        $tenkh=$_POST['ten'];
        $sdt=$_POST['sdt'];
        $diachi=$_POST['diachi'];
        $sql="UPDATE khachhang SET MaKH='$makh',TenKH='$tenkh',SĐT='$sdt',DIACHI='$diachi' WHERE MaKH='$makh'";
        $result = $dql->query($sql,false);
        if ($result) {
          // header("Location: admin.php?page=sanpham");
          echo "Update khách hàng thành công";
        } else {
          // header("Location: admin.php?page=sanpham");
          echo "Update khách hàng không thành công";
        }
?>