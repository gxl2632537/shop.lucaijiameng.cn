<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//处理所有自定义页面的逻辑
class PagesController extends Controller
{
    public function root(){
        return view('pages.root');
    }

    public function emailVerifyNotice(){
        return  view('pages.email_verify_notice');
    }
}
