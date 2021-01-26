<?php
$config = include "../config/database.php";
//连接并校验密码
$Redis = new Redis();
$Redis->connect($config['redis']['host'],$config['redis']['port']);
$Redis->auth($config['redis']['password']);

//
$key = "product:".$_GET['product_id'];
if (!$Redis->exists($key)){
    $Redis->set($key,1);
    echo  $Redis->get($key);
//    header("Location:http://blog-login.com/public/product_key.php?id=".$_GET['product_id']);
    header("Location:http://blog-login.com/view/SteelSeries_zxr.php?id=".$_GET['id']."&product_id=1");
}else{
    $Redis->incr($key);
    echo  $Redis->get($key);
//    header("Location:http://blog-login.com/public/product_key.php?id=".$_GET['product_id']);
//    header("Location:http://blog-login.com/view/SteelSeries_zxr.php?id=".$_GET['id']."&product_id=1");
}