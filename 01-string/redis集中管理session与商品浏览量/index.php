<?php


session_start();
$_SESSION['UserInfo'] = array(
    "userid" => 123,
    "username" =>456
);

$redis = new Redis();

$redis->connect("127.0.0.1",6379);

$redis->auth("root");


echo $redis->get('PHPREDIS_SESSION:fpmbkld5qbesv4tf2v79knsoee');

