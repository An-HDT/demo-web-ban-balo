<?php
session_start();
    require_once 'connectDB.php';
    $dql = new connectDB();
    $tongTien =$_POST['tongTien'];
    $khachhang=$_SESSION['username'];
    if($_SESSION['giohang']){
    // Thực hiện truy vấn chèn dữ liệu vào bảng hoadon
    $sql_hoadon = "INSERT INTO hoadon (MaKH, NgayMH,TongTien,TinhTrang) VALUES ('$khachhang',now(),'$tongTien',1)";
    $result = $dql->query($sql_hoadon,false);

    $sql="SELECT MaHD FROM hoadon order by MaHD DESC limit 1";
    $result = $dql->query($sql);
    $abc=$result[0]['MaHD'];


    // Thực hiện truy vấn chèn dữ liệu vào bảng ct_hd
    for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
        $masp =$_SESSION['giohang'][$i]['MaSP'];
        $soLuong = $_SESSION['giohang'][$i]['SoLuong'];
        $gia = $_SESSION['giohang'][$i]['Gia'];
        $sql_cthd = "INSERT INTO ct_hd (MaHD,MaSP, SoLuong, Gia) VALUES ('$abc','$masp', '$soLuong', '$gia')";
        $result2 = $dql->query($sql_cthd,false);
        $sql_cthd = "UPDATE sanpham set SoLuong=Soluong+$soLuong where MaSP='$masp'";
        $result2 = $dql->query($sql_cthd,false);
    }    
    unset($_SESSION['giohang']);
        if($result){
            echo "Đã mua hàng thành công";
        }else{
            echo "Đã xảy ra lỗi";
        }
    }
    
    
    
?>