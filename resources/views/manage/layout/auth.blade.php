<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    {!! Html::style('/css/common/bootstrap.min.css') !!}
    {!! Html::style('/css/plugins/font-awesome/font-awesome.min.css') !!}
    {!! Html::style('/css/common/animate.min.css') !!}
    {!! Html::style('/css/common/hplus.css') !!}
    {!! Html::script('/js/common/jquery.min.js') !!}
    {!! Html::script('/js/common/bootstrap.min.js') !!}

</head>

<body class="gray-bg">

<div class="lock-word animated fadeInDown">
</div>
<div class="middle-box text-center lockscreen animated fadeInDown">
    @include('manage.public.toast')
    @yield('main')
</div>

</body>

</html>