@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInDown">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{ $role->display_name }}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id='external-events'>
                            <p>可拖动的活动</p>
                            <div class='external-event navy-bg'>确定活动目标</div>
                            <div class='external-event navy-bg'>各部门职责及分工</div>
                            <div class='external-event navy-bg'>案例分享</div>
                            <div class='external-event navy-bg'>xxx</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>权限管理</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="calendar.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="calendar.html#">选项1</a>
                                </li>
                                <li><a href="calendar.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>后台菜单管理</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="calendar.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="calendar.html#">选项1</a>
                                </li>
                                <li><a href="calendar.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="wrapper wrapper-content animated fadeInUp left">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="m-b-md">
                                    <h2>{{ $role->title }}</h2>
                                </div>
                                <dl class="dl-horizontal">
                                    <dt>状态：</dt>
                                    <dd><span class="label label-primary">进行中</span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <dl class="dl-horizontal">
                                    
                                    <dt>发布者：</dt>
                                    <dd></dd>
                                    <dt>参与人数：</dt>
                                    <dd></dd>
                                </dl>
                            </div>
                            <div class="col-sm-7" id="cluster_info">
                                <dl class="dl-horizontal">
                                    <dt>更新于：</dt>
                                    <dd>{{ $role->updated_at }}</dd>
                                    <dt>发布于：</dt>
                                    <dd>{{ $role->created_at }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="row m-t-sm">
                            <div class="col-sm-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="project_detail.html#tab-1" data-toggle="tab">招募详情</a>
                                                </li>
                                                <li class="">
                                                    <a href="project_detail.html#tab-2"
                                                       data-toggle="tab">参与批示</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                <div class="feed-activity-list">
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-2">
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="wrapper wrapper-content project-manager right">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4>招募描述</h4>
                        <img src="{{ $role->image }}" class="img-responsive">
                        <p class="small">
                            <br>{{ $role->brief }}
                        </p>
                        <p class="small font-bold">
                            <span><i class="fa fa-circle text-warning"></i> 详细描述</span>
                            <br>{{ $role->detail }}
                        </p>
                        <h5>招募标签</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection