<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

//自定义异常
class InvalidRequestException extends Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request){
        //如果是json的ajax请求
        if($request->expectsJson()){
            return response()->json(['msg'=>$this->message],$this->code);
        }
        return view('pages.error',['msg'=>$this->message]);
    }
}
