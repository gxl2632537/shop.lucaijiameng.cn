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
    //修改收货地址
    public function edit(UserAddress $user_address){
        $this->authorize('own', $user_address);
        return view('user_addresses.create_and_edit',['address'=>$user_address]);
    }
    //修改收货地址操作
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        $this->authorize('own', $user_address);
        $user_address->update($request->only([
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
    //删除操作
    public function destroy(UserAddress $user_address)
    {
        $this->authorize('own', $user_address);
        $user_address->delete();

        // 把之前的 redirect 改成返回空数组
        return [];
    }
}

