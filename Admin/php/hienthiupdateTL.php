<?php
require_once('connectDB.php');
$dql = new connectDB();
if(isset($_GET['matl']) && $_GET['matl'] !== ''){
    $matl = $_GET['matl'];
    $sql = "SELECT * from theloai where MaTL='$matl'";
    $result= $dql->query($sql);
    if ($result > 0) {
        // Tạo một biến $output để lưu trữ HTML để hiển thị
        $output='';
                foreach ($result as $key => $value) {
                    $output .= '<form id="formupdatesp" action="updateSP.php" method="get" enctype="multipart/form-data">
                    <span onclick="document.getElementById(\'a1112\').style.display=\'none\'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Loại Sản Phẩm</h3>
                    <div id="note"></div>
                    <div class="abcd"><label>Mã Loại sản phẩm</label>
                        <input type="text" id="maTL" name="maTL" value="'.$value["MaTL"].'" style="pointer-events: none;">
                        <br/>
                    </div>
                    <div class="abcd"><label>Tên Loại sản phẩm</label>
                        <input type="text" id="tenTL" name="tenTL" value="'.$value["TenTL"].'">
                        <br/>
                    </div>
                    <!-- accept=".jpg, .jpeg, .png" -->
                    <div class="abcd"><label>Ảnh</label>
                        <input type="file" name="image" id="file-upload" value="'.$value["AnhTL"].'"  onclick=" document.getElementById(\'image-grid\').style.display=\'block\' ;document.getElementById(\'image-grid2\').style.display=\'none\'">
                    </div>
                    <div class="image" id="image-grid" style="display: none;">
                         
                    </div>
                    <div class="image" id="image-grid2" >
                        <img src="../img/'.$value["AnhTL"].'" alt="" style="height: 50px;width: 50px;">
                    </div>
                    <br/>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại" onclick="updateTL();">
                        <input type="hidden" name="page" value="sanpham">
                    </div>
                </form>';
                // Trả về HTML để hiển thị trên trang hienthichitietDH.php
                echo $output;
             } 
        }
        else {
            // Trả về một thông báo nếu không có chi tiết đơn hàng nào
            echo "Không thẻ loại nào";
        }
    }
    else{
        // Trả về một thông báo nếu không có mã hóa đơn
        echo "Không tìm thấy mã thể loại.";
    }
?>
