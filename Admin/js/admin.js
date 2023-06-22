// Phần Lưu thông tin tạo danh sách SP
function save() {
    var index = document.getElementById("number").value;
    var ten = document.getElementById("ten").value;
    var gia = document.getElementById('gia').value;
    var phanloai = document.getElementById('phanloai').value;
    var them = ""; ////
    if (document.getElementById('yes').checked) {
        them = '<i class="fa-regular fa-circle-check"></i>';

    } else if (document.getElementById('no').checked) {
        them = '<i class="fa-regular fa-circle-xmark"></i>';
    }

    var upload = document.getElementById("file-upload").files[0].name;
    document.getElementById('image-grid').style.display = 'block';
    document.getElementById('image-grid2').style.display = 'none';
    if (ten == "" && gia == "" && phanloai == "" && them == "" && upload == "") {
        alert("Bạn chưa nhập dữ liệu nào!!!");
    }
    if (ten == "") {
        alert("Tên sản phẩm không được để trống!!!");
    } else if (gia == "") {
        alert("Bạn phải nhập giá cho sản phẩm!!!");
    } else if (isNaN(gia)) {
        alert("Giá sản phẩm phải là số!!!");
    } else if (phanloai == "") {
        alert("Bạn phải phân loại sản phẩm!!!");
    } else if (them == "") {
        alert("Bạn phải chọn yes or no!!!");
    } else if (upload == "") {
        alert("Bạn phải thêm ảnh!!!");
    } else {
        var check = confirm("Bạn có chắc chắn muốn thêm sản phẩm không ?");
        if (check) {
            var sanpham = localStorage.getItem('sanpham') ? JSON.parse(localStorage.getItem('sanpham')) : [];
            var sanphama = {
                ten: ten,
                gia: gia,
                phanloai: phanloai,
                them: them,
                upload: upload,
            }
            if (index != "") {
                sanpham[index] = sanphama
                localStorage.setItem('sanpham', JSON.stringify(sanpham))
                show();
                if (document.getElementById('yes').checked) {
                    abc();

                } else
                if (document.getElementById('no').checked) {
                    return 0;
                }

            } else {
                sanpham.push(sanphama);
                localStorage.setItem('sanpham', JSON.stringify(sanpham))
                show();
                if (document.getElementById('yes').checked) {
                    abc();

                } else if (document.getElementById('no').checked) {
                    return 0;
                }
            }
        }

    }
}

// Hiển thị danh sách Sp
function show() {
    var sanpham = localStorage.getItem('sanpham') ? JSON.parse(localStorage.getItem('sanpham')) : [];

    var table = `<tr id="thead">
        <td>STT</td>
        <td>Tên sản phẩm</td>
        <td>Giá sản phẩm</td>
        <td>Phân loại</td>
        <td>Thêm</td>
        <td id =" abcdf">Ảnh</td>
        <td>Tính Năng</td>
        </tr>`;
    sanpham.forEach((sanpham, index) => {
        var sanphamID = index;
        index++;
        table += `<tr>
        <td>${index}</td>
        <td>${sanpham.ten}</td>
        <td>${sanpham.gia}</td>
        <td>${sanpham.phanloai}</td>
        <td>${sanpham.them}</td>
        <td><img src = "../img/${sanpham.upload}"alt = ""style = "width: 50px; height: 50px;" > </img></td>
        <td>
                    <a class="edit" title="Sửa" data-toggle="tooltip" onclick="editSP(${sanphamID})"><i class="fa fa-pencil"
                            aria-hidden="true"></i></a>
                    <a class="delete" title="Xóa" data-toggle="tooltip" onclick="kiemTra(${sanphamID})"><i class="fa fa-trash-o"
                            aria-hidden="true"></i></a>
                </td>
        </tr>`;

    })
    document.getElementById('myTable').innerHTML = table;
}
//Lưu Thông tin SP Hiển thị lên cửa hàng
function abc() {
    var ten = document.getElementById("ten").value;
    var gia = document.getElementById('gia').value;
    var phanloai = document.getElementById('phanloai').value;
    var upload = document.getElementById("file-upload").files[0].name;
    if (ten && gia && phanloai && upload) {
        var hienthi = localStorage.getItem('hienthi') ? JSON.parse(localStorage.getItem('hienthi')) : [];
        hienthi.push({
            ten: ten,
            gia: gia,
            phanloai: phanloai,
            upload: upload,
        });
        localStorage.setItem('hienthi', JSON.stringify(hienthi))
        def();
    }
}
//Hiển thị cửa SP lên cửa hàng
function def() {
    var hienthi = localStorage.getItem('hienthi') ? JSON.parse(localStorage.getItem('hienthi')) : [];
    if (hienthi.lenghth === 0) {
        return false;
    }
    var divv = "";
    hienthi.forEach((hienthi, i) => {
        var i;
        i++;
        divv += `<div class="col l-3 m-6 c-6 main_album">
        <div class="album" onclick="check(this)">
            <img class="background" src = "/trangchu/Admin/img/${hienthi.upload}">
                <a href="/trangchu/html/chitiet.html" class="name_album">${hienthi.ten}</a>
                <a href="/trangchu/html/chitiet.html" class="price">${hienthi.gia}</a>
                <a href="/trangchu/html/chitiet.html" style="color: rgb(184, 184, 184);" class="load_new">${hienthi.phanloai}</a>
        </div>
      </div>`;

    })
    document.getElementById('row1').innerHTML = divv;
}


