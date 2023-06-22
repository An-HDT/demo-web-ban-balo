<?php
    session_start();
    require_once('connectDB.php');
    $dql = new connectDB();
    $maHD = $_GET['mahd'];
    $tinhtrang = $_GET['tinhtrang'];
    $sql = "UPDATE hoadon set TinhTrang='$tinhtrang' where MaHD='$maHD'";
    $result = $dql->query($sql,false);
    if($tinhtrang==4){
      $sql2 = "UPDATE sanpham
      JOIN ct_hd ON sanpham.MaSP = ct_hd.MaSP
      SET sanpham.SoLuong = sanpham.SoLuong + ct_hd.soluong
      WHERE ct_hd.MaHD='$maHD'";
      $result2 = $dql->query($sql2,false);
    }
    if ($result) {
      // header("Location: admin.php?page=donhang&msg=success");
      echo "Update tình trạng thành công";
    } else {
      // header("Location: admin.php?page=donhang&msg=error");
      echo "Update tình trạng thất bại";
    }
?>