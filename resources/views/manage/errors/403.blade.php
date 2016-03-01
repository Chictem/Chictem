@extends('manage.layout.error')

@section('main')

    <div class="middle-box text-center animated fadeInDown">
        <h1>403</h1>
        <h3 class="font-bold">禁止访问</h3>

        <div class="error-desc m-t-md">
            抱歉，页面您无法查看哦~
            <div class="m-t-md">
                <a href="{{ url('/manage') }}" class="btn btn-primary btn-sm">返回主页</a>
            </div>
        </div>
    </div>

@endsection