@extends('manage.layout.auth')

@section('main')
    <div>
        <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="/img/a1.jpg">
        </div>
        <h3></h3>

        <p>找回密码</p>
        {!! Form::open(['url' => URL('/manage/password/email'), 'role' => 'form', 'class' => 'm-t form-horizontal']) !!}
        <div class="form-group form-group-sm">
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '邮箱']) !!}
        </div>
        <button type="submit" class="btn btn-primary block full-width">发送邮件</button>
        <p class="text-muted text-center m-t-sm">
            <a href="{{ url('/manage/auth/login') }}">重新登录</a>
        </p>
        {!! Form::close() !!}
    </div>
@endsection
