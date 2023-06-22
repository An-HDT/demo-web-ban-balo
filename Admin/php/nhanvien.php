           <form id="search-form" action="hienthiNV.php" method="get">
                <div class="add_search">
                    <div class="add_search_a">
                    <span>Thêm nhân viên</span>
                    <button id="add-new" class="nv btn add-new" type="button" onclick="document.getElementById('nhanvien').style.display='block'" data-toggle="tooltip" data-placement="top" title="Thêm Nhân Viên"><i class="fa-solid fa-circle-plus"></i></button>
                    </div>
                    <div class="add_search_a">
                        <label for="end_date">Search:</label>
                        <input type="text" id="txtSearch" name="txtSearch">
                    </div>
                    <div class="add_search_b">
                        <div>
                            <label for="end_date">Tìm theo:</label> 
                            <select name="loai" id="loai">
                                <option value="MaNV" selected>Mã NV</option>
                                <option value="TenNV">Tên NV</option>
                            </select>
                        </div>
                        <div class="add_search_a">
                            <label for="end_date">Số NV:</label>
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
                <h3>Danh sách nhân viên</h3>
                <hr>
                <div id="danhsach">
                    <?php require('hienthiNV.php'); ?>
                </div>
            </div>

            <div id="abc">

            </div>
            <div class="formabc-1" id="a1114" style="display: none;">

            </div>

            <div class="formabc" id="nhanvien" style="display: none;">
                <form action="ThemNV.php" method="post" enctype="multipart/form-data">
                    <span onclick="document.getElementById('nhanvien').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Nhân Viên</h3>
                    <div id="note"></div>
                    <div class="abcd"><label>Mã nhân viên</label>
                        <input type="text" id="maNV" name="maNV">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên nhân viên</label>
                        <input type="text" id="TenNV" name="TenNV">
                        <br />
                    </div>
                    <div class="abcd"><label>SĐT</label>
                        <input type="text" id="sdt" name="sdt">
                        <br />
                    </div>
                    <div class="abcd"><label>Địa chỉ</label>
                        <input type="text" id="diachi" name="diachi">
                        <br />
                    </div>
                    <div class="abcd"><label>Quyền</label>
                        <?php
                        require_once('connectDB.php');
                        $dql = new connectDB();
                        $sql = "SELECT * FROM nhomquyen";
                        $result = $dql->query($sql);
                        ?>
                        <select id="phanloai" name="phanloai">
                                <option>Phân loại</option>
                                <?php
                                $dem=0;
                                foreach($result as $key=>$value) {
                                    $dem+=1;
                                    if($dem==1) continue;
                                ?>
                                    <option value="<?php echo $value['MaNQ']; ?>"><?php echo $value['TenNQ']; ?></option>
                                <?php } ?>
                        </select>
                        <br />
                    </div>
                    <div class="abcd"><label>Mật khẩu(nếu tạo tài khoản)</label>
                        <input type="text" id="matkhau" name="matkhau">
                        <br />
                    </div>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại" onclick="ThemNV();">
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
                function themNV() {
                    if (check_registerNV()) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var form = document.getElementById("formThemSP");
                        var formData = new FormData(form);
                        var url = 'ThemNV.php';
                        console.log(url);
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiNV.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }
                
                function hien(idnv){
                    document.getElementById('a1114').style.display='block';
                    var xhr = new XMLHttpRequest();
                    var url = 'hienupdateNV.php?manv=' + idnv;
                    xhr.open('GET', url);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        document.getElementById('a1114').innerHTML = xhr.responseText;
                        document.getElementById('a1114').style.display='block';
                        } else {
                        console.error('Lỗi khi tải sản phẩm');
                        }
                    };
                    xhr.send();
                }
                
                function updateNV() {
                    if (check_registerNV()) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var form = document.getElementById("formupdatesp");
                        var formData = new FormData(form);
                        var url = 'updateNV.php';
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiNV.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }

                function deleteNV(maKH) {
                    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
                    if (result) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var url = 'deleteKH.php?makh=' + maKH;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiNV.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }



                function showNV(page) {
                    var txtSearch=document.getElementById("txtSearch").value;
                    var loai=document.getElementById("loai").value;
                    var txtsotrang=document.getElementById("txtsotrang").value;
                    event.preventDefault();
                      var url = 'hienthiNV.php?sotrang='+ page+'&txtSearch='+txtSearch +'&loai='+loai+'&txtsotrang='+txtsotrang;
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