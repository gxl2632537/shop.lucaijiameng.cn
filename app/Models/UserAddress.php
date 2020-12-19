<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable=[
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];

    protected $casts =[
      'last_used_at'=>'datetime'
    ];

    //与user模型一对多关联
    public function user(){
        return $this->belongsTo(User::class);
    }

    //创建一个名为getFullAddressAttribute的访问，在此之后可以直接通过$addrss->full_address来获取完整地址不需要每次进行地址的拼接了
    public function getFullAddressAttribute(){
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }


}
