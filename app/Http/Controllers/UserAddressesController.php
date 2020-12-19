<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
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

    //新增收货地址
    public function create(){
        return view('user_addresses.create_and_edit',['address'=>new UserAddress()]);
    }
    //新增收货地址保存操作
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }
}
