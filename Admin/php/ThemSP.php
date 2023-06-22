<?php
      session_start();
      require_once('connectDB.php');
      $dql = new connectDB();
      $maSP=$_POST['masp'];
      $tenSP=$_POST['ten'];
      $gia=$_POST['gia'];
      $loai=$_POST['phanloai'];
      $Soluong=$_POST['soluong'];
      $filename="noname.jpg";
      $tmp_name = $_FILES["image"]["tmp_name"];
      $fldimageurl = "../img/" . $_FILES["image"]["name"];
      move_uploaded_file($tmp_name, $fldimageurl);
      $filename = $_FILES["image"]["name"];
      /* check lôi bằng php
      if (!preg_match('/^[a-zA-Z\s]+$/', $tenSP)) {
        header("Location: admin.php?page=sanpham");
        $_SESSION['alert_message'] = "Tên sản phẩm không đúng định dạng.";
        // echo "<script>
        // var tenInput = document.getElementById('ten');
        // tenInput.style.border = '1px solid red';
        // </script>";
            // echo "<script>alert('Tên sản phẩm không đúng định dạng.');</script>";
        }
        // Kiểm tra tên sản phẩm có đúng định dạng hay không (ví dụ: chỉ chứa chữ cái và khoảng trắng)
    if (!preg_match('/^[a-zA-Z\s]+$/', $tenSP)) {
        echo "<script>
            var tenInput = document.getElementById('tenInput');
            tenInput.style.border = '1px solid red';
        </script>";
    }

    // Kiểm tra giá có là số không âm hay không
    if (!is_numeric($gia) || $gia < 0) {
        echo "<script>
            var giaInput = document.getElementById('giaInput');
            giaInput.style.border = '1px solid red';
        </script>";
    }

    // Kiểm tra số lượng có là số nguyên dương không
    if (!ctype_digit($Soluong) || $Soluong <= 0) {
        echo "<script>
            var soluongInput = document.getElementById('soluongInput');
            soluongInput.style.border = '1px solid red';
        </script>";
    }
    $cccd = $_POST['cccd'];

    if (!preg_match('/^\d{9,12}$/', $cccd)) {
        echo "Số CCCD/CMND không đúng định dạng.";
    }
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email không đúng định dạng.";
    }
    $phoneNumber = $_POST['phoneNumber'];

    if (!preg_match('/^\d{10}$/', $phoneNumber)) {
        echo "Số điện thoại không đúng định dạng.";
    }
    $name = "";

    if (isset($name)) {
        echo "Biến \$name đã được khởi tạo và tồn tại.";
    } else {
        echo "Biến \$name không tồn tại.";
    }

    if (empty($name)) {
        echo "Biến \$name là rỗng.";
    } else {
        echo "Biến \$name không rỗng.";
    }
    */
      $sql="INSERT INTO sanpham(MaSP, TenSP, Hinhanh, LoaiSP, Gia, SoLuong) VALUES ('$_POST[masp]','$_POST[ten]','$filename','$_POST[phanloai]','$_POST[gia]','$_POST[soluong]')";
      $result = $dql->query($sql,false);
      if ($result) {
          header("Location: admin.php?page=sanpham");
        //   echo "Đã thêm sản phẩm";
      } else {
          // header("Location: admin.php?page=sanpham");
          echo "Thêm sản phẩm không thành công";
      }
?>