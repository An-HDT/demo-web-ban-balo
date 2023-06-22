            <form id="search-form" action="" method="get">
                <div class="add_search">
                    <div class="add_search_b">
                        <div>
                            <?php
                            require_once('connectDB.php');
                            $dql = new connectDB();
                            $sql = "SELECT * FROM theloai";
                            $result = $dql->query($sql);
                            ?>
                            <label for="end_date">Thống kê theo:</label>  
                            <select  id="tloai" name="tloai">
                            <option value="" selected>Tất cả</option>
                            <?php
                            foreach($result as $key=>$value) {
                            ?>
                                <option value="<?php echo $value['MaTL']; ?>"><?php echo $value['TenTL']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="date-start">
                            <label for="start_date" >Từ ngày:</label>
                            <input type="date" id="start_date_a" name="start_date_a" value="<?php if(isset($_GET['start_date'])) echo $_GET['start_date']; ?>" >
                        </div>

                        <div class="date-end">
                            <label for="end_date">Đến ngày:</label>
                            <input type="date" id="end_date_a" name="end_date_a" value="<?php if(isset($_GET['end_date'])) echo $_GET['end_date']; ?>" >
                        </div>
                        <!-- <div class="add_search_a">
                            <label for="end_date">Số sp:</label>
                            <input type="text" id="txtst" name="txtst">
                        </div> -->
                        <div class="add_search_a">
                            <label for="end_date">Top:</label>
                            <input type="text" id="txttop" name="txttop">
                        </div>
                        <div>
                            <!-- <input type="submit"id="search-1" value="Thống kê 1">
                            <input type="submit"id="search-2" value="Thống kê 2"> -->

                            <button id="search-1" onclick="showtk1()">Thống kê 1</button>
                            <button id="search-2" onclick="showtk2()">Thống kê 2</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div id="formup">
                <h3>Tình hình kinh doanh trong một khoảng thời gian của các sản phẩm</h3>
                <hr>
                <div id="danhsach1">
                <?php require('xulythongke1.php'); ?>
                </div>
                <hr>
                <h3>Danh sách sản phẩm bán chạy theo khoảng thời gian</h3>
                <hr>
                <div id="danhsach2">
                <?php require('xulythongke2.php'); ?>
                </div>
            </div>
            <Script>
                function showtk1() {
                    var tloai=document.getElementById("tloai").value;
                    var start_date_a=document.getElementById("start_date_a").value;
                    var end_date_a=document.getElementById("end_date_a").value;
                    event.preventDefault();
                      var url = 'xulythongke1.php?tloai='+ tloai+'&start_date_a='+start_date_a+'&end_date_a='+end_date_a;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                          $('#danhsach1').html(response);
                        },
                        error: function() {
                        }
                        
                      });
                  }
                  function showtk2() {
                    var start_date_a=document.getElementById("start_date_a").value;
                    var end_date_a=document.getElementById("end_date_a").value;
                    var txtst=document.getElementById("txtst").value;
                    var txttop=document.getElementById("txttop").value;
                    event.preventDefault();
                      var url = 'xulythongke2.php?start_date_a='+start_date_a+'&end_date_a='+end_date_a+'&txtst='+txtst+'&txttop='+txttop;
                      console.log(url);
                      $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                          $('#danhsach2').html(response);
                        },
                        error: function() {
                        }
                        
                      });
                  }
            </Script>










<!-- SELECT SUM(sales.quantity_sold) AS total_quantity_sold,
       SUM(sales.revenue) AS total_revenue
FROM sales
WHERE sales.date BETWEEN start_date AND end_date;
SELECT products.category,
       SUM(sales.quantity_sold) AS total_quantity_sold,
       SUM(sales.revenue) AS total_revenue
FROM sales
JOIN products ON sales.product_id = products.product_id
WHERE products.category = 'category_name' AND sales.date BETWEEN start_date AND end_date
GROUP BY products.category;
SELECT products.product_name, SUM(sales.quantity_sold) AS total_quantity_sold
FROM sales
JOIN products ON sales.product_id = products.product_id
WHERE sales.date BETWEEN start_date AND end_date
GROUP BY products.product_name
ORDER BY total_quantity_sold DESC;
SELECT products.product_name, DATE_TRUNC('month', sales.date) AS month, SUM(sales.quantity_sold) AS total_quantity_sold
FROM sales
JOIN products ON sales.product_id = products.product_id
GROUP BY products.product_name, month
ORDER BY total_quantity_sold DESC; -->
