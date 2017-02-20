<!DOCTYPE html>
<html>
<head>
    <title>{{Voyager::setting('admin_title')}} | {{Voyager::setting('admin_description')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_token() ?>"/>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400|Lato:300,400,700,900' rel='stylesheet'
          type='text/css'>

    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/lib/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/js/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/font-awesome.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/themes/flat-blue.css">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ config('voyager.assets_path') }}/images/logo-icon.png" type="image/x-icon">

    <!-- CSS Fonts -->
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/fonts/voyager/styles.css">

    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">

    <script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/vue.min.js"></script>

@yield('css')

<!-- Voyager CSS -->
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/voyager.css">

    @yield('head')

</head>

<body class="flat-blue">

<div id="voyager-loader">
    @php $admin_loader_img = Voyager::setting('admin_loader', ''); @endphp
    @if($admin_loader_img == '')
        <img src="{{ config('voyager.assets_path') . '/images/logo-icon.png' }}" alt="Voyager Loader">
    @else
        <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
    @endif
</div>

<?php
$user_avatar = Voyager::image(Auth::user()->image);
if ((substr(Auth::user()->image, 0, 7) == 'http://') || (substr(Auth::user()->image, 0, 8) == 'https://')) {
    $user_avatar = Auth::user()->image;
}
$menuExpanded = isset($_COOKIE['expandedMenu']) && $_COOKIE['expandedMenu'] == 1;
?>

<div class="app-container @if ($menuExpanded) expanded @endif ">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="hamburger @if ($menuExpanded) is-active @endif ">
                        <span class="hamburger-inner"></span>
                    </div>

                    <ol class="breadcrumb">
                        @if(count(Request::segments()) == 1)
                            <li class="active"><i class="voyager-boat"></i> {{ trans('common.path.dashboard') }}</li>
                        @else
                            <li class="active">
                                <a href="{{ route('voyager.dashboard')}}"><i
                                            class="voyager-boat"></i> {{ trans('common.path.dashboard') }}</a>
                            </li>
                        @endif
                        @php $breadcrumb_url = ''; @endphp
                        @for($i = 1; $i <= count(Request::segments()); $i++)
                            @php
                                $breadcrumb_url .= '/' . Request::segment($i);
                                $type = DataType::where('slug', Request::segment($i))->first();
                            @endphp

                            @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))
                                @if($i < count(Request::segments()) & $i > 0)
                                    <li class="active">
                                        <a href="{{ $breadcrumb_url }}">
                                            {{ $type?$type->display_name_singular: trans('common.path.'.Request::segment($i)) }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        {{ $type?$type->display_name_singular: trans('common.path.'.Request::segment($i)) }}
                                    </li>
                                @endif
                            @endif
                        @endfor
                    </ol>

                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="voyager-list icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="voyager-x icon"></i>
                    </button>


                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><img src="{{ $user_avatar }}" class="profile-img"> <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-animated">
                            <li class="profile-img">
                                <img src="{{ $user_avatar }}" class="profile-img">
                                <div class="profile-body">
                                    <h5>{{ Auth::user()->name }}</h5>
                                    <h6>{{ Auth::user()->email }}</h6>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('voyager.profile') }}"><i
                                            class="voyager-person"></i> {{ trans('common.button.profile') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('voyager.logout') }}"><i
                                            class="voyager-power"></i> {{ trans('common.button.logout') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                            <div class="logo-icon-container">
                                @php $admin_logo_img = Voyager::setting('admin_icon_image', ''); @endphp
                                @if($admin_logo_img == '')
                                    <img src="{{ config('voyager.assets_path') }}/images/logo-icon-light.png"
                                         alt="Logo Icon">
                                @else
                                    <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                                @endif
                            </div>
                            <div class="title">{{Voyager::setting('admin_title', 'VOYAGER')}}</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="voyager-x icon"></i>
                        </button>
                    </div><!-- .navbar-header -->

                    <div class="panel widget center bgimage"
                         style="background-image:url({{ Voyager::image( Voyager::setting('admin_bg_image'), config('voyager.assets_path') . '/images/bg.jpg' ) }});">
                        <div class="dimmer"></div>
                        <div class="panel-content">
                            <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                            <h4>{{ ucwords(Auth::user()->name) }}</h4>
                            <p>{{ Auth::user()->email }}</p>

                            <a href="{{ route('voyager.profile') }}" class="btn btn-primary">Profile</a>
                            <div style="clear:both"></div>
                        </div>
                    </div>

                {!! Menu::display('admin', 'admin_menu') !!}

            </nav>
        </div>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                @yield('content')
            </div>
        </div>
    </div>
</div>
</div>
<footer class="app-footer">
    <div class="site-footer-right">
        {{ trans('common.development', ['name' => Voyager::setting('developed_by')]) }}
    </div>
</footer>
<!-- Javascript Libs -->

<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/select2.full.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/jquery.cookie.js"></script>
<!-- Javascript -->

<script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/readmore.min.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/app.js"></script>
<script type="text/javascript" src="{{ config('voyager.assets_path') }}/lib/js/toastr.min.js"></script>
<script>
            @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@if(config('app.locale') == 'zh_CN')
    <script>
        var oLanguage = {
            "oAria": {
                "sSortAscending": ": 升序排列",
                "sSortDescending": ": 降序排列"
            },
            "oPaginate": {
                "sFirst": "首页",
                "sLast": "末页",
                "sNext": "下一页",
                "sPrevious": "上一页"
            },
            "sEmptyTable": "没有相关记录",
            "sInfo": "第 _START_ 到 _END_ 条记录，共 _TOTAL_ 条",
            "sInfoEmpty": "第 0 到 0 条记录，共 0 条",
            "sInfoFiltered": "(从 _MAX_ 条记录中检索)",
            "sInfoPostFix": "",
            "sDecimal": "",
            "sThousands": ",",
            "sLengthMenu": "每页条数 _MENU_",
            "sLoadingRecords": "正在载入...",
            "sProcessing": "正在载入...",
            "sSearch": "搜索:",
            "sSearchPlaceholder": "",
            "sUrl": "",
            "sZeroRecords": "没有相关记录"
        }
        $.fn.DataTable.defaults.oLanguage = oLanguage;
    </script>
@endif
@yield('javascript')
</body>
</html>
