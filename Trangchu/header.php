<div class="header">
    <div class="header__logo">
        <img src="Trangchu/img/z4231047351454_eeca3900c056538266155ac71ed1465f.png" alt="">
    </div>
    <div class="header__support-user">
        <div class="header__customer-support">
            <div class="header__freeship">
                <div class="header__freeship-icon">
                    <i class="fa-solid fa-truck-fast" style="color: #e90064;"></i>
                </div>
                <div class="header__freeship-text">
                    <p style="color:#e90064">Freeship toàn quốc</p>
                    <p style="color: #fff">Đơn hàng từ 500k</p>
                </div>
            </div>
            <div class="header__change">
                <div class="header__change-icon">
                    <i class="fa-solid fa-arrows-rotate" style="color: #e90064;"></i>
                </div>
                <div class="header__change-text">
                    <p style="color: #fff">Đổi trả 30 ngày</p>
                    <p style="color:#e90064">MIỄN PHÍ</p>
                </div>
            </div>
            <div class="header__guarantee">
                <div class="header__guarantee-icon">
                    <i class="fa-solid fa-hammer" style="color: #e90064"></i>
                </div>
                <div class="header__guarantee-text">
                    <p style="color: #fff">Bảo hành 6 tháng</p>
                    <p style="color:#e90064">MIỄN PHÍ</p>
                </div>
            </div>
        </div>
        <div class="header__support-search search-container">
            <form class="header__search" action="Trangchu/hienthiSP.php" method="get">
                <div class="header__search_a">
                <input type="text" placeholder="Tìm kiếm.." id="search" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">
                </div>   
                <div class="header__search_a">
                    <label for="header__search_a">Giá từ:</label>
                    <input type="text" id="money1" name="money1" value="<?php if(isset($_GET['money1'])) echo $_GET['money1']; ?>" >
                </div>

                <div class="header__search_a">
                    <label for="header__search_a">đến:</label>
                    <input type="text" id="money2" name="money2" value="<?php if(isset($_GET['money2'])) echo $_GET['money2']; ?>" >
                </div>
                <div class="header__search_a">
                    <label for="header__search_a">Số sản phẩm /1 trang:</label>
                    <input type="text" id="sosp" name="sosp" value="<?php if(isset($_GET['sosp'])) echo $_GET['sosp'];?>" >
                </div>
                <div class="header__search_a">
                    <input type="submit" id="submitsearch" value="Tìm">
                </div>
                </form>
        </div>
    </div>    
</div>