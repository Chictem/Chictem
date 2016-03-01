<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title></title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    {!! Html::style('/css/common/bootstrap.min.css') !!}
    {!! Html::style('/css/plugins/font-awesome/font-awesome.min.css') !!}
    {!! Html::style('/css/common/animate.min.css') !!}
    {!! Html::style('/css/common/hplus.css') !!}
</head>

<body class="gray-bg">
@yield('main')

{!! Html::script('/js/common/jquery.min.js') !!}
{!! Html::script('/js/common/bootstrap.min.js') !!}
</body>

</html>