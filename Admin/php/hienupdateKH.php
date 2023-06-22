<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['makh']) && $_GET['makh'] !== ''){
    $makh = $_GET['makh'];
    $sql = "SELECT DISTINCT * from khachhang where MaKH='$makh'"; 
    $result = $dql->query($sql);  
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';
                foreach ($result as $key => $value) {
                    $output .= '<form id="formupdatesp" action="updateKH.php" method="get" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'a1113\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Sản Phẩm</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã khách hàng</label>
                        <input type="text" id="makh" name="makh"  value="'.$value["MaKH"].'" style="pointer-events: none;">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên sản phẩm</label>
                        <input type="text" id="ten" name="ten" value="'.$value["TenKH"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>SĐT</label>
                        <input type="text" id="sdt" name="sdt"  value="'.$value["SĐT"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>Địa chỉ</label>
                        <input type="text" id="diachi" name="diachi"  value="'.$value["DIACHI"].'">
                        <br />
                    </div>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="button" onclick="updateKH()" name="btnsubmit" id="update" value="Update">
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
