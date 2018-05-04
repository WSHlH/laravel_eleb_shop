<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderGood extends Model
{
    public function food()//该命名和取值相关
    {
        return $this->belongsTo(Food::class,'goods_id');
    }
}
