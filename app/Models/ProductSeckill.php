<?php

namespace App\Models;

use Carbon\Carbon;
//use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class ProductSeckill extends Model
{
    public $table = "product_seckill";
    // 调整管理后台时间展示格式
//    use DefaultDatetimeFormat;
    protected $fillable = ['start_at', 'stop_at'];
    protected $dates = ['start_at', 'stop_at'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 定义一个名为 is_before_start 的访问器，当前时间早于秒杀开始时间时返回 true
    public function getIsBeforeStartAttribute()
    {
        return Carbon::now()->lt($this->start_at);
//        return Carbon::now();
    }

    // 定义一个名为 is_after_end 的访问器，当前时间晚于秒杀结束时间时返回 true
    public function getIsAfterEndAttribute()
    {
        return Carbon::now()->gt($this->stop_at);
    }
}
