<?php
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Product;
use Carbon\Carbon;
use App\Jobs\CloseOrder;
use Illuminate\Support\Facades\Redis;

class OrderService
{
    public function seckill(User $user,UserAddress $address, Product $product)
    {
        $order = \DB::transaction(function () use ($user,$address, $product) {
            // 更新此地址的最后使用时间
            $address->update(['last_used_at' => Carbon::now()]);
            //            // 扣减对应 SKU 库存
            $restful = Redis::lpop('seckill_product_'.$product->id);
            if (!$restful){
                return false;
            }
            // 创建一个订单
            $order = new Order([
                'address'      => [ // 将地址信息放入订单中
                    'address'       => $address->full_address,
                    'zip'           => $address->zip,
                    'contact_name'  => $address->contact_name,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark'       => '',
                'total_amount' => $product->price,
                'type'         => Order::TYPE_SECKILL,
                'paid_at'      =>  Carbon::now()//默认订单已经支付
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();
            // 创建一个新的订单项并与 SKU 关联
            $item = $order->items()->make([
                'amount' => 1, // 秒杀商品只能一份
                'price'  => $product->price,
            ]);
            $item->product()->associate($product->id);
//            $item->productSku()->associate($product);
            $item->save();
            return $order;
        });
        // 秒杀订单的自动关闭时间与普通订单不同
//        dispatch(new CloseOrder($order, config('app.seckill_order_ttl')));

        if ($order){
            return ["status" => true,"message" => "下单成功，请到订单页面支付"];
        }else{
            return ["status" => false,"message" => "秒杀异常"];
        }

    }
}