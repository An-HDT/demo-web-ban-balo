<?php
    require_once('connectDB.php');
    $dql = new connectDB();
    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = isset($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = 1;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * $products_per_page;
    // Lấy tổng số lượng sản phẩm
    if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $stmt = "SELECT COUNT(*) as total from phieunhap,nhacungcap,nhanvien where phieunhap.MaNCC=nhacungcap.MaNCC and phieunhap.MaNV=nhanvien.MaNV and phieunhap.hienthi=1 and  NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."'"; 
    }else {
        $stmt="SELECT COUNT(*) as total from phieunhap,nhacungcap,nhanvien where phieunhap.MaNCC=nhacungcap.MaNCC and phieunhap.MaNV=nhanvien.MaNV and phieunhap.hienthi=1 " ;
    }

    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];
    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page);

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
        $sql = "SELECT MaPN,nhanvien.TenNV,NgayNhap,TongTien from phieunhap,nhacungcap,nhanvien where phieunhap.MaNCC=nhacungcap.MaNCC and phieunhap.MaNV=nhanvien.MaNV and phieunhap.hienthi=1 and  NgayMH BETWEEN '".$_GET['start_date']."' AND '".$_GET['end_date']."' LIMIT $offset, $products_per_page";  
    }else {
        $sql="SELECT MaPN,nhanvien.TenNV,NgayNhap,TongTien from phieunhap,nhacungcap,nhanvien where phieunhap.MaNCC=nhacungcap.MaNCC and phieunhap.MaNV=nhanvien.MaNV and phieunhap.hienthi=1 LIMIT $offset, $products_per_page" ;
    }
    $result = $dql->query($sql);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
                $output = '<table class="table table-bordered" id="myTable">
                            <tr id="thead">
                            <td>Mã Phiếu Nhập</td>
                            <td>Tên nhân viên</td>
                            <td>Ngày nhập hàng</td>
                            <td>Tổng tiền</td>
                            <td>Tính Năng</td>
                            </tr>';

            foreach ($result as $key => $value) {
                $output .= '<tr>
                            <td>'.$value["MaPN"].'</td>
                            <td>'.$value["TenNV"].'</td>
                            <td>'.$value["NgayNhap"].'</td>
                            <td>'.$value["TongTien"].'</td>
                            <td>
                                <a onclick="deletePN(\''.$value["MaPN"].'\')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o"aria-hidden="true"></i></a>
                                    <a  href="#" onclick="showCTNH(\''.$value["MaPN"].'\')" class="edit" title="Chi tiết" data-toggle="tooltip"><i class="fa-solid fa-circle-info"></i></a>
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
   