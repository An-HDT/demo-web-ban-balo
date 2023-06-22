<?php
    require_once 'connectDB.php';
    $dql = new connectDB();
    if(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a'])&&!empty($_GET['tloai'])){
        $tloai=$_GET['tloai'];
        $start_date_a=$_GET['start_date_a'];
        $end_date_a=$_GET['end_date_a'];
        $sql="SELECT SUM(ct_hd.SoLuong) AS TongSoLuong, SUM(hoadon.TongTien) AS TongTien 
        FROM ct_hd, hoadon,sanpham,theloai 
        WHERE theloai.MaTL=sanpham.LoaiSP AND sanpham.MaSP=ct_hd.MaSP AND ct_hd.MaHD = hoadon.MaHD  
        AND theloai.MaTL='$tloai' AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'";
    }elseif(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a'])){
        $start_date_a=$_GET['start_date_a'];
        $end_date_a=$_GET['end_date_a'];
        $sql="SELECT SUM(ct_hd.SoLuong) AS TongSoLuong, SUM(hoadon.TongTien) AS TongTien
        FROM  ct_hd, hoadon
        WHERE  ct_hd.MaHD = hoadon.MaHD AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'";
    }else{
        $current_time = time(); // timestamp hiện tại
        $one_month_later = strtotime('-1 month', $current_time); // timestamp cách hiện tại 1 tháng
        $formatted_time = date('Y-m-d', $one_month_later);
        $current_time_2 =date('Y-m-d', $current_time);  // định dạng ngày/tháng/năm
        $sql="SELECT SUM(ct_hd.SoLuong) AS TongSoLuong, SUM(hoadon.TongTien) AS TongTien
        FROM  ct_hd, hoadon
        WHERE  ct_hd.MaHD = hoadon.MaHD AND hoadon.NgayMH BETWEEN '$formatted_time' AND '$current_time_2'";
    }
    $result = $dql->query($sql);
    function formatToVND($amount) {
        $formattedAmount = number_format($amount, 0, ',', '.') . ' VND';
        return $formattedAmount;
    }
foreach ($result as $key => $value) { ?>
    <div class="thongke">
    <div>
        <i class="fa fa-product-hunt fa-4x"></i>
    </div>
    <div>
        <label for="" style="font-size: 24px;" >Số sản phẩm đã bán: <?php echo $value['TongSoLuong'] ?></label>
    </div>
    </div>
    <div class="thongke1">
    <div>
        <i class="fa fa-money fa-4x"></i>
    </div>
        <label for="" style="font-size: 24px; ">Tổng doanh thu: <?php echo formatToVND($value['TongTien'])  ?></label>
    </div>
    <?php } ?>
    

