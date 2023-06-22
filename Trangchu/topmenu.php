<?php
        session_start();
?>
<div class="headermain">
        <div class="nav-menu__info">
            <div class="infor--cart">
                    <i class="fa-solid fa-cart-shopping" style="color: #e90064;"></i>
                    <a href="index.php?page=trangchu" style="text-decoration: none">
                        <p style="color: var(--text-color)">Trang chủ</p>
                    </a>
            </div>
        </div>
        <div class="nav-menu__info">
            <div class="infor--cart">
                    <i class="fa-solid fa-cart-shopping" style="color: #e90064;"></i>
                    <a href="index.php?page=giohang" style="text-decoration: none">
                        <p style="color: var(--text-color)">Giỏ hàng</p>
                    </a>
            </div>
        </div>
        <?php
            if (isset($_SESSION['username']) && isset($_SESSION['password']))
            {
                $css='#donhang{display:flex}';
                echo "<style>$css</style>";
            } else{
                $css='#donhang{display:none}';
                echo "<style>$css</style>";
            }
        ?>
        <div class="infor--donhang" id="donhang">
                <i class="fa-solid fa-cart-shopping" style="color: #e90064;"></i>
                <a href="index.php?page=donhang" style="text-decoration: none">
                    <p style="color: var(--text-color)">Đơn hàng</p>
                </a>
        </div>
        <div class="infor--user">
            <i class="fa-solid fa-user" style="color: #e90064;"></i>
            <?php 
                if (isset($_SESSION['username']) && isset($_SESSION['password']))
                {
                    echo '<p style="color: white">'.$_SESSION['username'].'</p>';
            ?>
                    <a href="./Login/dangxuat.php" style="text-decoration: none">
                        <p style="color: var(--text-color)">Đăng xuất</p>
                    </a>
            <?php    
                } else {
            ?>
                    
                    <a href="./Login/dangki.php" style="text-decoration: none">
                        <p style="color: var(--text-color); margin-right: 20px;">Đăng ký</p>
                    </a>
                    <a href="./Login/dangnhap.php" style="text-decoration: none">
                        <p style="color: var(--text-color)">Đăng nhập</p>
                    </a>
            <?php        
                }
            ?>
        </div>
        <?php
            if ( empty($_SESSION['nq'])||$_SESSION['nq'] == '0' )
            {
                $css='#an{display:none}';
                echo "<style>$css</style>";
            } else {
                $css='#an{display:flex}';
                echo "<style>$css</style>";
            }
        ?>
        <div class="nav-menu__info" id="an">
            <div class="infor--cart">
                    <i class="fa-solid fa-cart-shopping" style="color: #e90064;"></i>
                    <a href="/doanweb/Admin/php/admin.php" style="text-decoration: none">
                        <p style="color: var(--text-color)">Admin</p>
                    </a>
            </div>
        </div>
</div>