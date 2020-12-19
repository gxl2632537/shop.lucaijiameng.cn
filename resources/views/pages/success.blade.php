@extends('layouts.app')
@section('title', '操作成功')

@section('content')
    <div class="panel panel-default" style="padding: 20px">
        <div class="panel-heading">操作成功</div>
        <div class="panel-body text-center">
            <h1>{{ $msg }}</h1>
            <a class="btn btn-primary" href="{{ route('root') }}" style="padding: 1rem;line-height: 0rem;">返回首页</a>
        </div>
    </div>
@endsection
