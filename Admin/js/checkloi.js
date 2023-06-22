    function validateTenDN(TenDN) {
        // Tối thiểu là 8 ký tự
        var re = /^KH(\d{5})/
        return re.test(TenDN);
    }

    function validateName(Hoten) {
        var re = /[a-zA-Z]{1,}/;
        return re.test(Hoten);
    }

    function validateEmail(Email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(Email);
    }

    function validatePhone(Dienthoai) {
        var re = /^0(\d{9}|9\d{8})$/;
        return re.test(Dienthoai);
    }

    function kytudacbiet() {
        var str = document.getElementById("txtHoten").value;
        console.log(str);
        let res = str.replace(/[\/\\'"?#@!$^&*()<>:"%]/g, "");
        document.getElementById("txtHoten").value = res;
    }

    function validateMaSP(masp) {
        var re = /^SP\d{2}$/;
        return re.test(masp);
    }

    function validateTenSP(tenSP) {
        var re = /^[A-Za-z0-9\s]+$/;
        return re.test(tenSP);
    }

    function validateSoLuong(soLuong) {
        return soLuong < 300;
    }

    function validateGia(gia) {
        return gia >= 0 && gia <= 1000000;
    }

    function check_register() {
        var masp = document.getElementById("masp").value;
        var tenSP = document.getElementById("ten").value;
        var soLuong = document.getElementById("soluong").value;
        var gia = document.getElementById("gia").value;
        var phanLoai = document.getElementById("phanloai").value;
        var anh = document.getElementById("file-upload").files[0].name;

        var noteElement = document.getElementById('note');
        noteElement.style.textAlign = "center";

        if (!validateMaSP(masp)) {
            noteElement.innerText = "Mã sản phẩm không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('masp').focus();
            document.getElementById('masp').select();
            return false;
        } else if (!validateTenSP(tenSP)) {
            noteElement.innerText = "Tên sản phẩm không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('ten').focus();
            document.getElementById('ten').select();
            return false;
        } else if (soLuong === "" || !validateSoLuong(soLuong)) {
            noteElement.innerText = "Số lượng không được để trống và < 300";
            noteElement.style.color = "red";
            document.getElementById('soluong').focus();
            document.getElementById('soluong').select();
            return false;
        } else if (!validateGia(gia) || gia === "") {
            noteElement.innerText = "Giá phải nằm trong khoảng từ 0 đến 1,000,000 và không rỗng";
            noteElement.style.color = "red";
            document.getElementById('gia').focus();
            document.getElementById('gia').select();
            return false;
        } else if (phanLoai === "Phân loại") {
            noteElement.innerText = "Chưa chọn loại sản phẩm";
            noteElement.style.color = "red";
            return false;
        } else if (anh === "") {
            noteElement.innerText = "Chưa có file ảnh";
            noteElement.style.color = "red";
            return false;
        }

        return true;
    }

    function validateMaTL(matl) {
        var re = /^TL\d{2}$/;
        return re.test(matl);
    }

    function validateTenTL(tentl) {
        var re = /^[A-Za-z0-9\s]+$/;
        return re.test(tentl);
    }


    function check_registerTL() {
        var maTL = document.getElementById("maTL").value;
        var tenTL = document.getElementById("tenTL").value;
        var anh = document.getElementById("file-upload").files[0].name;
        var noteElement = document.getElementById('note');
        noteElement.style.textAlign = "center";

        if (!validateMaTL(maTL)) {
            noteElement.innerText = "Mã thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('maTL').focus();
            document.getElementById('maTL').select();
            return false;
        } else if (!validateTenTL(tenTL)) {
            noteElement.innerText = "Tên thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('tenTL').focus();
            document.getElementById('tenTL').select();
            return false;
        } else if (anh === "") {
            noteElement.innerText = "Chưa có file ảnh";
            noteElement.style.color = "red";
            return false;
        }

        return true;
    }

    function validateMaNV(manv) {
        var re = /^TL\d{2}$/;
        return re.test(manv);
    }

    function validateTenNV(tennv) {
        var re = /^[A-Za-z0-9\s]+$/;
        return re.test(tennv);
    }

    function validatePhone(Dienthoai) {
        var re = /^0(\d{9}|9\d{8})$/;
        return re.test(Dienthoai);
    }

    function validateDiachi(diachi) {
        var re = /^[A-Za-z0-9\s]+$/;
        return re.test(diachi);
    }

    function check_registerNV() {
        var maNV = document.getElementById("maNV").value;
        var TenNV = document.getElementById("TenNV").value;
        var sdt = document.getElementById("sdt").value;
        var diachi = document.getElementById("diachi").value;
        var noteElement = document.getElementById('note');
        noteElement.style.textAlign = "center";

        if (!validateMaNV(maNV)) {
            noteElement.innerText = "Mã thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('maNV').focus();
            document.getElementById('maNV').select();
            return false;
        } else if (!validateTenNV(TenNV)) {
            noteElement.innerText = "Tên thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('TenNV').focus();
            document.getElementById('TenNV').select();
            return false;
        } else if (!validatePhone(sdt)) {
            noteElement.innerText = "Tên thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('sdt').focus();
            document.getElementById('sdt').select();
            return false;
        } else if (!validateDiachi(diachi)) {
            noteElement.innerText = "Tên thẻ loại không hợp lệ";
            noteElement.style.color = "red";
            document.getElementById('diachi').focus();
            document.getElementById('diachi').select();
            return false;
        }

        return true;
    }