           <form id="search-form" action="hienthiLSP.php" method="get">
            <div class="add_search">
                    <div class="add_search_a">
                        <span>Thêm loại sản phẩm</span>
                        <button id="add-new" class="nv btn add-new" type="button" onclick="document.getElementById('a111').style.display='block'" data-toggle="tooltip" data-placement="top" title="Thêm Nhân Viên"><i class="fa-solid fa-circle-plus"></i></button>
                    </div>
                    <div class="add_search_a">
                        <label for="end_date">Search:</label>
                        <input type="text" id="txtSearch" name="txtSearch" value="<?php if(isset($_GET['txtSearch'])) echo $_GET['txtSearch']; ?>">
                    </div>
                        <div class="add_search_a">
                            <label for="end_date">Số sp:</label>
                            <input type="text" id="txtsotrang" name="txtsotrang" value="<?php if(isset($_GET['txtsotrang'])) echo $_GET['txtsotrang']; ?>">
                        </div>
                        <div>
                            <input type="submit"id="search-button" value="Lọc">
                            <!-- <button id="search-button">Tìm</button> -->
                        </div>
            </div>
            </form>
            <hr>
            
            <div id="danhsach">
            <?php require('hienthiLSP.php'); ?>
            </div>

            <div id="abc">

            </div>
            <div class="formabc-tl" id="a1112" style="display: none;">

            </div>

            <div class="formabc" id="a111" style="display: none;height: 320px;">
                <form  id="formthemLSP" action="ThemTL.php" method="post" enctype="multipart/form-data"> 
                    <span onclick="document.getElementById('a111').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Loại Sản Phẩm</h3>
                    <div id="note"></div>
                    <div class="abcd"><label>Mã Loại sản phẩm</label>
                        <input type="text" id="maTL" name="maTL">
                        <br/>
                    </div>
                    <div class="abcd"><label>Tên Loại sản phẩm</label>
                        <input type="text" id="tenTL" name="tenTL">
                        <br/>
                    </div>
                    <!-- accept=".jpg, .jpeg, .png" -->
                    <div class="abcd"><label>Ảnh</label>
                        <input type="file" name="image" id="file-upload"   onclick=" document.getElementById('image-grid').style.display='block' ;document.getElementById('image-grid2').style.display='none'">
                    </div>
                    <div class="image" id="image-grid">

                    </div>
                    <div class="image" id="image-grid2" style="display: none;">

                    </div>
                    <br/>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại" onclick="themTL();">
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

                function themTL() {
                    event.preventDefault();
                    if (check_registerTL()) {
                         // Ngăn chặn hành động mặc định của trình duyệt
                        var form = document.getElementById("formthemLSP");
                        var formData = new FormData(form);
                        var url = 'ThemTL.php';
                
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiLSP.php');
                            },
                            error: function() {
                                // Xử lý khi có lỗi trong quá trình gửi AJAX
                            }
                        });
                    }
                }
                
                function hienTL(idsp){
                    document.getElementById('a1112').style.display='block';
                    var xhr = new XMLHttpRequest();
                    var url = 'hienthiupdateTL.php?matl=' + idsp;
                    xhr.open('GET', url);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                        document.getElementById('a1112').innerHTML = xhr.responseText;
                        document.getElementById('a1112').style.display='block';
                        } else {
                        console.error('Lỗi khi tải loại sản phẩm');
                        }
                    };
                    xhr.send();
                }
                
                function updateTL() {
                    event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                    var form = document.getElementById("formupdatesp");
                    var formData = new FormData(form);
                    var url = 'updateTL.php';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            alert(response);
                            $('#danhsach').load('hienthiLSP.php');
                        },
                        error: function() {
                        }
                    });
                }

                function deleteTL(matl) {
                    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
                    if (result) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var url = 'deleteLSP.php?matl=' + matl;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                alert(response);
                                $('#danhsach').load('hienthiLSP.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }



                function showsp(page) {
                    var txtSearch=document.getElementById("txtSearch").value;
                    var txtsotrang=document.getElementById("txtsotrang").value;
                    event.preventDefault();
                      var url = 'hienthiLSP.php?sotrang='+ page+'&txtSearch='+txtSearch +'&txtsotrang='+txtsotrang;
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