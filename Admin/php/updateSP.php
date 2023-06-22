<?php
        session_start();
        require_once('connectDB.php');
        $dql = new connectDB();
        $maSP=$_POST['masp'];
        $tenSP=$_POST['ten'];
        $gia=$_POST['gia'];
        $loai=$_POST['phanloai'];
        $Soluong=$_POST['soluong'];
        $filename="noname.jpg";
        $tmp_name = $_FILES["image"]["tmp_name"];
        $fldimageurl = "../img/" . $_FILES["image"]["name"];
        move_uploaded_file($tmp_name, $fldimageurl);
        $filename = $_FILES["image"]["name"];
        $sql="UPDATE sanpham SET MaSP='$maSP',TenSP='$tenSP',Hinhanh='$filename',LoaiSP='$loai',Gia='$gia',SoLuong='$Soluong' WHERE MaSP='$maSP'";
        $result = $dql->query($sql,false);
        if ($result) {
          // header("Location: admin.php?page=sanpham");
          echo "Update sản phẩm thành công";
        } else {
          // header("Location: admin.php?page=sanpham");
          echo "Update sản phẩm không thành công";
        }
?>