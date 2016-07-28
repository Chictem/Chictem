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
    {!! Html::style(vendor('bootstrap/dist/css/bootstrap.min.css')) !!}
    {!! Html::style(vendor('font-awesome/css/font-awesome.min.css')) !!}
    {!! Html::style(manage('css/animate.min.css')) !!}
    {!! Html::style(manage('css/hplus.css')) !!}

</head>

<body class="gray-bg">
@yield('main')
{!! Html::script(vendor('jquery/dist/jquery.min.js')) !!}
{!! Html::script(vendor('bootstrap/dist/js/bootstrap.min.js')) !!}
</body>

</html>