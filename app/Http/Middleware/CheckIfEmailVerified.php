<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->email_verified_at){
            if($request->expectsJson()){
                return response()->json(['msg'=>'请先验证邮箱'],400);
            }
            return redirect(route('email_verify_notice'));
        }
        return $next($request);
    }
}
