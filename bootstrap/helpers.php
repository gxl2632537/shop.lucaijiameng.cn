<?php

function test_helper(){
    return "ok";
}

//当前请求的路由名称转换为 CSS 类名称，作用是允许我们针对某个页面做页面样式定制。
function route_class(){
    return str_replace('.','-',\Illuminate\Support\Facades\Route::currentRouteName());
}