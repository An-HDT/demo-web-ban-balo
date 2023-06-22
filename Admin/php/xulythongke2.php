<?php
    require_once 'connectDB.php';
    $dql = new connectDB();
    // Lấy tổng số lượng sản phẩm
    // if(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a']) &&!empty($_GET['txttop'])){
    //     $top=$_GET['txttop'];
    //     $start_date_a=$_GET['start_date_a'];
    //     $end_date_a==$_GET['end_date_a'];
    //     $stmt="SELECT COUNT(*) AS total
    //     FROM (SELECT sanpham.TenSP, SUM(ct_hd.SoLuong) AS Sl FROM sanpham,hoadon,ct_hd
    //     WHERE hoadon.MaHD=ct_hd.MaHD AND ct_hd.MaSP=sanpham.MaSP AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'
    //     GROUP BY sanpham.MaSP
    //     ORDER BY Sl DESC
    //     LIMIT $top) as a";
    // }elseif(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a'])){
    //     $start_date_a=$_GET['start_date_a'];
    //     $end_date_a=$_GET['end_date_a'];
    //     $stmt="SELECT COUNT(*) AS total
    //     FROM (SELECT sanpham.TenSP, SUM(ct_hd.SoLuong) AS Sl FROM sanpham,hoadon,ct_hd
    //     WHERE hoadon.MaHD=ct_hd.MaHD AND ct_hd.MaSP=sanpham.MaSP AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'
    //     GROUP BY sanpham.MaSP
    //     ORDER BY Sl DESC) as a";
    //     echo $stmt;
    // }

    // $total_products_stmt = $dql->query($stmt);
    
    // $total_products=$total_products_stmt[0]['total'];
    
    // // Tính số trang cần hiển thị
    // $total_pages = ceil($total_products / $products_per_page2);
    

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a'])&&!empty($_GET['txttop'])){
        $top=$_GET['txttop'];
        $start_date_a=$_GET['start_date_a'];
        $end_date_a=$_GET['end_date_a'];
        $sql="SELECT sanpham.MaSP,sanpham.TenSP,Hinhanh, SUM(ct_hd.SoLuong) AS Sl,SUM(ct_hd.Gia) As Tong FROM sanpham,hoadon,ct_hd
        WHERE hoadon.MaHD=ct_hd.MaHD AND ct_hd.MaSP=sanpham.MaSP AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'
        GROUP BY sanpham.MaSP
        ORDER BY Sl DESC
        LIMIT $top";
    }elseif(!empty($_GET['start_date_a']) && !empty($_GET['end_date_a'])){
        $start_date_a=$_GET['start_date_a'];
        $end_date_a=$_GET['end_date_a'];
        $sql="SELECT sanpham.MaSP,sanpham.TenSP,Hinhanh, SUM(ct_hd.SoLuong) AS Sl ,SUM(ct_hd.Gia) As Tong FROM sanpham,hoadon,ct_hd
        WHERE hoadon.MaHD=ct_hd.MaHD AND ct_hd.MaSP=sanpham.MaSP AND hoadon.NgayMH BETWEEN '$start_date_a' AND '$end_date_a'
        GROUP BY sanpham.MaSP
        ORDER BY Sl DESC";
    }else{
        $current_time = time(); // timestamp hiện tại
        $one_month_later = strtotime('-1 month', $current_time); // timestamp cách hiện tại 1 tháng
        $formatted_time = date('Y-m-d', $one_month_later);
        $current_time_2 =date('Y-m-d', $current_time);  // định dạng ngày/tháng/năm
        $sql="SELECT sanpham.MaSP,sanpham.TenSP,Hinhanh, SUM(ct_hd.SoLuong) AS Sl ,SUM(ct_hd.Gia) As Tong FROM sanpham,hoadon,ct_hd
        WHERE hoadon.MaHD=ct_hd.MaHD AND ct_hd.MaSP=sanpham.MaSP AND hoadon.NgayMH BETWEEN '$formatted_time' AND '$current_time_2'
        GROUP BY sanpham.MaSP
        ORDER BY Sl DESC";
    }
    $result = $dql->query($sql);
?>

    <!-- Hiển thị danh sách sản phẩm -->
        <table class="table table-bordered" id="myTable">
        <tr id="thead">
                <td>Mã Sản phẩm</td>
                <td>Tên sản phẩm</td>
                <td id =" abcdf">Ảnh</td>
                <td>Số lượng</td>
                <td>Tổng doanh thu</td>
                
        </tr>
    <?php foreach ($result as $key => $value) { ?>
        <tr>
            <td><?php echo $value['MaSP']; ?></td>
            <td><?php echo $value['TenSP']; ?></td>
            <td><img src="../img/<?php echo $value['Hinhanh']; ?>" alt="" style="width: 50px; height: 50px;"></td>
            <td><?php echo $value['Sl']; ?></td>
            <td><?php echo $value['Tong']; ?></td>
        </tr>
    <?php } ?>
    </table>
    

