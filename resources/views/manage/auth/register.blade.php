@extends('manage.layout.auth')

@section('main')
    <div>
        <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="/img/a1.jpg">
        </div>
        <h3></h3>

        <p>注册</p>
        {!! Form::open(['url' => URL('/manage/auth/register'), 'role' => 'form', 'class' => 'm-t form-horizontal']) !!}
        <div class="form-group form-group-sm">
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '用户名']) !!}
        </div>
        <div class="form-group form-group-sm">
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '邮箱']) !!}
        </div>
        <div class="form-group form-group-sm">
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => '密码']) !!}
        </div>
        <div class="form-group form-group-sm">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder' => '确认密码']) !!}
        </div>
        <button type="submit" class="btn btn-primary block full-width">注册</button>
        <p class="text-muted text-center m-t-sm">
            <a href="{{ url('/manage/auth/login') }}">已有账号?</a>
        </p>
        {!! Form::close() !!}
    </div>

@endsection