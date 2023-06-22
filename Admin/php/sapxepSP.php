<?php
    include('../../Login/connectDB.php');

    $column = $_GET['column'];
    $order = $_GET['order'];

    $sql = "SELECT * FROM sanpham,theloai WHERE sanpham.LoaiSP=theloai.MaTL ORDER BY $column $order";
    $result = mysqli_query($con, $sql);

    // Hiển thị dữ liệu đã sắp xếp trên bảng
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td><?php echo $row['MaSP']; ?></td>
            <td><?php echo $row['TenSP']; ?></td>
            <td><?php echo $row['TenTL']; ?></td>
            <td><?php echo $row['Gia']; ?></td>
            <td><?php echo $row['SoLuong']; ?></td>
            <td><img src="../img/<?php echo $row['Hinhanh']; ?>" alt="" style="width: 50px; height: 50px;"></td>
            <td>
                <a onclick="hien('<?php echo $row['MaSP']; ?>')" href="#" class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a onclick="deletesp('<?php echo $row['MaSP']; ?>')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </td>
        </tr>
<?php    }
    } else {
        echo "Không tìm thấy dữ liệu";
    }

    mysqli_close($conn);
?>