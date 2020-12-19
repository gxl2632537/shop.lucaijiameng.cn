<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class InternalException extends Exception
{
    //
    protected $msgForUser;
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $msgForUser = '系统内部错误';
        $this->msgForUser =$msgForUser;

    }

    public function render(Request $request){
        if($request->expectsJson()){
            return response()->json(['msg'=>$this->msgForUser],$this->code);
        }
        return view('pages.error',['msg'=>$this->msgForUser]);
    }
}
