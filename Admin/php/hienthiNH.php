<?php
    require_once('connectDB.php');
    $dql = new connectDB();

    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = isset($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = 7;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * $products_per_page;
    // Lấy tổng số lượng sản phẩm
    if(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])&&!empty($_GET['tloai'])){
        $loai=$_GET['loai'];
        $tl=$_GET['tloai'];
        $search = $_GET['txtSearch'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%' and theloai.MaTL='$tl' and sanpham.hienthi = 1";
    }elseif(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])){
        $loai=$_GET['loai'];
        $search = $_GET['txtSearch'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%' and sanpham.hienthi = 1";
    }elseif (!empty($_GET['tloai'])) {
        $tl=$_GET['tloai'];
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$tl' and sanpham.hienthi = 1";
    } else {
        $stmt = "SELECT COUNT(*) AS total FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.hienthi = 1";
    }

    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];
    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page);

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])&&!empty($_GET['tloai'])){
        $loai=$_GET['loai'];
        $tl=$_GET['tloai'];
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%' and theloai.MaTL='$tl' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    }elseif(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])){
        $loai=$_GET['loai'];
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%'  and sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    }elseif(!empty($_GET['tloai'])) {
        $tl=$_GET['tloai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$tl' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    } else {
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    }
    $result = $dql->query($sql);
?>

    <!-- Hiển thị danh sách sản phẩm -->
        <table class="table table-bordered" id="myTable">
        <tr id="thead">
                <td>Mã Sản phẩm</td>
                <td>Tên sản phẩm</td>
                <td>Loại phẩm</td>
                <td>Giá sản phẩm</td>
                <td>Số lượng</td>
                <td id =" abcdf">Ảnh</td>
                <td>Tính Năng</td>
        </tr>
    <?php foreach ($result as $key => $value) { ?>
        <tr>
            <td><?php echo $value['MaSP']; ?></td>
            <td><?php echo $value['TenSP']; ?></td>
            <td><?php echo $value['TenTL']; ?></td>
            <td><?php echo $value['Gia']; ?></td>
            <td><?php echo $value['SoLuong']; ?></td>
            <td><img src="../img/<?php echo $value['Hinhanh']; ?>" alt="" style="width: 50px; height: 50px;"></td>
            <td>
                <a class="edit" title="Thêm" data-toggle="tooltip" onclick="showNH('<?php echo $value['MaSP']; ?>')"><i class="fa-solid fa-cart-plus"></i></a>
            </td>
        </tr>
        
    <?php } ?>
    </table>
    
<!-- Hiển thị phân trang -->
<div class="pagination">
    <ul class="pagination_list">
    <?php for($i=1;$i<=$total_pages;$i++){ ?>
        <li class="page-item <?php echo  (int)$current_page === $i ? "active" :""?>" onclick="showsp(<?php echo $i; ?>)"><?php echo $i; ?></li>
    <?php } ?>
    </ul>
</div>

