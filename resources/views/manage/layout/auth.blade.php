<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    {!! Html::style(vendor('bootstrap/dist/css/bootstrap.min.css')) !!}
    {!! Html::style(vendor('font-awesome/css/font-awesome.min.css')) !!}
    {!! Html::style(manage('css/animate.min.css')) !!}
    {!! Html::style(manage('css/hplus.css')) !!}
    {!! Html::script(vendor('jquery/dist/jquery.min.js')) !!}
    {!! Html::script(vendor('bootstrap/dist/js/bootstrap.min.js')) !!}

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