<?php
    // session_start();
    require_once('connectDB.php');
    require_once('VND.php');
    $makh=$_SESSION['username'];

    $dql = new connectDB();
    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = !empty($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    (int)$products_per_page = !empty($_GET['sosp']) ? $_GET['sosp'] : 1;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * (int)$products_per_page;
    // Lấy tổng số lượng sản phẩm
    if(!empty($_GET['start_date']) && !empty($_GET['end_date'])&&!empty($_GET['tinhtrang'])){
        $tinhtrang=$_GET['tinhtrang'];
        $stmt = "SELECT COUNT(*) as total from hoadon,khachhang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh' and  hoadon.hienthi=1 and TinhTrang='$tinhtrang' and NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."'"; 
    }elseif(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $stmt = "SELECT COUNT(*) as total from hoadon,khachhang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  hoadon.hienthi=1 and NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."'";  
    }elseif(!empty($_GET['tinhtrang'])) {
        $tinhtrang=$_GET['tinhtrang'];
        $stmt="SELECT COUNT(*) as total  from hoadon,khachhang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  TinhTrang='$tinhtrang' and hoadon.hienthi=1" ;
    }else {
        $stmt="SELECT COUNT(*) as total from hoadon,khachhang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  hoadon.hienthi=1" ;
    }

    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];
    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page);

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['start_date']) && !empty( $_GET['end_date'])&&!empty($_GET['tinhtrang'])){
        $tinhtrang=$_GET['tinhtrang'];
        $sql = "SELECT MaHD,khachhang.TenKH,NgayMH,TongTien,tinhtrang.MaTT as MaTT, tinhtrang.TenTT as TenTT  from hoadon,khachhang,tinhtrang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh' and tinhtrang.MaTT=hoadon.tinhtrang and hoadon.hienthi=1 and TinhTrang='$tinhtrang' and NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' LIMIT $offset, $products_per_page";
        echo $sql;  
    }elseif(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $sql = "SELECT MaHD,khachhang.TenKH,NgayMH,TongTien,tinhtrang.MaTT as MaTT, tinhtrang.TenTT as TenTT from hoadon,khachhang,tinhtrang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  tinhtrang.MaTT=hoadon.tinhtrang and hoadon.hienthi=1 and NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' LIMIT $offset, $products_per_page";  
    }elseif(!empty($_GET['tinhtrang'])) {
        $tinhtrang=$_GET['tinhtrang'];
        $sql="SELECT MaHD,khachhang.TenKH,NgayMH,TongTien,tinhtrang.MaTT as MaTT, tinhtrang.TenTT as TenTT from hoadon,khachhang,tinhtrang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  tinhtrang.MaTT=hoadon.tinhtrang  and TinhTrang='$tinhtrang' and hoadon.hienthi=1 LIMIT $offset, $products_per_page" ;
    }else {
        $sql="SELECT MaHD,khachhang.TenKH,NgayMH,TongTien,tinhtrang.MaTT as MaTT, tinhtrang.TenTT as TenTT from hoadon,khachhang,tinhtrang where hoadon.MaKH=khachhang.MaKH and hoadon.MaKH='$makh'and  tinhtrang.MaTT=hoadon.tinhtrang  and hoadon.hienthi=1 LIMIT $offset, $products_per_page" ;
    }
    $result = $dql->query($sql);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
                $output = '<table class="table table-bordered" id="myTable">
                            <tr id="thead">
                            <td>Mã hóa đơn</td>
                            <td>Tên khách hàng</td>
                            <td>Ngày mua hàng</td>
                            <td>Tổng tiền</td>
                            <td>Tình trạng </td>
                            <td>Tính Năng</td>
                            </tr>';

            foreach ($result as $key => $value) {
                $output .= '<tr>
                                <td>'.$value["MaHD"].'</td>
                                <td>'.$value["TenKH"].'</td>
                                <td>'.$value["NgayMH"].'</td>
                                <td>'.numberToVND($value["TongTien"]).'</td>
                                <td>'.$value["TenTT"].'<a  href="#" onclick="showTT(\''.$value["MaHD"].'\',\''.$value["MaTT"].'\')" class="edit" title="Chi tiết" data-toggle="tooltip"><i class="fa-solid fa-circle-info"></i></a></td>
                                <td>
                                    <a  href="#" onclick="showCTDH('.$value["MaHD"].',\''.$makh.'\')" class="edit" title="Chi tiết" data-toggle="tooltip"><i class="fa-solid fa-circle-info"></i></a>
                                </td>
                            </tr>';
            }
            $output .= '</table><div class="pagination"><ul class="pagination_list">';
            for($i=1;$i<=$total_pages;$i++){ 
                $output .= '<li class="page-item ' . ((int)$current_page === $i ? "active" : "") . '" onclick="showhd('.$i.')">'.$i.'</li>';
            }
            $output .= '</ul></div>';

            // Trả về HTML để hiển thị trên trang donhang.php
            echo $output;

    } 
    else {
        // Trả về một thông báo nếu không có hóa đơn nào trong khoảng thời gian này
        echo "Không có hóa đơn nào.";
    }
?>
   