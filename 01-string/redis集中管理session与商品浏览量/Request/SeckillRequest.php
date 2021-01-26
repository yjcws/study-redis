<?php
include "../controller/MysqlConnection.php";
$product = $_POST['id'];

$WhereDate =[
    "table" => "products",
    "filed" => "*",
    "where" => "id=".$product
];
$ProductRestful = $Mysql->getOne($WhereDate);
if ($ProductRestful["type"] !=1){
    echo json_encode(["static" => false,"message" => "商品类型异常"]);
}else if ($ProductRestful["static"]!=1){
    echo json_encode(["static" => false,"message" => "商品未上架"]);
}else{
    header("Location:http://blog-login.com/public/ProductSeckill.php?product_id=".$WhereDate["id"]);
}