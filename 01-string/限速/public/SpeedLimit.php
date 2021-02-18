<?php
$Redis = new Redis("192.168.29.108",6379);
$Redis->auth("root");
$phonename="176xxxx0888";//手机号码
$id = 1;//用户id
$key = "user:$id:info:".$phonename; //依据用户id以及手机号码生成key

$restful = $Redis->set($key,1,60);
if ($restful != null || $Redis->incr($key)<=5) {
  return "OK";
}else {
  echo "1分钟不能请求5次";
}
