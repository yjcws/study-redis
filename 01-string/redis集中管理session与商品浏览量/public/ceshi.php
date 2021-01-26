<?php
session_start();
$session_id = session_id();
$redis = new Redis();
$redis->connect('192.168.29.108',6379);
$redis->auth('root');//这里是验证密码，如果redis没有设置密码可不用验证
echo $redis->get('PHPREDIS_SESSION:'.$session_id);