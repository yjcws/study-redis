<?php
namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redis;

class SeckillOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'product_id'     => [
                'required',
                function ($attribute, $value, $fail) {
                    // 从 Redis 中读取数据
                    $stock = Redis::llen('seckill_product_1');
                    // 如果是 null 代表这个 SKU 不是秒杀商品
                    if (is_null($stock)) {
                        return $fail('该商品不存在');
                    }
                    // 判断库存
                    if ($stock < 1) {
                        return $fail('该商品已售完');
                    }

                    // 大多数用户在上面的逻辑里就被拒绝了
                    // 因此下方的 SQL 查询不会对整体性能有太大影响
                    $product = Product::find($value);
                    if ($product->seckill->is_before_start) {
                        return $fail('秒杀尚未开始');
                    }
                    if ($product->seckill->is_after_end) {
                        return $fail('秒杀已经结束');
                    }

                    if ($order = Order::query()
                        // 筛选出当前用户的订单
                        ->where('user_id', $this->post('userId'))
                        ->whereHas('items', function ($query) use ($value) {
                            // 筛选出包含当前 SKU 的订单
                            $query->where('product_id', $value);
                        })
                        ->where(function ($query) {
                            // 已支付的订单
                            $query->whereNotNull('paid_at')
                                // 或者未关闭的订单
                                ->orWhere('closed', false);
                        })
                        ->first()) {
                        if ($order->paid_at) {
                            return $fail('你已经抢购了该商品');
                        }
                        return $fail('你已经下单了该商品，请到订单页面支付');
                    }
                },
            ],
        ];
    }
}
