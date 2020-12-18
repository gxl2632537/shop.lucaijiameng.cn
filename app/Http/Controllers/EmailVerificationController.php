<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EmailVerificationController extends Controller
{
    //邮箱验证的逻辑
    public function verify(Request $request){
        //从url 中获取email 和token 两个参数
        $email = $request->input('email');
        $token = $request->input('token');
        //如果有一个为空则说明不是一个合法的验证链接，直接抛出异常
        if(!$email || !$token){
            throw new Exception('验证码不正确');
        }
        //从缓存中读取数据，我们把从url中获取的token与缓存中的值进行对比
        //如果缓存不存在或者返回的值与url中token不一致就会抛出异常
        if($token !=Cache::get('email_verification_'.$email)){
            throw new Exception('验证链接不正确或已过期');
        }
        // 根据邮箱从数据库中获取对应的用户
        // 通常来说能通过 token 校验的情况下不可能出现用户不存在
        // 但是为了代码的健壮性我们还是需要做这个判断

        if (!$user = User::where('email', $email)->first()) {
            throw new Exception('用户不存在');
        }
        //讲指定的key从缓存中删除，由于已经完成了验证，这个缓存就没有必要继续保留。
        Cache::forget('email_verification_'.$email);
        //把对应用户的email_verified_at 自端变成当前验证的时间
        $email_verified_at =date('Y-m-d H:i:s',time());
        $user->email_verified_at =$email_verified_at;
        $user->save();

        // 最后告知用户邮箱验证成功。
        return view('pages.success', ['msg' => '邮箱验证成功']);
    }

    //主动激活邮箱
    public function send(Request $request){
        $user = $request->user();

        //判断用户是否已经激活
        if($user->email_verified_at){
            throw new Exception('你已验证过邮箱了');
        }
        //调用notify()方法用来发送我们定义好的通知类
         $user->notify(new EmailVerificationNotification());
        return view('pages.success',['msg'=>'邮件发送成功']);

    }
}