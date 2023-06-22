<form action="muahang.php" method="POST">
    <div class="giohang">
        <h1>GIỎ HÀNG</h1>
        <div class="boxgh">
            <table border="1" class="tbgiohang" width="100%">
                <tr>
                    <th>STT</th>
                    <th>Mã Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Chỉnh sửa</th>
                </tr>

                <?php
                require_once "VND.php";
                if (isset($_SESSION['giohang'])) {
                    $tong = 0;
                    for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
                        $temp = $_SESSION['giohang'][$i]['Gia'];
                        for ($j = 0; $j < strlen($temp); $j++) {
                            if ($temp[$j] == ".") {
                                for ($k = $j; $k < strlen($temp) - 1; $k++) {
                                    $temp[$k] = $temp[$k + 1];
                                }
                            }
                        }
                        $temp = (int)($temp);
                        $tong = $tong + $temp * $_SESSION['giohang'][$i]['SoLuong'];
                        $a = $i + 1;
                        echo '<tr align="center"> 
                                <td>' . $a . '</td>
                                <td name="sl' . $i . '">' . $_SESSION['giohang'][$i]['MaSP'] . '</td>
                                <td>' . $_SESSION['giohang'][$i]['TenSP'] . '</td>
                                <td>' . $_SESSION['giohang'][$i]['SoLuong'] . '</td>
                                <td>' . numberToVND($_SESSION['giohang'][$i]['Gia']) . '</td>
                                <td><a href="hienthiGH12.php?xoasp=' . $i . '">Xóa</a></td>
                            </tr>';
                    }
                    $i = count($_SESSION['giohang'])-1;

                    echo '
                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Lưu chỉnh sửa của bạn" name="capnhat"></td>
                            <td colspan="3" align="right" ><input type="hidden" name="tongTien" value="'. $tong.'">Tổng: ' . $tong . '</td>
                        </tr>';
                } else {
                    echo '<tr><td colspan="6">Giỏ hàng trống</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
    <div class="btdieuhuong">
        <div><a href="#" id="dathang">Đặt hàng</a></div>
        <div><a href="../index.php">Đóng</a></div>
    </div>
</form>

<?php
if (isset($_POST['capnhat'])) {
    $a = $_POST['capnhat'];
    for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
        if ($_POST['sl' . $i] > 0) {
            $_SESSION['giohang'][$i]['SoLuong'] = $_POST['sl' . $i];
        }
    }
    header("Location:hienthiGH12.php");
}

if (isset($_POST['xoasp'])) {
    if (count($_SESSION['giohang']) == 1) {
        unset($_SESSION['giohang'][0]);
    } else {
        for ($i = $_POST['xoasp']; $i < count($_SESSION['giohang']) - 1; $i++) {
            $_SESSION['giohang'][$i] = $_SESSION['giohang'][$i + 1];
        }
        $k = count($_SESSION['giohang']) - 1;
        unset($_SESSION['giohang'][$k]);
    }
    header("location:hienthiGH12.php");
}
?>

<script>
    // Lưu thông tin giỏ hàng vào Local Storage
    // Kiểm tra và lưu thông tin giỏ hàng vào Local Storage
    <?php if (isset($_SESSION['giohang'])) : ?>
        var gioHang = <?php echo json_encode($_SESSION['giohang']); ?>;
        localStorage.setItem('giohang', JSON.stringify(gioHang));
    <?php endif; ?>

    $(document).ready(function() {
        $('#dathang').on("click", function(event) {
            // Lấy dữ liệu từ biểu mẫu
            var formData = $('form').serialize();
            $.ajax({
                type: 'POST',
                url: "Trangchu/muahang.php",
                data: formData,
                success: function(result) {
                    alert(result);
                    localStorage.removeItem('giohang');
                    location.reload();
                }
            });

            event.preventDefault();
        });
    });
</script>