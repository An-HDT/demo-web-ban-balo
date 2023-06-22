<?php
    require_once('connectDB.php');
    require_once 'VND.php';
    $dql = new connectDB();
    $masp=$_GET['maSP'];
    $sql="SELECT * FROM sanpham where sanpham.MaSP='$masp'";
    $result = $dql->query($sql);
?>
            <?php foreach ($result as $key => $value) { ?>
                <form id="formCTSP" action="">
                <span onclick="document.getElementById('CTSP').style.display='none'" class="x111" title="Close Modal">×</span>
                    <div id="infoProduct">
                        <h1>THÔNG TIN SẢN PHẨM</h1>
                    </div>
                        <div style="text-align: center;"> 
                            <div>
                                <img src="Trangchu/img/<?php echo $value['Hinhanh']; ?>" alt="" style="width: 200px; height: 200px;">
                            </div>
                            <div>
                                <h5><?php echo $value['MoTa']; ?></h5>
                            </div>
                        </div>
                    <div class="shopping_cart_title" style="text-align: center;">
                        <h3 class="cart-text">Tên sản phẩm: <?php echo $value['TenSP']; ?></h3>
                        <h3>Giá: <?php echo numberToVND($value['Gia']); ?></h3>
                        <input id="quantity" type="text" value="1" name="quantity">
                        <button type="submit" onclick="mua('<?php echo $value['MaSP']; ?>')" class="mua" style="cursor: pointer;">Mua sản phẩm</button> 
                    </div>
                </form>
                <?php } ?>