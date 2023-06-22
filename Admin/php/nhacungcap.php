            <span>Thêm Nhà cung cấp</span>
            <button id="add-new" class="nv btn add-new" type="button" onclick="document.getElementById('a111').style.display='block'" data-toggle="tooltip" data-placement="top" title="Thêm Nhân Viên"><i class="fa-solid fa-circle-plus"></i></button>
            <hr>
            <div id="formup">
                    <h3>Danh sách nhà cung cấp</h3>
                    <hr>
                <table class="table table-bordered" id="myTable">
                    <?php require('hienthiNCC.php'); ?>
                </table>
            </div>

            <div id="abc">

            </div>

            <div class="formabc" id="a111" style="display: none;height: 350px;">
                <form action="ThemNCC.php" method="post" enctype="multipart/form-data"> 
                    <span onclick="document.getElementById('a111').style.display='none'" class="x111" title="Close Modal">×</span>
                    <h3>Thông Tin Loại Sản Phẩm</h3>
                    <input type="number" id="number" hidden="true">
                    <div class="abcd"><label>Mã nhà cung cấp</label>
                        <input type="text" id="mancc" name="maNCC">
                        <br/>
                    </div>
                    <div class="abcd"><label>Tên nhà cung cấp</label>
                        <input type="text" id="tenncc" name="tenNCC">
                        <br/>
                    </div>
                    <div class="abcd"><label>SĐT</label>
                        <input type="text" id="sdt" name="sdt">
                        <br/>
                    </div>
                    <div class="abcd"><label>Email</label>
                        <input type="email" id="email" name="email">
                        <br/>
                    </div>
                    <div class="abcd"><label>Địa chỉ</label>
                        <input type="text" id="diachi" name="diachi">
                        <br/>
                    </div>
                    <div class="abcd">
                        <input type="reset" value="Nhập lại">
                        <input type="submit" name="btnsubmit" id="luulai" value="Lưu lại">
                        <input type="hidden" name="page" value="nhacungcap">
                    </div>
                </form>
            </div>