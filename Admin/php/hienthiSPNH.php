<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['masp']) && $_GET['masp'] !== ''){
    $masp = $_GET['masp'];
    $sql = "SELECT DISTINCT * from sanpham where MaSP='$masp'"; 
    $sql2 = "SELECT MaTL,TenTL from theloai";
    $sql3 = "SELECT MaSP,TenSP from sanpham";
    $result = $dql->query($sql);  
    $result2 = $dql->query($sql2);
    $result3 = $dql->query($sql3);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';
                foreach ($result as $key => $value) {
                    $output .= '<form id="formspNH" action="nhapSP.php" method="get" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'formNH\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin nhập hàng</h3>
                    <input type="hidden" id="masp" name="masp"  value="'.$value["MaSP"].'" >
                    <div class="thongtin">
                        <div class="thongtinabcd"><label>Mã đơn hàng</label>
                                <input type="text" id="madh" name="madh"  value="">
                        </div>
                        <div class="thongtinabcd"><label>Tên nhân viên</label>
                                <input type="text" id="tennv" name="tennv"  value="">
                        </div>
                        <div class="thongtinabcd"><label>Nhà cung cấp</label>
                                <input type="text" id="tenncc" name="tenncc"  value="">
                        </div>
                        <div class="thongtinabcd"><label>Tổng tiền</label>
                                <input type="text" id="tongtienhd" name="tongtienhd"  value="">
                        </div>
                    </div>
                    <div class="sanphamthem">
                        <ul class="abcddsdonhang">
                        <li class="sanphamli">
                        <div class="abcd"><label>Tên sản phẩm</label>
                                <select id="ten" name="ten" value="'.$value["TenSP"].'">';
                                foreach($result3 as $key3=>$value3) {
                                    $output .= '
                                    <option value="'.$value3["MaSP"].'">'.$value3["TenSP"].'</option>';
                                }
                        $output .= '</select>
                        </div>
                        <div class="abcd"><label>Số lượng</label>
                            <input type="number" min="1" id="soluong" name="soluong"  value="" onchange="tinhTongTien()">
                        </div>
                        <div class="abcd"><label>Giá sản phẩm</label>
                            <input type="text" id="gia" name="gia"  value="" onchange="tinhTongTien()">
                        </div>
                        <div class="abcd"><label>Tổng tiền</label>
                            <input type="text" id="tongtien" name="tongtien"  value="">
                        </div>
                    </li>    
                    </ul>
                    </div>
                    <div class="nutnh">
                        <input type="button" onclick="addProduct()" id="btnthem" value="Thêm">
                        <input type="button" onclick="updateNH()" name="btnsubmit" id="update" value="Update">
                    </div>
                </form>';
                // Trả về HTML để hiển thị trên trang hienthichitietDH.php
                echo $output;
             } 
        }
        else {
            // Trả về một thông báo nếu không có chi tiết đơn hàng nào
            echo "Không sản phẩm nào";
        }
    }
    else{
        // Trả về một thông báo nếu không có mã hóa đơn
        echo "Không tìm thấy mã sản phẩm.";
    }
?>
