@extends('manage.layout.auth')

@section('main')
    <div>
        <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="/img/a1.jpg">
        </div>
        <h3></h3>

        <p>重置密码</p>
        {!! Form::open(['url' => URL('/manage/password/reset'), 'role' => 'form', 'class' => 'm-t form-horizontal']) !!}
        {!! Form::hidden('token', $token) !!}
        <div class="form-group form-group-sm">
            {!! Form::text('email', $email, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '邮箱']) !!}
        </div>
        <div class="form-group form-group-sm">
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'placeholder' => '密码']) !!}
        </div>
        <div class="form-group form-group-sm">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'placeholder' => '确认密码']) !!}
        </div>
        <button type="submit" class="btn btn-primary block full-width">确认重置</button>
        <p class="text-muted text-center m-t-sm">
            <a href="{{ url('/manage/auth/login') }}">重新登录</a>
        </p>
        {!! Form::close() !!}
    </div>

@endsection