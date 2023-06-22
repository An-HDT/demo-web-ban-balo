<div class="nav-menu">
        <ul class="nav-menu__title">Danh mục
            <?php
                require_once('connectDB.php');
                $dql = new connectDB();
                $sql = "SELECT * FROM theloai";
                $result = $dql->query($sql);
                foreach($result as $key=>$value) { 
            ?>
                <a id="theloai_<?php echo $value['MaTL']; ?>"><li class="nav-menu__text" name="<?php echo $value['MaTL'];?>" data-value="<?php echo $value['MaTL'];?>"><?php echo $value['TenTL']; ?></li></a>

            <?php
                }
            ?>
        </ul>
</div>