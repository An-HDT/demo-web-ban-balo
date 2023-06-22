<?php
    session_start();
    require_once('connectDB.php');
    $dql = new connectDB();
    $maNCC=$_POST['maNCC'];
    $tenNCC=$_POST['tenNCC'];
    $sdt=$_POST['sdt'];
    $email=$_POST['email'];
    $diachi=$_POST['diachi'];

    if (isset($_POST['btnsubmit']))
    {
        $sql="INSERT INTO nhacungcap(MaNCC,TenNCC,SĐT,EMAIL,DIACHI) VALUES ('$maNCC','$tenNCC','$sdt','$email','$diachi')";
        $result = $dql->query($sql,false);
        if ($result) {
            // header("Location: admin.php?page=khachhang&msg=success");
            echo "Đã thêm nhà cung cấp";
        } else {
            // header("Location: admin.php?page=khachhang&msg=error");
            echo "Nhà cung cấp chưa được thêm";
        }  
    }
?>