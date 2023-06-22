<?php
    session_start();
    require_once('connectDB.php');
    $dql = new connectDB();
    $maTL=$_POST['maTL'];
    $tenTL=$_POST['tenTL'];
    $filename="noname.jpg";
    $tmp_name = $_FILES["image"]["tmp_name"];
	$fldimageurl = "../img/" . $_FILES["image"]["name"];
	move_uploaded_file($tmp_name, $fldimageurl);
	$filename = $_FILES["image"]["name"];

    $sql="INSERT INTO theloai(MaTL,TenTL,AnhTL) VALUES ('$maTL','$tenTL','$filename')";
    $result = $dql->query($sql,false);
    if ($result) {
        echo "Đã thêm thể loại";
    } else {
        echo "Thể loại chưa được thêm";
    } 
?>