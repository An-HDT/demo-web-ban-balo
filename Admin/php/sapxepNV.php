<?php
    include('../../Login/connectDB.php');

    $column = $_GET['column'];
    $order = $_GET['order'];

    $sql = "SELECT * FROM nhanvien ORDER BY $column $order";
    $result = mysqli_query($con, $sql);

    // Hiển thị dữ liệu đã sắp xếp trên bảng
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td><?php echo $row['MaNV'];?></td>
            <td><?php echo $row['TenNV'];?></td>
            <td><?php echo $row['SDT'];?></td>
            <td><?php echo $row['DiaChi'];?></td>
            <td><?php echo $row['NgayVL'];?></td>
            <td>
                <a onclick="hien('<?php echo $row['MaNV']; ?>')" href="#" class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a onclick="deleteNV('<?php echo $row['MaNV']; ?>')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </td>
        </tr>
<?php    }
    } else {
        echo "Không tìm thấy dữ liệu";
    }

    mysqli_close($conn);
?>