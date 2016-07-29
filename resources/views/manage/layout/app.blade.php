<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    <link rel="shortcut icon" href="/favicon.ico">
    {!! Html::style(vendor('bootstrap/dist/css/bootstrap.min.css')) !!}
    {!! Html::style(vendor('font-awesome/css/font-awesome.min.css')) !!}
    {!! Html::style(manage('css/animate.min.css')) !!}
    {!! Html::style(manage('css/hplus.css')) !!}
    {!! Html::style(manage('css/app.css')) !!}
    {!! Html::script(vendor('jquery/dist/jquery.min.js')) !!}
    {!! Html::script(vendor('bootstrap/dist/js/bootstrap.min.js')) !!}
    {!! Html::script(manage('js/functions.js')) !!}
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
@include('manage.public.sidebar')
@yield('wrap')
@include('manage.public.options')
{!! Html::script(manage('js/content.min.js')) !!}
{!! Html::script(manage('js/contabs.min.js')) !!}
{!! Html::script(manage('js/app.js')) !!}
{!! Html::script(plugins('metisMenu/js/jquery.metisMenu.js')) !!}
{!! Html::script(plugins('slimscroll/js/jquery.slimscroll.min.js')) !!}
{!! Html::script(plugins('layer/layer.min.js')) !!}
{!! Html::script(plugins('pace/js/pace.min.js')) !!}
{!! Html::script(manage('js/hplus.min.js')) !!}
</body>

</html>


