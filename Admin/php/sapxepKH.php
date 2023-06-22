<?php
    include('../../Login/connectDB.php');

    $column = $_GET['column'];
    $order = $_GET['order'];

    $sql = "SELECT * FROM khachhang ORDER BY $column $order";
    $result = mysqli_query($con, $sql);

    // Hiển thị dữ liệu đã sắp xếp trên bảng
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $row['MaKH'];?></td>
        <td><?php echo $row['TenKH'];?></td>
        <td><?php echo $row['SDT'];?></td>
        <td><?php echo $row['DIACHI'];?></td>
        <td>
        <a onclick="hien('<?php echo $row['MaKH']; ?>')" href="#" class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a onclick="deleteKH('<?php echo $row['MaKH']; ?>')" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        </td>
    </tr>
<?php    }
    } else {
        echo "Không tìm thấy dữ liệu";
    }

    mysqli_close($conn);
?>