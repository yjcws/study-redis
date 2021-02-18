<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;
use App\Http\Requests\SeckillOrderRequest;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function index()
    {

        Auth::login(User::where('id',1)->first());
        $products = Product::query()->where("status",true)->paginate();
//        dd($products);
        return view("product.index",["product" => $products]);
    }

    public function show(Product $product,Request $request)
    {
        if (!$product->status){
            throw new \Exception("商品未上架");
        }

        return view("product.productShow",["product" => $product]);
    }

    public function seckill(SeckillOrderRequest $request, OrderService $orderService)
    {
//        Auth::login(User::where('id',$request->input('userId'))->first());
        Auth::login(User::where('id',1)->first());
        $user    = $request->user();
//        $address = UserAddress::find($request->input('address_id'));
        $address = UserAddress::find(4);
        $sku     = Product::find($request->input('product_id'));
//
        return $orderService->seckill($user,$address, $sku);
    }

    public function llen()
    {
        dd(Redis::llen("seckill_product_1"));
    }

    public function addseckill()
    {
        for ($i=1;$i<=10;$i++){
            Redis::lpush("seckill_product_1",$i);
        }
    }
}
