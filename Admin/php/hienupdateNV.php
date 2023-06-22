<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['manv']) && $_GET['manv'] !== ''){
    $manv = $_GET['manv'];
    $sql = "SELECT DISTINCT * from nhanvien where MaNV='$manv'"; 
    $result = $dql->query($sql);  
    $sql2 = "SELECT DISTINCT * from nhomquyen "; 
    $result2 = $dql->query($sql2);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';
                foreach ($result as $key => $value) {
                    $output .= '<form id="formupdatesp" action="updateKH.php" method="get" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'a1114\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Sản Phẩm</h3>
                    <input type="number" id="number" hidden="true">
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã nhân viên</label>
                        <input type="text" id="maNV" name="maNV" value="'.$value["MaNV"].'" style="pointer-events: none;">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên nhân viên</label>
                        <input type="text" id="TenNV" name="TenNV" value="'.$value["TenNV"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>SĐT</label>
                        <input type="text" id="sdt" name="sdt" value="'.$value["SDT"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>Địa chỉ</label>
                        <input type="text" id="diachi" name="diachi" value="'.$value["DiaChi"].'">
                        <br />
                    </div>
                   
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="button" onclick="updateNV()" name="btnsubmit" id="update" value="Update">
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
 <!-- <div class="abcd"><label>Quyền</label>
                        <select id="phanloai" name="phanloai">
                                <option>Phân loại</option>';
                                foreach($result2 as $key=>$value2) {
                                    $output .= '
                                    <option value="'.$value2["MaNQ"].'">'.$value2["TenNQ"].'</option>';
                                }
                                $output .= '</select>
                        <br />
                    </div> -->
