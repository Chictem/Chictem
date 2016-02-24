<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <title></title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    {!! Html::style('/css/common/bootstrap.min.css') !!}
    {!! Html::style('/css/plugins/font-awesome/font-awesome.min.css') !!}
    {!! Html::style('/css/common/animate.min.css') !!}
    {!! Html::style('/css/common/hplus.css') !!}
    {!! Html::script('/js/common/jquery.min.js') !!}
    {!! Html::script('/js/common/bootstrap.min.js') !!}
    {!! Html::script('/js/common/functions.js') !!}
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
@include('manage.public.sidebar')
@yield('wrap')
@include('manage.public.options')
{!! Html::script('/js/common/content.min.js') !!}
{!! Html::script('/js/plugins/metisMenu/jquery.metisMenu.js') !!}
{!! Html::script('/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::script('/js/plugins/layer/layer.min.js') !!}
{!! Html::script('/js/common/hplus.min.js') !!}
{!! Html::script('/js/common/contabs.min.js') !!}
{!! Html::script('/js/plugins/pace/pace.min.js') !!}
</body>

</html>


