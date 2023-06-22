            <form id="search-form" action="hienthiNH.php" method="get">
                <div class="add_search">
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
                    <?php require('hienthiNH.php'); ?>
                </div>
            </div>
            <div class="formNH" id="formNH" style="display: none;">

            </div>
            <div id="abc">

            </div>

            <!-- <div class="formNH" id="formNH" style="display: none;">

            </div> -->



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

                    function showNH(masp) {
                    console.log("aâ");
                    document.getElementById('formNH').style.display='block';
                    event.preventDefault();
                        var url = 'hienthiSPNH.php?masp=' + masp;
                        console.log(url);
                        $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            $('#formNH').html(response);
                        },
                        error: function(xhr, status, error) {
                        }
                        });
                    }

                    function themsp() {
                        // lấy đối tượng form bằng id
                        var form = document.getElementById("formThemSP");

                        // sao chép các thẻ input cũ và thêm chúng vào cuối form
                        var inputs = form.querySelectorAll(".abcd input, .abcd select, .abcd label");
                        for (var i = 0; i < inputs.length; i++) {
                            var clone = inputs[i].cloneNode(true);
                            form.appendChild(clone);
                        }
                    }

                    function showsp(page) {
                        var txtSearch=document.getElementById("txtSearch").value;
                        var loai=document.getElementById("loai").value;
                        var tloai=document.getElementById("tloai").value;
                        event.preventDefault();
                        var url = 'hienthiNH.php?sotrang='+ page+'&txtSearch='+txtSearch +'&loai='+loai+'&tloai='+tloai;
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

                    function tinhTongTien() {
                        var soLuong = document.getElementById("soluong").value;
                        console.log(soLuong);
                        var Gia = document.getElementById("gia").value;
                        console.log(Gia);
                        var sum = soLuong * Gia;
                        console.log(sum);
                        document.getElementById("tongtien").value = sum;
                    }

                    function addProduct() {
                    var newProduct = document.createElement("li");
                    newProduct.classList.add("sanphamli");

                    var htmlProduct = '<div class="abcd"><label>Tên sản phẩm</label>' +
                        '<select id="ten" name="ten" value="">';

                    // Gửi yêu cầu AJAX để lấy dữ liệu sản phẩm từ server
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var products = JSON.parse(xhr.responseText);
                            for (var i = 0; i < products.length; i++) {
                                htmlProduct += '<option value="' + products[i].MaSP + '">' + products[i].TenSP + '</option>';
                            }
                            htmlProduct += '</select></div>' +
                                '<div class="abcd"><label>Số lượng</label>' +
                                '<input type="number" min="1" id="soluong" name="soluong" value="" onchange="tinhTongTien()"></div>' +
                                '<div class="abcd"><label>Giá sản phẩm</label>' +
                                '<input type="text" id="gia" name="gia" value="" onchange="tinhTongTien()"></div>' +
                                '<div class="abcd"><label>Tổng tiền</label>' +
                                '<input type="text" id="tongtien" name="tongtien" value="" ></div>';

                            newProduct.innerHTML = htmlProduct;

                            var productList = document.querySelector(".abcddsdonhang");
                            productList.appendChild(newProduct);
                        }
                    };
                    xhr.open("GET", "getProducts.php", true);
                    xhr.send();
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
                //             // $('#danhsach').load('hienthiNH.php');
                //         },
                //         error: function() {
                //         }
                //     });
                // });
</script>