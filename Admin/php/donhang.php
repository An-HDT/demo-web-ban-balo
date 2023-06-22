            <form id="date-form" action="hienthiDH.php" method="get">
            <div class="date">
                <div class="date-start">
                    <label for="start_date" >Từ ngày:</label>
                    <input type="date" id="start_date" name="start_date" value="<?php if(isset($_GET['start_date'])) echo $_GET['start_date']; ?>" >
                </div>

                <div class="date-end">
                    <label for="end_date">Đến ngày:</label>
                    <input type="date" id="end_date" name="end_date" value="<?php if(isset($_GET['end_date'])) echo $_GET['end_date']; ?>" >
                </div>
                <div class="date-end">
                    <?php
                    require_once('connectDB.php');
                    $dql = new connectDB();
                    $sql = "SELECT * FROM tinhtrang";
                    $result = $dql->query($sql);
                    ?>
                    <label for="end_date">Tìm theo:</label> 
                    <select name="tinhtrang" id="tinhtrang">
                    <option value="" selected>Phân loại</option>
                    <?php
                    foreach($result as $key=>$value) {
                    ?>
                        <option value="<?php echo $value['MaTT']; ?>"><?php echo $value['TenTT']; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="date-end"> 
                  <input type="submit"id="date-button" value="Lọc">
                <!-- <button >Lọc</button> -->
                </div>
            </div>
            </form>
            <hr>
            <div id="formup">
                <h3>Danh sách đơn hàng</h3>
                <hr>
                <div id="danhsachHD">
                   <?php require('hienthiDH.php'); ?>
                </div>
            </div>

            <div class="ctdh" id="ctdh">
            </div>
            <div class="formabc-2" id="formtinhtrang" style="display: none;height:200px;">
                <form id="tinhtrang-form" action="updateTT.php" method="post" enctype="multipart/form-data">
                    <span onclick="document.getElementById('formtinhtrang').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin tình trạng</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã hóa đơn</label>
                        <input type="text" id="mahd" name="mahd" value="" style="pointer-events: none;">
                        <br/>
                    </div>
                    <div class="abcd"> 
                      <label>Tình trạng</label>
                      <?php
                      require_once('connectDB.php');
                      $dql = new connectDB();
                      $sql = "SELECT * FROM tinhtrang";
                      $result = $dql->query($sql);
                      ?>
                        <select id="tinh_trang" name="tinh_trang" value="">
                            <?php
                              foreach($result as $key=>$value) {
                              ?>
                                  <option value="<?php echo $value['MaTT']; ?>"><?php echo $value['TenTT']; ?></option>
                              <?php } ?>
                        </select>
                        <br/>
                    </div>
                    <div class="abcd">
                        <input id="submitupdate" type="button" name="btnsubmit" id="updata" value="Update" onclick="update()">
                    </div>
            </div>
  <script>
              $('#date-form').submit(function(event) {
                event.preventDefault();
                var url = $(this).attr('action') + '?' + $(this).serialize();
                console.log(url);
                $.ajax({
                  url: url,
                  type: 'GET',
                  success: function(response) {
                    $('#danhsachHD').html(response);
                  },
                  error: function() {
                  }
                });
              });

                function showCTDH(maHD) {
                  event.preventDefault();
                    var url = 'hienthiCTDH.php?mahd=' + maHD;
                    $.ajax({
                      url: url,
                      type: 'GET',
                      success: function(response) {
                        $('#ctdh').html(response);
                      },
                      error: function(xhr, status, error) {
                      }
                    });
                  }
                  
                function showTT(maHD,TinhTrang){ 
                    if(TinhTrang==3){
                      alert("Đã giao hàng không thể thay đổi ")
                    }else if(TinhTrang==4){
                      alert("Đã hủy hàng không thể thay đổi ")
                    }else{
                      document.getElementById('formtinhtrang').style.display='block';
                      document.getElementById("mahd").value=maHD;
                      document.getElementById("tinhtrang").value=TinhTrang;
                    }
                }
                function update() {
                    var maHD=document.getElementById('mahd').value;
                    var tinhtrang=document.getElementById('tinh_trang').value;
                    event.preventDefault();
                      var url = 'updateTT.php?mahd=' + maHD +'&tinhtrang='+tinhtrang;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                          alert(response);
                          $('#danhsachHD').load('hienthiDH.php');
                        },
                        error: function() {
                        }
                        
                      });
                  }
                  function deleteDH(mahd) {
                    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
                    if (result) {
                        event.preventDefault(); // ngăn chặn hành động mặc định của trình duyệt
                        var url = 'deleteDH.php?mahd=' + mahd;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                              alert(response);
                              $('#danhsachHD').load('hienthiDH.php');
                            },
                            error: function() {
                            }
                        });
                    }
                }
                function showhd(page) {
                    var start_date=document.getElementById("start_date").value;
                    var end_date=document.getElementById("end_date").value;
                    var tinhtrang=document.getElementById("tinhtrang").value;
                    event.preventDefault();
                      var url = 'hienthiDH.php?sotrang='+ page+'&start_date='+start_date +'&end_date='+end_date+'&tinhtrang='+tinhtrang;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                          $('#danhsachHD').html(response);
                        },
                        error: function() {
                        }
                        
                      });
                  }

                // function showCTDH(maHD) {
                  // document.getElementById('a111').style.display='block';
                  // var xhr = new XMLHttpRequest();
                  // var url = 'hienthiCTDH.php?mahd=' + maHD;
                  // console.log(url)
                  // xhr.open('GET', url);
                  // xhr.onload = function() {
                  //   if (xhr.status === 200) {
                  //     console.log(xhr.responseText)
                  //     document.getElementById('a111').innerHTML = xhr.responseText;
                  //     document.getElementById('a111').style.display='block';

                  //   } else {
                  //     console.error('Lỗi khi tải chi tiết đơn hàng');
                  //   }
                  // };
                  // xhr.send();
                  // }

                  // Sử dụng AJAX để gửi yêu cầu lọc đơn hàng và cập nhật bảng danh sách đơn hàng
                // var form = document.getElementById('date-form');
                // form.addEventListener('submit', function(event) {
                //   event.preventDefault();
                //   var xhr = new XMLHttpRequest();
                //   var url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();
                //   xhr.open('GET', url);
                //   xhr.onload = function() {
                //     if (xhr.status === 200) {
                //       document.getElementById('myTable').innerHTML = xhr.responseText;
                //     }
                //     else {
                //       console.error('Lỗi khi tải dữ liệu');
                //     }
                //   };
                //   xhr.send();
                // });
</script>