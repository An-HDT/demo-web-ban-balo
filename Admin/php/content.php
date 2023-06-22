<?php
            if(isset($_GET['page']))
            {
                $page=$_GET['page'];
                switch ($page){
                    case 'sanpham':
                        require('./sanpham.php');
                        break;
                    case 'loaisp':
                        require('./loaiSP.php');
                        break;
                    case 'donhang':
                        require('./donhang.php');
                        break;
                    case 'khachhang':
                        require('./khachhang.php');
                        break;
                    case 'nhanvien':
                        require('./nhanvien.php');
                        break;
                    case 'nhaphang':
                        require('./nhaphang.php');
                        break;
                    case 'phieunhap':
                        require('./phieunhap.php');
                        break;   
                    case 'nhacungcap':
                        require('./nhacungcap.php');
                        break;   
                    case 'thongke':
                        require('./thongke.php');
                        break;
                    case 'taikhoan':
                        require('./taikhoan.php');
                        break;   
                }
            }
                else return 0;

?>