<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['masp']) && $_GET['masp'] !== ''){
    $masp = $_GET['masp'];
    $sql = "SELECT DISTINCT * from sanpham where MaSP='$masp'"; 
    $sql2 = "SELECT MaTL,TenTL from theloai";
    $result = $dql->query($sql);  
    $result2 = $dql->query($sql2);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';
                foreach ($result as $key => $value) {
                    $output .= '<form id="formupdatesp" action="updateSP.php" method="get" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'a1112\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Sản Phẩm</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã sản phẩm</label>
                        <input type="text" id="masp" name="masp"  value="'.$value["MaSP"].'" style="pointer-events: none;">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên sản phẩm</label>
                        <input type="text" id="ten" name="ten" value="'.$value["TenSP"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>Số lượng</label>
                        <input type="number" min="1" id="soluong" name="soluong"  value="'.$value["SoLuong"].'">
                        <br />
                    </div>
                    <div class="abcd"><label>Giá sản phẩm</label>
                        <input type="text" id="gia" name="gia"  value="'.$value["Gia"].'">
                        <br />
                    </div>
                    <div class="abcd"> <label>Phân loại sản phẩm</label>
                        <select id="phanloai" name="phanloai" value="'.$value["LoaiSP"].'">';
                            foreach($result2 as $key2=>$value2) {
                                $output .= '
                                <option value="'.$value2["MaTL"].'">'.$value2["TenTL"].'</option>';
                            }
                    $output .= '</select>
                    <br />
                    </div>
                    <!-- accept=".jpg, .jpeg, .png" -->
                    <div class="abcd"><label>Ảnh</label>
                        <input type="file" name="image" value="'.$value["Hinhanh"].'" id="file-upload" onclick=" document.getElementById(\'image-grid\').style.display=\'block\' ;document.getElementById(\'image-grid2\').style.display=\'none\'">
                    </div>
                    <div class="image" id="image-grid" style="display: none;">
                         
                    </div>
                    <div class="image" id="image-grid2" >
                        <img src="../img/'.$value["Hinhanh"].'" alt="" style="height: 50px;width: 50px;">
                    </div>
                    <br />
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="button" onclick="updatesp()" name="btnsubmit" id="update" value="Update">
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
