<?php

include './connectDB.php';
$error = false;
if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $result = mysqli_query($con, "INSERT INTO khachhang (MaKH, TenKH, SDT, Email, DIACHI, NgayDK, hienthi) 
    VALUES ('" .$_POST['username']. "','" .$_POST['fullname']. "','" .$_POST['sdt']. "','" .$_POST['email']. "','" .$_POST['address']. "', NOW(),1);");
    $result1 = mysqli_query($con, "INSERT INTO taikhoan (MaTK, MaKH, MaNV, TenDN, MatKhau, NgayTao, TTrang, NhomQuyen) 
    VALUES (NULL,'" .$_POST['username']. "', NULL,'" .$_POST['username']. "','" .$_POST['password']. "', NOW(), 0, 0);");
    if (!$result && !$result1) {
        if (strpos(mysqli_error($con), "Duplicate entry") !== FALSE) {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Tên đăng nhập đã tồn tại'
            ));
            exit;
        }
    }
    mysqli_close($con);
    if ($error !== false) {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Có lỗi khi đăng ký, xin mời thử lại'
        ));
        exit;
    } else {
        echo json_encode(array(
            'status' => 1,
            'message' => 'Đăng ký thành công'
        ));
        exit;
    }
?>
<?php

} else {
    echo json_encode(array(
        'status' => 0,
        'message' => 'Bạn chưa nhập thông tin'
    ));
    exit;
}
?>