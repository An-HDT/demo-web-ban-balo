<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
        <!-- <span class="icon-close"><ion-icon name="close"></ion-icon></span> -->

        <div class="form-box login">
            <h2>Đăng nhập</h2>
            <form action="./dangnhap.php" id="formLogin" method="post" autocomplete="off">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" required id="username" name="username">
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" required id="password" name="password">
                    <label for="">Password</label>
                </div>
                <div class="remember-forgot">
                    <label for=""><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" id="btnDN" name="btnLogin">Đăng nhập</button>
                <div class="login-register">
                    <p>Chưa có tài khoản?<a href="dangki.php" class="register-link">Đăng kí</a></p>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- <script src="script.js"></script> -->
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#formLogin').submit(function(event) {
                $.ajax({
                    type: 'POST',
                    url: 'xulyDN.php',
                    data: {ts1:$('#username').val(),ts2:$('#password').val()},
                }).done(function(response) {
                if(response == 1){
                    window.location.href = '../index.php?page=trangchu';
                } else if(response == 2){
                    window.location.href = '../Admin/php/admin.php?page=sanpham';
                }
                else 
                    if(confirm(response) == true){
                        window.location.href = 'dangki.php';
                    }
                });
                event.preventDefault();
            });
        });
    </script>
</body>
</html>

