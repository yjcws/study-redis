<?php
$config = include "../config/database.php";
$Redis = new Redis();
$Redis->connect($config['redis']['host'],$config['redis']['port']);
$Redis->auth($config['redis']['password']);
$incr = $Redis->get("product:".$_GET['id']);
echo  $incr;