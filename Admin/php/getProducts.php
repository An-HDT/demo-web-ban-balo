<?php
require_once('connectDB.php');

$dql = new connectDB();
$sql = "SELECT MaSP, TenSP from sanpham";
$result = $dql->query($sql);

$products = array();
foreach($result as $key => $value) {
    $product = array(
        "MaSP" => $value["MaSP"],
        "TenSP" => $value["TenSP"]
    );
    $products[] = $product;
}

header('Content-Type: application/json');
echo json_encode($products);
?>
