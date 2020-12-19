<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //用户收货地址
    public function index(Request $request){
        return view('user_addresses.index',[
           'addresses'=>$request->user()->addresses
        ]);
    }

    //使用工厂类创建数据
    public function testDatabase(){
        $result = UserAddress::factory()->count(3)->create(['user_id'=>1]);
        if($result){
            return '数据已生成！';
        }
    }

}
