<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['mapn']) && $_GET['mapn'] !== ''){
    $mapn = $_GET['mapn'];
    $sql = "SELECT DISTINCT phieunhap.MaPN as MaPN, TenNV, TenNCC,TenSP,Hinhanh,nhacungcap.SĐT as SDT,nhacungcap.DIACHI as DIACHI,ct_pn.DonGia as DonGia,ct_pn.SoLuong as soluong ,phieunhap.TongTien as Tongtien from ct_pn,phieunhap,nhacungcap,nhanvien,sanpham where ct_pn.MaPN=phieunhap.MaPN and ct_pn.MaSP=sanpham.MaSP and phieunhap.MaNCC=nhacungcap.MaNCC and phieunhap.MaNV=nhanvien.MaNV and phieunhap.MaPN='".$mapn."'";  
    $result = $dql->query($sql);

    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';

                foreach ($result as $key => $value) {
                    $output .= '
                    <div class="formabc" id="a111">
                    <form action="" method="" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'a111\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin chi tiết sản phẩm</h3>
                    <div class="abcd"><label>Tên nhà cung cấp</label>
                    <input type="text" value="'.$value["TenNCC"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Số điện thoại</label>
                    <input type="text" value="'.$value["SDT"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Địa Điểm</label>
                    <input type="text" value="'.$value["DIACHI"].'">
                    <br/>
                    </div>
                    <div class="abcd"><label>Các sản phẩm mua</label>
                    </div>';
                        // Thực hiện vòng lặp foreach thứ hai
                        foreach ($result as $key2 => $value2) {
                            $output .= '<div class="abcd"><ul class="abcddsdonhang">
                            <li class="sanpham">
                                <div class="imgSP">
                                    <img src="../img/'.$value["Hinhanh"].'" alt="" style="width: 50px; height: 50px;"></img>
                                </div>
                                <div class="SP-info">
                                    <h1 class="Sp-title">'.$value["TenSP"].'</h1>
                                    <div class="Sp-DonGia-sl">'.$value["DonGia"].'VND<span> X '.$value["soluong"].' cái</span></div>
                                </div>
                            </li>
                            <li class="sanpham">
                                <div class="imgSP">
                                    <img src="../img/'.$value["Hinhanh"].'" alt="" style="width: 50px; height: 50px;"></img>
                                </div>
                                <div class="SP-info">
                                    <h1 class="Sp-title">'.$value["TenSP"].'</h1>
                                    <div class="Sp-DonGia-sl">'.$value["DonGia"].'VND<span> X '.$value["soluong"].' cái</span></div>
                                </div>
                            </li>
                            </ul></div>';
                        }
                    
                        $output .= '<div class="abcd"><label>Tổng tiền</label>
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
