<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['mahd']) && $_GET['mahd'] !== ''){
    $maHD = $_GET['mahd'];
    $sql = "SELECT DISTINCT TenKH,khachhang.SĐT as SDT,khachhang.DIACHI as Diachi,hoadon.TongTien as Tongtien from ct_hd,hoadon,khachhang,nhanvien,sanpham where ct_hd.MaHD=hoadon.MaHD and ct_hd.MaSP=sanpham.MaSP and hoadon.MaKH=khachhang.MaKH and hoadon.MaNV=nhanvien.MaNV and hoadon.MaHD='".$maHD."'";  
    $result = $dql->query($sql);

    $sql2 = "SELECT DISTINCT  TenSP,Hinhanh,ct_hd.Gia as Gia,ct_hd.soluong as soluong from ct_hd,hoadon,khachhang,nhanvien,sanpham where ct_hd.MaHD=hoadon.MaHD and ct_hd.MaSP=sanpham.MaSP and hoadon.MaKH=khachhang.MaKH and hoadon.MaNV=nhanvien.MaNV and hoadon.MaHD='".$maHD."'";  
    $result2 = $dql->query($sql2);

    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';

                foreach ($result as $key => $value) {
                    $output .= ' <div class="formabc" id="formcthd"> <form action="" method="" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'formcthd\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin chi tiết sản phẩm</h3>
                    <div class="abcd"><label>Tên người nhận</label>
                    <input type="text" value="'.$value["TenKH"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Số điện thoại</label>
                    <input type="text" value="'.$value["SDT"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Địa Điểm nhận</label>
                    <input type="text" value="'.$value["Diachi"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Các sản phẩm mua</label>
                    </div>
                    <div class="abcd"><ul class="abcddsdonhang">';
                        // Thực hiện vòng lặp foreach thứ hai
                        foreach ($result2 as $key2 => $value2) {
                            $output .= '
                            <li class="sanpham">
                                <div class="imgSP">
                                    <img src="../img/'.$value2["Hinhanh"].'" alt="" style="width: 50px; height: 50px;"></img>
                                </div>
                                <div class="SP-info">
                                    <h1 class="Sp-title">'.$value2["TenSP"].'</h1>
                                    <div class="Sp-gia-sl">'.$value2["Gia"].'VND<span> X '.$value2["soluong"].' cái</span></div>
                                </div>
                            </li>';
                        }
                    
                        $output .= '</ul></div>
                            <div class="abcd"><label>Tổng tiền</label>
                            <input type="text" value="'.$value["Tongtien"].'">
                            <br/>
                        </div>
                        </form>
                        </div>';
                // Trả về HTML để hiển thị trên trang hienthichitietDH.php
                echo $output;
             } 
        }
        else {
            // Trả về một thông báo nếu không có chi tiết đơn hàng nào
            echo "Không tìm chi tiết hóa đơn.";
        }
    }
    else{
        // Trả về một thông báo nếu không có mã hóa đơn
        echo "Không tìm thấy mã hóa đơn.";
    }
?>
