<?php
    require_once 'connectDB.php';
    $dql = new connectDB();

    // Lấy số trang hiện tại từ tham số truyền vào
    $current_page = isset($_GET['sotrang']) ? $_GET['sotrang'] : 1;
    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = !empty($_GET['txtsotrang']) ? $_GET['txtsotrang'] : 5;
    $products_per_page2=(int)$products_per_page;

    // Tính vị trí bắt đầu lấy sản phẩm
    $offset = ((int)$current_page - 1) * $products_per_page2;
    // Lấy tổng số lượng sản phẩm
    if(!empty($_GET['txtSearch'])){
        $search = $_GET['txtSearch'];
        $stmt = "SELECT count(*) as total FROM theloai WHERE  theloai.MaTL  like '%$search%' and theloai.hienthi = 1";
    } else {
        $stmt = "SELECT count(*) as total from theloai where hienthi=1 ";
    }
    // Đếm số phần tử trong mảng kết quả trả về
    // $count = count($result);


    $total_products_stmt = $dql->query($stmt);
    
    $total_products=$total_products_stmt[0]['total'];
    
    // Tính số trang cần hiển thị
    $total_pages = ceil($total_products / $products_per_page2);
    

    // Lấy danh sách sản phẩm cho trang hiện tại
    // $sql = "SELECT * FROM sanpham, theloai WHERE LoaiSP = MaTL AND sanpham.hienthi = 1 LIMIT $offset, $products_per_page";
    if(!empty($_GET['txtSearch'])){
        $search = $_GET['txtSearch'];
        $sql = "SELECT * FROM theloai WHERE  theloai.MaTL  like '%$search%' and theloai.hienthi = 1 LIMIT $offset, $products_per_page2";
} else {
        $sql = "SELECT * from theloai where hienthi=1 LIMIT $offset, $products_per_page2";
    }
    $result = $dql->query($sql);
?>

    <!-- Hiển thị danh sách sản phẩm -->
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr id="thead">
                <th><a href="#" id="MaTL">Mã loại sản phẩm</a></th>
                <th><a href="#" id="TenTL">Tên loại sản phẩm</a></th>
                <th id=" abcdf">Ảnh</th>
                <th>Tính năng</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $key => $value) { ?>
            <tr>
                <td><?php echo $value['MaTL']; ?></td>
                <td><?php echo $value['TenTL']; ?></td>
                <td><img src="../img/<?php echo $value['AnhTL']; ?>" alt="" style="width: 50px; height: 50px;"> </img></td>
                <td>
                    <a onclick="hienTL('<?php echo $value['MaTL']; ?>')"  class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a onclick="deleteTL('<?php echo $value['MaTL'];?>')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            
        <?php } ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#MaTL, #TenTL').click(function() {
            var column = $(this).attr('id');
            var order = 'asc';

            if ($(this).hasClass('asc')) {
            order = 'desc';
            }

            $.ajax({
            url: 'sapxepLSP.php',
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

