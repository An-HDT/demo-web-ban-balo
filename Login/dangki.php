<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <style>
        label.error {
            display: block;
            color: red;
            border: none;
        }
        .input-box label {
            display: flex;
        }
    </style>
</head>
<body>
    <?php
        include './validate.php';    
    ?>
    <div>
        <header>
            <h2 class="logo"><a href="../index.php?page=trangchu" class="logo-link">Logo</a></h2>
            <nav class="navigation">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
                <button class="btnLogin">Login</button>
            </nav>
        </header>

        <div class="wrapper">
            <div class="form-box register">
                <h2>Đăng kí</h2>
                <form id="register-form" action="./dangki.php" method="post" autocomplete="off">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="username">
                        <label for="">Tên DN</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="fullname">
                        <label for="">Fullname</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="bookmark"></ion-icon></span>
                        <input type="text" name="address">
                        <label for="">Address</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="text" name="email">
                        <label for="">Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="call"></ion-icon></span>
                        <input type="text" name="sdt">
                        <label for="">Phone</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password">
                        <label for="">Pass</label>
                    </div>
                    <div class="remember-forgot">
                        <label for=""><input type="checkbox">I agree to the terms & conditions</label>
                    </div>
                    <button type="submit" class="btn" name="btnDK">Đăng kí</button>
                    <div class="login-register">
                        <p>Đã có tài khoản?<a href="dangnhap.php" class="login-link">Đăng nhập</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    
    <script>
        $("#register-form").validate({
            rules: {
                username: {
                    required: true,
                },
                fullname: {
                    required: true,
                },
                address: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                    remote: "check-email.php"
                },
                sdt: {
                    required: true,
                    number: true,
                    minlength: 10
                },
                password: {
                    required: true,
                    minlength: 4
                },
            },
            messages: {
                username: {
                    required: "Bạn chưa nhập username",
                },
                fullname: {
                    required: "Bạn chưa nhập họ và tên",
                },
                address: {
                    required: "Bạn chưa nhập địa chỉ",
                },
                email: {
                    required: "Bạn chưa nhập email",
                    email: "Email chưa đúng định dạng",
                    remote: "Email đã tồn tại trong hệ thống. Mời bạn chọn email khác"
                },
                sdt: {
                    required: "Bạn chưa nhập số điện thoại",
                    number: "SĐT chưa đúng định dạng",
                    minlength: "Số điện thoại tối thiểu là 10 số"
                },
                password: {
                    required: "Bạn chưa nhập password",
                    minlength: "Password tối thiểu là 4 ký tự"
                },
            },
            submitHandler: function (form) {
                console.log($(form).serializeArray());
                $.ajax({
                    type: "POST",
                    url: './xulyDK.php',
                    data: $(form).serializeArray(),
                    success: function (response) {
                        response = JSON.parse(response);
                        if (response.status == 0) { //Đăng nhập lỗi
                            alert(response.message);
                        } else { //Đăng nhập thành công
                            alert(response.message);
                            location.href = 'dangnhap.php';
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>