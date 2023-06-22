<?php
    session_start();
    require_once('connectDB.php');
    $dql = new connectDB();
    $maKH=$_POST['maKH'];
    $tenKH=$_POST['ten'];
    $gioitinh=$_POST['gioitinh'];
    $diachi=$_POST['diachi'];
    $sdt=$_POST['sdt'];
    $ngayDK=$_POST['ngayDK'];
    if (isset($_POST['btnsubmit']))
    {
        $sql="INSERT INTO khachhang(MaKH,TenKH,GioiTinh,DIACHI,SĐT,NgayDK) VALUES ('$maKH','$tenKH','$gioitinh','$diachi','$sdt','$ngayDK')";
        $result = $dql->query($sql,false);
        if ($result) {
            echo "Đã thêm khách hàng";
        } else {
            echo "Khách hàng chưa được thêm";
        }
    }
?>