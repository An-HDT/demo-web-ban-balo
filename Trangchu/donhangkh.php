<div class="content-donhang">
          <form id="date-form" action="/Trangchu/hienthiDH.php" method="get">
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
                    <label for="end_date">Số sản phẩm/1 trang:</label>
                    <input type="text" id="sosp" name="sosp" value="<?php if(isset($_GET['sosp'])) echo $_GET['sosp']; ?>" >
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
                    <div class="abcd"><label>Mã hóa đơn</label>
                        <input type="text" id="mahd" name="mahd" value=""style="pointer-events: none;">
                        <br/>
                    </div>
                    <div class="abcd"> 
                      <label>Tình trạng</label>
                        <select id="tinh_trang" name="tinh_trang" value="">
                                  <option value="4">Hủy Hàng</option>
                        </select>
                        <br/>
                    </div>
                    <div class="abcd">
                        <input id="submitupdate" type="button" name="btnsubmit" id="updata" value="Update" onclick="update()">
                    </div>
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

                function showCTDH(maHD,makh) {
                  event.preventDefault();
                    var url = 'Trangchu/hienthiCTDH12.php?mahd=' + maHD+'&makh='+makh;
                    console.log(url);
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
                    if(TinhTrang==1){
                    document.getElementById('formtinhtrang').style.display='block';
                    document.getElementById("mahd").value=maHD;
                    document.getElementById("tinhtrang").value=TinhTrang;
                    }else
                    {
                      alert("Đã xữ lý không được hủy hàng");
                    }
                }
                function update() {
                  var result = confirm("Bạn có chắc chắn muốn hủy đơn hàng không ???");
                    if (result) {
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
                  }
                function showhd(page) {
                    var start_date=document.getElementById("start_date").value;
                    var end_date=document.getElementById("end_date").value;
                    var tinhtrang=document.getElementById("tinhtrang").value;
                    var sosp=document.getElementById("sosp").value;
                    event.preventDefault();
                      var url = 'Trangchu/hienthiDH.php?sotrang='+ page+'&start_date='+start_date +'&end_date='+end_date+'&tinhtrang='+tinhtrang+'&sosp='+sosp;
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
</script>