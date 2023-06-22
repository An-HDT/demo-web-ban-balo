<?php
    require_once 'VND.php';
    require_once 'connectDB.php';
    $dql = new connectDB();
    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = isset($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = !empty($_GET['sosp']) ? $_GET['sosp'] : 7;
    $products_per_page2=(int)$products_per_page;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * $products_per_page2;
    // Lấy tổng số lượng sản phẩm
    if(!empty($_GET['search'])&&!empty($_GET['money1'])&&!empty($_GET['money2'])&&!empty($_GET['loai'])&&$_GET['loai']!='null'){
        $search = $_GET['search'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $loai=$_GET['loai'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and sanpham.Gia BETWEEN '$money1' AND '$money2' and theloai.MaTL='$loai' and sanpham.hienthi = 1";
    }elseif(!empty($_GET['search'])&&!empty($_GET['loai'])&&$_GET['loai']!='null'){
        $search = $_GET['search'];
        $loai=$_GET['loai'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and theloai.MaTL='$loai'  and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    }elseif(!empty($_GET['money1'])&&!empty($_GET['money2']&&!empty($_GET['loai'])&&$_GET['loai']!='null')){
        $loai=$_GET['loai'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$loai' and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1";
    }elseif(!empty($_GET['search'])&&!empty($_GET['money1'])&&!empty($_GET['money2'])){
        $search = $_GET['search'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1";
    }elseif (!empty($_GET['loai'])&&$_GET['loai']!='null') {
        $tl=$_GET['loai'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$tl' and sanpham.hienthi = 1";
    }elseif (!empty($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.TenSP like '%$search%' and sanpham.hienthi = 1";
    }elseif (!empty($_GET['money1'])&&!empty($_GET['money2'])) {
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1";
    } else {
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.hienthi = 1";
    }
    // Đếm số phần tử trong mảng kết quả trả về
    // $count = count($result);


    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];

    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page2);
    

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['search'])&&!empty($_GET['money1'])&&!empty($_GET['money2'])&&!empty($_GET['loai'])&&$_GET['loai']!='null'){
        $search = $_GET['search'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $loai=$_GET['loai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and sanpham.Gia BETWEEN '$money1' AND '$money2' and theloai.MaTL='$loai' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    }elseif(!empty($_GET['search'])&&!empty($_GET['loai'])&&$_GET['loai']!='null'){
        $search = $_GET['search'];
        $loai=$_GET['loai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and theloai.MaTL='$loai'  and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    }elseif(!empty($_GET['money1'])&&!empty($_GET['money2']&&!empty($_GET['loai'])&&$_GET['loai']!='null')){
        $loai=$_GET['loai'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$loai' and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    }elseif(!empty($_GET['search'])&&!empty($_GET['money1'])&&!empty($_GET['money2'])){
        $search = $_GET['search'];
        $money1=$_GET['money1'];
        $money2=$_GET['money2'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.TenSP like '%$search%' and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    }elseif (!empty($_GET['loai'])&&$_GET['loai']!='null') {
        $tl=$_GET['loai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$tl' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    }elseif (!empty($_GET['search'])) {
        $tl=$_GET['loai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.TenSP like '%$search%' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    }elseif (!empty($_GET['money1'])&&!empty($_GET['money2'])) {
        $tl=$_GET['loai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.Gia BETWEEN '$money1' AND '$money2' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2" ;
    } else {
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.hienthi = 1 LIMIT $products_per_page2 offset $offset" ;
    }
    echo $sql;
    $result = $dql->query($sql);
?>

    <!-- Hiển thị danh sách sản phẩm -->
    <div class="product">
    <?php foreach ($result as $key => $value) { ?>
                        <div class="nav-product__detail">
                            <div class="nav-product__detail--img">
                                <img src="Trangchu/img/<?php echo $value['Hinhanh']; ?>"alt="<?php echo $value['TenSP']; ?>" class="nav-product__detail--img">
                                <img src="Trangchu/img/<?php  echo $value['Hinhanh']; ?>" alt="<?php echo $value['TenSP']; ?>" class="nav-product__detail--img img--Back">
                            </div>
                            <div class="nav-product__detail--price">
                                <p class="nav-product__detail--price__text" onclick="hienCTSP('<?php echo $value['MaSP'];?>')">
                                <?php echo $value['TenSP'];?>-<?php echo $value['TenTL'];?>
                                </p>
                                <div class="nav-product__detail--price__num" style="font-weight: 300;">
                                <?php echo numberToVND($value['Gia']); ?>
                                </div>
                            </div>
                        </div>
    <?php } ?>
                        <div class="modal" id="modal">
                            <div class="modal_container">
                                <div id="shopping-cart"></div>
                            </div>
                        </div>
    </div>
<!-- Hiển thị phân trang -->
<div class="pagination">
    <ul class="pagination_list">
    <?php for($i=1;$i<=$total_pages;$i++){ ?>
        <li class="page-item <?php echo  (int)$current_page === $i ? "active" :""?>" onclick="showsp(<?php echo $i; ?>)"><?php echo $i; ?></li>
    <?php } ?>
    </ul>
</div>

