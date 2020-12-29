<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];
    protected $casts = [
//        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    //与商品sku关联
    public function skus(){
        return $this->hasMany(ProductSku::class);
    }


}
