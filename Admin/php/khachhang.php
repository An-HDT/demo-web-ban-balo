            <form id="search-form" action="hienthiKH.php" method="get">
                <div class="add_search">
                    <!-- <div class="add_search_a">
                    <span>Thêm khách hàng</span>
                    <button id="add-new" class="nv btn add-new" type="button" onclick="document.getElementById('a111').style.display='block'" data-toggle="tooltip" data-placement="top" title="Thêm Nhân Viên"><i class="fa-solid fa-circle-plus"></i></button>
                    </div> -->
                    <div class="add_search_a">
                        <label for="end_date">Search:</label>
                        <input type="text" id="txtSearch" name="txtSearch">
                    </div>
                    <div class="add_search_b">
                        <div>
                            <label for="end_date">Tìm theo:</label> 
                            <select name="loai" id="loai">
                                <option value="MaKH" selected>Mã KH</option>
                                <option value="TenKH">Tên KH</option>
                            </select>
                        </div>
                        <div class="add_search_a">
                            <label for="end_date">Số KH:</label>
                            <input type="text" id="txtsotrang" name="txtsotrang">
                        </div>
                        <div>
                            <input type="submit"id="search-button" value="Lọc">
                            <!-- <button id="search-button">Tìm</button> -->
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div id="formup">
                <h3>Danh sách khách hàng</h3>
                <hr>
                <div id="danhsach">
                <?php require('hienthiKH.php'); ?>
                </div>
            </div>

            <div id="abc">

            </div>
            <div class="formabc-1" id="a1113" style="display: none;">

            </div>

            <div class="formabc" id="a111" style="display: none;height: 375px;">
                <form action="ThemKH.php" method="post" enctype="multipart/form-data">
                    <span onclick="document.getElementById('a111').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Khách Hàng</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã khách hàng</label>
                        <input type="text" id="maKH" name="maKH">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên khách hàng</label>
                        <input type="text" id="ten" name="ten">
                        <br />
                    </div>
                    <div class="abcd"> <label>Giới tính</label>
                        <select id="gioitinh" name="gioitinh" value="">
                            <option value="Nam" selected>Nam
                            <option value="Nữ">Nữ
                        </select>
                        <br />
                    </div>
                    <div class="abcd"><label>SĐT</label>
                        <input type="text" id="sdt" name="sdt">
                        <br />
                    </div>
                    <div class="abcd"><label>Địa chỉ</label>
                        <input type="text"  id="diachi" name="diachi">
                        <br />
                    </div>
                    <div class="abcd"><label>Ngày đăng ký</label>
                        <input type="date" id="ngayDK" name="ngayDK">
                        <br />
                    </div>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại">
                        <input type="hidden" name="page" value="sanpham">
                    </div>
                </form>
            </div>
            
            <div class="formabc-2" id="formupdata" style="display: none;">
                <form action="ThemKH.php" method="post" enctype="multipart/form-data">
                    <span onclick="document.getElementById('formupdata').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Sản Phẩm</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã sản phẩm</label>
                        <input type="text" id="masp" name="masp" value="<?php echo ($maSP); ?>">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên sản phẩm</label>
                        <input type="text" id="ten" name="ten" value="<?php echo ($tenSP); ?>">
                        <br />
                    </div>
                    <div class="abcd"><label>Số lượng</label>
                        <input type="number" min="1" id="soluong" name="soluong" value="<?php echo ($Soluong); ?>">
                        <br />
                    </div>
                    <div class="abcd"><label>Giá sản phẩm</label>
                        <input type="text" id="gia" name="gia" value="<?php echo ($gia); ?>">
                        <br />
                    </div>
                    <div class="abcd"> <label>Phân loại sản phẩm</label>
                        <select name="MenuName" id="phanloai" name="phanloai">
                            <option value="" selected>Phân loại
                            <option value="A"> A
                            <option value="B">B
                            <option value="C">C

                        </select>
                        <br />
                    </div>
                    <div class="abcd"><label>Thêm vào cửa hàng</label>
                        <input type="radio" name="radio" id="yes" value="1">Yes
                        <input type="radio" name="radio" id="no" value="2">No
                        <br />
                    </div>
                    <!-- accept=".jpg, .jpeg, .png" -->
                    <div class="abcd"><label>Ảnh</label>
                        <input type="file" name="image" id="file-upload" onclick=" document.getElementById('image-grid').style.display='block' ;document.getElementById('image-grid2').style.display='none'">
                    </div>
                    <div class="image" id="image-grid">
                        <?php echo "<img width=\"100px\" height=\"130px\" src='../img/" . $filename . "'/>" . "</br>"; ?>
                    </div>
                    <div class="image" id="image-grid2" style="display: none;">

                    </div>
                    <br />
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="updata" value="Lưu lại">
                        <input type="hidden" name="page" value="sanpham">
                    </div>
                </form>
            </div>
            <script>
                $('#search-form').submit(function(event) {
                    event.preventDefault();
                    var url = $(this).attr('action') + '?' + $(this).serialize();
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            $('#danhsach').html(response);
                        },
                        error: function() {
                        }
                    });
                });
                function themsp() {
                    event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                    var form = document.getElementById("formThemSP");
                    var formData = new FormData(form);
                    var url = 'ThemKH.php';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert(response);
                            $('#danhsach').load('hienthiKH.php');
                        },
                        error: function() {
                        }
                    });
                }
                
                function hien(idkh){
                    document.getElementById('a1113').style.display='block';
                    var xhr = new XMLHttpRequest();
                    var url = 'hienupdatekh.php?makh=' + idkh;
                    xhr.open('GET', url);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        document.getElementById('a1113').innerHTML = xhr.responseText;
                        document.getElementById('a1113').style.display='block';
                        } else {
                        console.error('Lỗi khi tải sản phẩm');
                        }
                    };
                    xhr.send();
                }
                
                function updateKH() {
                    event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                    var form = document.getElementById("formupdatesp");
                    var formData = new FormData(form);
                    var url = 'updateKH.php';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert(response);
                            $('#danhsach').load('hienthiKH.php');
                        },
                        error: function() {
                        }
                    });
                }

                function deleteKH(maKH) {
                    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
                    if (result) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var url = 'deleteKH.php?makh=' + maKH;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiKH.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }



                function showKH(page) {
                    var txtSearch=document.getElementById("txtSearch").value;
                    var loai=document.getElementById("loai").value;
                    var txtsotrang=document.getElementById("txtsotrang").value;
                    event.preventDefault();
                      var url = 'hienthiKH.php?sotrang='+ page+'&txtSearch='+txtSearch +'&loai='+loai+'&txtsotrang='+txtsotrang;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                          $('#danhsach').html(response);
                        },
                        error: function() {
                        }
                        
                      });
                  }

            </script>