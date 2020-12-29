<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    //增加一个访问器，将访问图片的路径转换为绝对路径
    public function getImageUrlAttribute(){
        //如果image字段本身就是完整的url就直接返回
        //确定字符串是否以http 或者https开头
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }

}
