<!--左侧导航开始-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" src="/img/profile_small.jpg"/></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="profile.html">个人资料</a>
                        </li>
                        <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                        </li>
                        <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/manage/auth/logout') }}">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">H+
                </div>
            </li>
            <li>
                <a href="{{ url('/manage/role') }}">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">角色管理</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/manage/option') }}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">站点设置</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span class="nav-gears">高级配置</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-third-level">
                    <li><a href="{{ url('/manage/option/items') }}">
                            <i class="fa fa-home"></i>
                            <span class="nav-gear">配置项目</span>
                        </a>
                    </li>
                    <li><a href="{{ url('/manage/option/array') }}">
                            <i class="fa fa-users"></i>
                            <span class="nav-hdd-o">全局数组</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{--
            @if($menu_items = Auth::user()->getGroup->menu)
                @foreach($menu_items as $menu_item)
                    <li>
                        <a href="{{ url('/manage/'.@$menu_item->link) }}">
                            <i class="fa fa-{{ @$menu_item->icon }}"></i>
                            <span class="nav-label">{{ @$menu_item->name }}</span>
                            @if (@$menu_item->children)
                                <span class="fa arrow"></span>
                            @endif
                        </a>
                        @if ($children = @$menu_item->children)
                            <ul class="nav nav-second-level">
                                @foreach($children as $child)
                                    <li>
                                        <a href="{{ url('/manage/'.@$menu_item->link.'/'.@$child->link) }}">
                                            <i class="fa fa-{{ @$child->icon }}"></i>
                                            <span class="nav-label">{{ @$child->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
                   --}}
        </ul>
    </div>
</nav>
<!--左侧导航结束-->