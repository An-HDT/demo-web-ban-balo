<?php
   if(isset($_GET['masanpham']))
   {
    include('../Login/connectDB.php');
    $msp = $_GET['masanpham'];
    $sql ="SELECT * FROM sanpham where MaSP = '$msp'";
    $kq = mysqli_query($con,$sql);
    while($rows= mysqli_fetch_array($kq)){
        echo '<div id="infoProduct">
        <h1>THÔNG TIN SẢN PHẨM</h1>
        </div>
        <div> <img src="'.$rows['Hinhanh'].'">
        <div>
            <div>Mô Tả</div>
            <div>'.$rows['Mota'].'<div>
        </div>
        </div>
        <div class="shopping_cart_title">
        <h3 class="cart-text font_italic">'.$rows['TenSP'].'</h3>
        <h5 class="cart-text">Mã sản phẩm:'.$rows['MaSP'].'</h5>
        <input type="number" value="1" id="quantityCart">
        <button class=" letter_spacing_3px">Thêm vào giỏ hàng</button> </div>';
    }
   }
   
?>