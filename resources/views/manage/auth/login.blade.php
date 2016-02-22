@extends('manage.layout.auth')

@section('main')
    <div>
        <div class="m-b-md">
            <img alt="image" class="img-circle circle-border" src="/img/a1.jpg">
        </div>
        <h3></h3>

        <p>请输入密钥</p>
        {!! Form::open(['url' => '/auth/', 'role' => 'form', 'class' => 'm-t form-horizontal']) !!}
        <div class="form-group form-group-sm">
            {!! Form::text('value', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '请输入管理密钥']) !!}
        </div>
        <button type="submit" class="btn btn-primary block full-width">认证</button>
        {!! Form::close() !!}
    </div>

@endsection