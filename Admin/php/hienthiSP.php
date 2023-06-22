<?php
    require_once 'connectDB.php';
    $dql = new connectDB();

    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = isset($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = !empty($_GET['txtsotrang']) ? $_GET['txtsotrang'] : 7;
    $products_per_page2=(int)$products_per_page;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * $products_per_page2;
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
    // Đếm số phần tử trong mảng kết quả trả về
    // $count = count($result);


    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];
    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page2);
    

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])&&!empty($_GET['tloai'])){
        $loai=$_GET['loai'];
        $tl=$_GET['tloai'];
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%' and theloai.MaTL='$tl' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    }elseif(!empty($_GET['txtSearch'])&&!empty($_GET['loai'])){
        $loai=$_GET['loai'];
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and $loai like '%$search%'  and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    }elseif(!empty($_GET['tloai'])) {
        $tl=$_GET['tloai'];
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and theloai.MaTL='$tl' and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    } else {
        $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL and sanpham.hienthi = 1 LIMIT $offset, $products_per_page2";
    }
    $result = $dql->query($sql);
?>

    <!-- Hiển thị danh sách sản phẩm -->
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr id="thead">
                <th><a href="#" id="MaSP">Mã Sản phẩm</a></th>
                <th><a href="#" id="TenSP">Tên sản phẩm</a></th>
                <th>Loại sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th id =" abcdf">Ảnh</th>
                <th>Tính Năng</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $key => $value) { ?>
            <tr>
                <td><?php echo $value['MaSP']; ?></td>
                <td><?php echo $value['TenSP']; ?></td>
                <td><?php echo $value['TenTL']; ?></td>
                <td><?php echo $value['Gia']; ?></td>
                <td><?php echo $value['SoLuong']; ?></td>
                <td><img src="../img/<?php echo $value['Hinhanh']; ?>" alt="" style="width: 50px; height: 50px;"></td>
                <td>
                    <a onclick="hien('<?php echo $value['MaSP']; ?>')" href="#" class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a onclick="deletesp('<?php echo $value['MaSP']; ?>')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            
        <?php } ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#MaSP, #TenSP').click(function() {
            var column = $(this).attr('id');
            var order = 'asc';

            if ($(this).hasClass('asc')) {
            order = 'desc';
            }

            $.ajax({
            url: 'sapxepSP.php',
            type: 'GET',
            data: { column: column, order: order },
            success: function(response) {
                $('tbody').html(response);
                $('.asc, .desc').removeClass('asc desc');

                if (order == 'asc') {
                $('#' + column).addClass('asc');
                } else {
                $('#' + column).addClass('desc');
                }
            }
            });
        });
        });
    </script>
<!-- Hiển thị phân trang -->
<div class="pagination">
    <ul class="pagination_list">
    <?php for($i=1;$i<=$total_pages;$i++){ ?>
        <li class="page-item <?php echo  (int)$current_page === $i ? "active" :""?>" onclick="showsp(<?php echo $i; ?>)"><?php echo $i; ?></li>
    <?php } ?>
    </ul>
</div>

