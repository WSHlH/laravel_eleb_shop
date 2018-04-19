<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessList extends Model
{
    protected $fillable = [
        'shop_name', 'shop_img', 'brand','on_time','humming','promise','invoice','start_send','send_cost','distance','estimate_time','notice','discount','is_examine'
    ];

    public function business()//该命名和取值相关
    {
        return $this->belongsTo(Business::class,'id');
    }
    public function category()//该命名和取值相关
    {
        return $this->belongsTo(BusinessCategory::class,'business_category_id');
    }
}
