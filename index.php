<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="img/backpack.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Trangchu/dashboard.css">
    <link rel="stylesheet" href="./Admin/css/admin.css">
    <link rel="stylesheet" href="Trangchu/base.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/f70d9d4b9e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Six+Caps&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@1,300&display=swap" rel="stylesheet">
    <script src="./Trangchu/js/jquery-3.6.3.min.js"></script>
    <title>Balo Cao Cấp</title>
</head>
<body>
    <?php
                if(isset($_GET['page'])){
                            $page=$_GET['page'];
                            switch ($page){
                                case 'trangchu':
                                    require('./Trangchu/topmenu.php');
                                    include("./Trangchu/header.php");
                                    include("./Trangchu/banner.php");
                                    ?>
                                        <div class="nav">
                                            <?php
                                                include("./Trangchu/leftmenu.php");
                                                include("./Trangchu/menu.php");
                                            ?>
                                        </div>
                                    <?php
                                    break;
                                case 'donhang':
                                    require('./Trangchu/topmenu.php');
                                    require('./Trangchu/donhangkh.php');
                                    break;
                                case 'giohang':
                                    require('./Trangchu/topmenu.php');
                                    require('./Trangchu/HienthiGH12.php');
                                    break;
                    }
                    include("./Trangchu/footer.php");
                }else{
                    require('./Trangchu/topmenu.php');
                    include("./Trangchu/header.php");
                    include("./Trangchu/banner.php");
                    ?>
                        <div class="nav">
                            <?php
                                include("./Trangchu/leftmenu.php");
                                include("./Trangchu/menu.php");
                            ?>
                        </div>
                    <?php
                    include("./Trangchu/footer.php");
}      
    ?>
    
    <script>
    // Kiểm tra nếu có thông tin giỏ hàng trong Local Storage
    if (localStorage.getItem('giohang')) {
    // Khôi phục thông tin giỏ hàng từ Local Storage
        var gioHang = JSON.parse(localStorage.getItem('giohang'));

        // Gửi dữ liệu giỏ hàng lên trang xử lý PHP
        $.ajax({
            url: 'Trangchu/khoiphucGH.php',
            type: 'POST',
            data: {
                giohang: JSON.stringify(gioHang)
            },
            success: function(response) {
                console.log(response);
            }
        });
    }

        // $(document).ready(function() {  
        //     $('.nav-product__detail').on( "click", function(event) {
        //     var current = $(event.target).attr('id');
        //     var a = current.slice(2)
        //     $.ajax({
        //             url: "Trangchu/motaSP.php",
        //             type: 'GET',
        //             data: 'masanpham='+a,
        //             success: function(result){
        //                 $('#shopping-cart').html(result)
        //             }
        //         })
        //         event.preventDefault();
        //     })
            
        // })
        
    </script>
</body>
</html>