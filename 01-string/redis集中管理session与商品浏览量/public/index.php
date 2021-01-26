<?php
$config = include "../config/database.php";
$Redis = new Redis();
$Redis->connect($config['redis']['host'],$config['redis']['port']);
$Redis->auth($config['redis']['password']);
if ($Redis->exists("PHPREDIS_SESSION:".$_GET['id'])){
    header("Location:http://blog-login.com/view/jianpan.php?id=".$_GET['id']);
}else{
    header("Location:http://blog-login.com/view/login.html");
}