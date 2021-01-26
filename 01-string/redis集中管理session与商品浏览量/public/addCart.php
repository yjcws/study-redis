<?php
$config = include "../config/database.php";
$Redis = new Redis();
$Redis->connect($config['redis']['host'],$config['redis']['port']);
$Redis->auth($config['redis']['password']);
//echo $UserInfo = unserialize($Redis->get("PHPREDIS_SESSION:".$_GET['userID']));
if ($Redis->exists("PHPREDIS_SESSION:".$_GET['userID'])){
    $UserInfo = unserialize($Redis->get("PHPREDIS_SESSION:".$_GET['userID']));
    $Redis->hMSet("user:".$UserInfo["userid"].":cart",[$_GET["product_id"] => $_GET["cart_sum"]]);
}else{
    $UserInfo = $Redis->get("PHPREDIS_SESSION:".$_GET['userID']);
    $Redis->hIncrBy("user:".$UserInfo["userid"].":cart",$_GET["product_id"],$_GET["cart_sum"]);
}