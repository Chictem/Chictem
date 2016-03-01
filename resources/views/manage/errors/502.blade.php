@extends('manage.layout.error')

@section('main')

    <div class="middle-box text-center animated fadeInDown">
        <h1>502</h1>
        <h3 class="font-bold">服务器错误</h3>
        
        <div class="error-desc m-t-md">
            抱歉，服务器开了点小差，稍后再试哦~
            <div class="m-t-md">
                <a href="{{ url('/manage') }}" class="btn btn-primary btn-sm">返回主页</a>
            </div>
        </div>
    </div>

@endsection