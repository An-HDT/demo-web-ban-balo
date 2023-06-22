<?php
    session_start();
    require_once('connectDB.php');
    $dql = new connectDB();
    $maNV=$_POST['maNV'];
    $tenNV=$_POST['TenNV'];
    $sdt=$_POST['sdt'];
    $diachi=$_POST['diachi'];
    if (isset($_POST['btnsubmit']))
    {
        $sql="INSERT INTO nhanvien(MaNV,TenNV,SDT,DiaChi,NgayVL) VALUES ('$maNV','$tenNV','$sdt','$diachi',NOW())";
        $result = $dql->query($sql,false);
        if(!empty($_POST['matkhau'])){
            $matkhau=$_POST['matkhau'];
            $phanloai=$_POST['phanloai'];
            $sql2="INSERT INTO `taikhoan`(`MaTK`, `MaNV`, `MaKH`, `TenDN`, `MatKhau`, `NgayTao`, `TTrang`, `NhomQuyen`) VALUES (null,'$maNV',Null,'$maNV','$matkhau',Now(),'','$phanloai')";
            $result2 = $dql->query($sql2,false);
        }
        if ($result) {
            echo "Đã thêm nhân viên";
        } else {
            echo "Nhân viên chưa được thêm";
        }
    }
?>