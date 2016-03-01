@extends('manage.layout.error')

@section('main')

    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">页面未找到</h3>

        <div class="error-desc m-t-md">
            抱歉，页面飞火星去啦~
            <div class="m-t-md">
                <a href="{{ url('/manage') }}" class="btn btn-primary btn-sm">返回主页</a>
            </div>
        </div>
    </div>

@endsection