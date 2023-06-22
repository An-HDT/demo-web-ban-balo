<?php
include './connectDB.php';
$result = mysqli_query($con, "SELECT * FROM khachhang WHERE Email LIKE '".$_GET['email']."'");
if($result !== false && $result->num_rows > 0){ //Tồn tại email rồi
    echo json_encode(false);
}else{ //Chưa tồn tại email.
    echo json_encode(true);
}