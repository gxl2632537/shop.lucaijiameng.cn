@extends('layouts.app')
@section('title', '提示')

@section('content')
    <div class="panel panel-default" style="padding: 20px;">
        <div class="panel-heading">提示</div>
        <div class="panel-body text-center">
            <h1>请先验证邮箱</h1>
            <a class="btn btn-primary" href="{{ route('email_verification.send') }}" style="padding: 1rem;line-height: 0rem;">重新发送验证邮件</a>
        </div>
    </div>
@endsection