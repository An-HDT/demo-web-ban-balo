<?php
        require_once('connectDB.php');
        $dql = new connectDB();
        $sql="select * from nhacungcap where hienthi=1";
        $result = $dql->query($sql);
?>

            <tr id="thead">
            <td>Mã nhà cung cấp</td>
            <td>Tên nhà cung cấp</td>
            <td>Số điện thoại</td>
            <td>Email</td>
            <td>Địa chỉ</td>
            <td>Tính Năng</td>
        <?php
            foreach($result as $key =>$value){?>
            <tr>
            <td><?php echo $value['MaNCC'];?></td>
            <td><?php echo $value['TenNCC'];?></td>
            <td><?php echo $value['SĐT'];?></td>
            <td><?php echo $value['EMAIL'];?></td>
            <td><?php echo $value['DIACHI'];?></td>
            <td>
                       <a href="admin.php?page=sanpham&maNCC=<?php echo $value['MaNCC'];?>" class="edit" title="Sửa" data-toggle="tooltip"><i class="fa fa-pencil"
                               aria-hidden="true"></i></a>
                       <a onclick="return confirm('bạn có chắc chắn xóa sp này ko?')" href="deleteNCC.php?maNCC=<?php echo $value['MaNCC'];?>" class="delete" title="Xóa" data-toggle="tooltip"><i class="fa fa-trash-o"
                               aria-hidden="true"></i></a>
                   </td>
            </tr>
        <?php
        }
?>