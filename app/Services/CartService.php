<?php
namespace App\Services;

use Illuminate\Support\Facades\Redis;

class CartService
{

    public function addCart($product,$amount = 1,$user)
    {
        $key = "cart:$user:product"; //以用户id为key
        if (Redis::exists($key)){
            return Redis::Hmset($key,$product,$amount);//以商品id为filed 购买的数据量为value新增到redis
        }else{
            return Redis::hIncrBy($key,$product,$amount);//根据商品的id以及数量增加购物车商品数量
        }
    }

    public function DecrCart($product,$amount = 1,$user)
    {
        $key = "cart:$user:product";
        if (Redis::exists($key)){
            return Redis::hIncrBy($key,$product,$amount);//以商品id为filed 购买的数据量为value新增到redis
        }else{
            return ["status" => true,"message" => "商品未加入购物车"];
        }
    }
}