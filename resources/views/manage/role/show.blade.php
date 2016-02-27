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
                        <h3>{{ $role->name }}
                            <small>{{ $role->display_name }}</small>
                        </h3>
                        <p>
                            <i class="fa fa-magic"></i>
                            描述:<br> {{ $role->description }}
                        </p>

                        <p>
                            <i class="fa fa-clock-o"></i>
                            创建时间:<br> {{ $role->created_at }}
                        </p>
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
                        {!! Form::open(['url' => url('/manage/role/update-perms/'.$role->id), 'class' => 'form-horizontal']) !!}
                        @foreach($permission_groups as $group => $permissions)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="row m-t-xs">
                                            <div class="col-md-12 text-center"><h3>{{ @$groups[$group] }}</h3></div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row m-l-xs text-center">
                                            @foreach($permissions as $permission)
                                                <div class="col-sm-6 col-md-3 col-xs-12 i-checks m-t-sm m-b-sm">
                                                    {!! Form::checkbox('permissions[]', $permission->id, $role->hasPerm($permission)) !!}
                                                    {{ $permission->display_name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2 text-center">
                                {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="hr-line-dashed"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('support.icheck')
@endsection