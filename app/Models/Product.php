<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];
    protected $casts = [
        'status' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    const TYPE_SECKILL = 'seckill';

    public static $typeMap = [
        self::TYPE_SECKILL => '秒杀商品',
    ];

    public function seckill()
    {
        return $this->hasOne(ProductSeckill::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new \Exception('减库存不可小于0');
        }

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new \Exception('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