// Kiem tra trước khi xóa 
function kiemTra(id) {
    var result = confirm("Bạn có chắc chắn muốn xóa không ???");
    if (result) {
        deleteSP(id);
    }
}

// xóa nề 
function deleteSP(id) {
    var sanpham = localStorage.getItem('sanpham') ? JSON.parse(localStorage.getItem('sanpham')) : [];
    // var hienthi = localStorage.getItem('hienthi') ? JSON.parse(localStorage.getItem('hienthi')) : [];
    var hienthi = JSON.parse(localStorage.getItem("hienthi"));
    for (let i = 0; i < hienthi.length; i++) {
        if (hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten) {
            console.log(hienthi[i].ten);
            hienthi.splice(i, 1);
            localStorage.setItem('hienthi', JSON.stringify(hienthi));
        }

    }
    sanpham.splice(id, 1);
    localStorage.setItem('sanpham', JSON.stringify(sanpham));
    show();
    def();
}
//Sửa SP 
function editSP(id) {
    var sanpham = localStorage.getItem('sanpham') ? JSON.parse(localStorage.getItem('sanpham')) : [];
    document.getElementById("number").value = id;
    document.getElementById("ten").value = sanpham[id].ten;
    document.getElementById("gia").value = sanpham[id].gia;
    them = '<i class="fa-regular fa-circle-check"></i>'
    document.getElementById("phanloai").value = sanpham[id].phanloai;
    if (sanpham[id].them == '<i class="fa-regular fa-circle-check"></i>') {
        document.getElementById('yes').checked = 1;
    } else if (sanpham[id].them == '<i class="fa-regular fa-circle-xmark"></i>') {
        document.getElementById('no').checked = 2;
    }
    document.getElementById('image-grid').style.display = 'none';
    document.getElementById('image-grid2').style.display = 'block';
    document.getElementById('image-grid2').innerHTML = `<img src = "../img/${sanpham[id].upload}"alt = ""style = "width: 50px; height: 50px;"> </img>`
    var hienthi = JSON.parse(localStorage.getItem("hienthi"));
    for (let i = 0; i < hienthi.length; i++) {
        if (hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten && hienthi[i].ten == sanpham[id].ten) {
            hienthi.splice(i, 1);
            localStorage.setItem('hienthi', JSON.stringify(hienthi));
        }

    }
    document.getElementById('a111').style.display = 'block';
}

// phần rườm rà
function collapseSidebar() {
    body.classList.toggle('sidebar-expand')
}
const body = document.getElementsByTagName('body')[0]
    //up ảnh nà
const image_input = document.querySelector("#file-upload");
var upload_img = "";
image_input.addEventListener("change", function() {
    const reader = new FileReader()
    reader.addEventListener("load", () => {
        upload_img = reader.result;
        document.querySelector("#image-grid").style.backgroundImage = `url(${upload_img})`;
    });
    reader.readAsDataURL(this.files[0]);
})