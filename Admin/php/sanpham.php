            <form id="search-form" action="hienthiSP.php" method="get">
                <div class="add_search">
                    <div class="add_search_a">
                        <span>Thêm sản phẩm</span>
                        <button id="add-new" class="nv btn add-new" type="button" onclick="document.getElementById('a111').style.display='block'" data-toggle="tooltip" data-placement="top" title="Thêm Nhân Viên"><i class="fa-solid fa-circle-plus"></i></button>
                    </div>
                    <div class="add_search_a">
                        <label for="end_date">Search:</label>
                        <input type="text" id="txtSearch" name="txtSearch">
                    </div>
                    <div class="add_search_b">
                        <div>
                            <label for="end_date">Tìm theo:</label> 
                            <select name="loai" id="loai">
                                <option value="MaSP" selected>Mã SP</option>
                                <option value="TenSP">Tên SP</option>
                            </select>
                        </div>
                        <div>
                            <?php
                            require_once('connectDB.php');
                            $dql = new connectDB();
                            $sql = "SELECT * FROM theloai";
                            $result = $dql->query($sql);
                            ?>
                            <label for="end_date">Tìm theo:</label> 
                            <select name="tloai" id="tloai">
                            <option value="" selected>Phân loại</option>
                            <?php
                            foreach($result as $key=>$value) {
                            ?>
                                <option value="<?php echo $value['MaTL']; ?>"><?php echo $value['TenTL']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="add_search_a">
                            <label for="end_date">Số sp:</label>
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
                <h3>Danh sách sản phẩm</h3>
                <hr>
                <div id="danhsach">
                    <?php require('hienthiSP.php'); ?>
                </div>
            </div>

            <div id="abc">

            </div>

            <div class="formabc-1" id="a1112" style="display: none;">

            </div>

            <div class="formabc" id="a111" style="display: none;">
                <form id="formThemSP" action="ThemSP.php" method="post" enctype="multipart/form-data">
                    <?php
                    require_once('connectDB.php');
                    $dql = new connectDB();
                    $sql = "SELECT * FROM theloai";
                    $result = $dql->query($sql);
                    ?>
                    <span onclick="document.getElementById('a111').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Sản Phẩm</h3>
                    <div id="note"></div>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã sản phẩm</label>
                        <input type="text" id="masp" name="masp">
                        <br />
                    </div>
                    <div class="abcd"><label>Tên sản phẩm</label>
                        <input type="text" id="ten" name="ten">
                        <br />
                    </div>
                    <div class="abcd"><label>Số lượng</label>
                        <input type="number" min="1" id="soluong" name="soluong">
                        <br />
                    </div>
                    <div class="abcd"><label>Giá sản phẩm</label>
                        <input type="text" id="gia" name="gia">
                        <br />
                    </div>
                    <div class="abcd"> <label>Phân loại sản phẩm</label>
                        <select id="phanloai" name="phanloai">
                            <option>Phân loại</option>
                            <?php
                            foreach($result as $key=>$value) {
                            ?>
                                <option value="<?php echo $value['MaTL']; ?>"><?php echo $value['TenTL']; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                    </div>
                    <!-- accept=".jpg, .jpeg, .png" -->
                    <div class="abcd"><label>Ảnh</label>
                        <input type="file" name="image" id="file-upload" onclick=" document.getElementById('image-grid').style.display='block' ;document.getElementById('image-grid2').style.display='none'">
                    </div>
                    <div class="image" id="image-grid">

                    </div>
                    <div class="image" id="image-grid2" style="display: none;">

                    </div>
                    <br />
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại">
                        <input type="hidden" value="Nhập lại">
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
                    if (check_register()) {
                        event.preventDefault(); // Ngăn chặn hành động mặc định của trình duyệt
                
                        var form = document.getElementById("formThemSP");
                        var formData = new FormData(form);
                        var url = 'ThemSP.php';
                
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiSP.php');
                            },
                            error: function() {
                                // Xử lý khi có lỗi trong quá trình gửi AJAX
                            }
                        });
                    }
                }
                
                function hien(idsp){
                    document.getElementById('a1112').style.display='block';
                    var xhr = new XMLHttpRequest();
                    var url = 'hienupdateSP.php?masp=' + idsp;
                    xhr.open('GET', url);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        document.getElementById('a1112').innerHTML = xhr.responseText;
                        document.getElementById('a1112').style.display='block';
                        } else {
                        console.error('Lỗi khi tải sản phẩm');
                        }
                    };
                    xhr.send();
                }
                
                function updatesp() {
                    if (check_register()) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var form = document.getElementById("formupdatesp");
                        var formData = new FormData(form);
                        var url = 'updateSP.php';
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiSP.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }

                function deletesp(masp) {
                    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
                    if (result) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var url = 'deleteSP.php?masp=' + masp;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiSP.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }



                function showsp(page) {
                    var txtSearch=document.getElementById("txtSearch").value;
                    var loai=document.getElementById("loai").value;
                    var tloai=document.getElementById("tloai").value;
                    var txtsotrang=document.getElementById("txtsotrang").value;
                    event.preventDefault();
                      var url = 'hienthiSP.php?sotrang='+ page+'&txtSearch='+txtSearch +'&loai='+loai+'&tloai='+tloai+'&txtsotrang='+txtsotrang;
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
                
                // $('#formupdatesp').submit(function(event) {
                //     event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                //     var url = $(this).attr('action') + '?' + $(this).serialize();
                //     console.log(url);
                //     $.ajax({
                //         url: url,
                //         type: 'GET',
                //         success: function(response) {
                //             alert(response);
                //             // $('#danhsach').load('hienthiSP.php');
                //         },
                //         error: function() {
                //         }
                //     });
                // });
            </script>