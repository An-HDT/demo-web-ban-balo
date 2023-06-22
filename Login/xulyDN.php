<?php
session_start();
include("./connectDB.php");
if(isset($_POST['ts1']) && isset($_POST['ts2'])){
    $username = $_POST['ts1'];
    $password = $_POST['ts2'];
    $sql ="SELECT * from taikhoan where TenDN ='$username' and MatKhau ='$password'";
    $kq = mysqli_query($con, $sql);
    if($kq->num_rows){
        $user = mysqli_fetch_array($kq);
        if($user['NhomQuyen'] == 0){
            echo(1);
            $_SESSION['username'] = $_POST['ts1'];
            $_SESSION['password'] = $_POST['ts2'];
            $_SESSION['nq'] = $user['NhomQuyen'];
        } else {
            echo(2);
            $_SESSION['username'] = $_POST['ts1'];
            $_SESSION['password'] = $_POST['ts2'];
            $_SESSION['nq'] = $user['NhomQuyen'];
        }
    }
    else echo('Tài khoản không tồn tại');
}
    
?>


