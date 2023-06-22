<?php
        session_start();
        require_once('connectDB.php');
        $dql = new connectDB();
        $matl=$_POST['matl'];
        $tentl=$_POST['Tentll'];
        $filename="noname.jpg";
        $tmp_name = $_FILES["image"]["tmp_name"];
        $fldimageurl = "../img/" . $_FILES["image"]["name"];
        move_uploaded_file($tmp_name, $fldimageurl);
        $filename = $_FILES["image"]["name"];
        $sql="UPDATE theloai SET MaTL='$matl',TenTL='$tentl',AnhTL='$filename' WHERE MaTL='$matl'";
        $result = $dql->query($sql,false);
        if ($result) {
          // header("Location: admin.php?page=sanpham");
          echo "Update nhân viên thành công";
        } else {
          // header("Location: admin.php?page=sanpham");
          echo "Update nhân viên không thành công";
        }
?>