@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>所有菜单</h5>

                        <div class="ibox-tools">
                            @permission('add-menu')
                            <a href="{{ url('/manage/menu/create') }}" class="btn btn-xs btn-primary">新建菜单</a>
                            @endpermission
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-1">
                                <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i
                                            class="fa fa-refresh"></i> 刷新
                                </button>
                            </div>
                            <div class="col-md-11">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入菜单名称" class="input-sm form-control"> <span
                                            class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary">搜索</button> </span>
                                </div>
                            </div>
                        </div>
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td class="project-status">
                                            <span class="label label-primary">{{ $menu->display_name }}</span>
                                        </td>
                                        <td class="project-title">
                                            <a href="{{ url('/manage/menu/'.$menu->id) }}">{{ $menu->name }}</a>
                                        </td>
                                        <td class="project-completion">
                                            <small>{{ $menu->description }}</small>
                                        </td>
                                        <td class="project-people">

                                        </td>
                                        <td class="project-actions">
                                            <a href="{{ url('/manage/menu/'.$menu->id) }}" class="btn btn-white btn-sm"><i
                                                        class="fa fa-angle-double-right"></i>详情</a>
                                            {!! Form::open(['url' => url('/manage/menu/'.$menu->id), 'class' => 'form-inline', 'method' => 'DELETE']) !!}
                                            <button type="button" class="btn btn-sm btn-danger delete-check"><i class="fa fa-remove"></i>删除</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('support.swal')
@endsection