@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content" id="manage-user-menu">
        <div class="row animated fadeInRight">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>菜单详情</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h3>{{ $menu->name }}
                            <small>{{ $menu->display_name }}</small>
                        </h3>
                        <p>
                            <i class="fa fa-magic"></i>
                            描述<br> {{ $menu->description }}
                        </p>
                        <p>
                            <i class="fa fa-clock-o"></i>
                            创建时间<br> {{ $menu->created_at }}
                        </p>
                        <p>
                            <i class="fa fa-user"></i>
                            创建用户<br> {{ $menu->user->name }}
                        </p>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>菜单修改</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        {!! Form::model($menu, ['url' => url('/manage/menu/'.$menu->id), 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        @foreach($menu->attrs(['content', 'user_id']) as $attr)
                            <div class="form-group form-group-sm">
                                {!! Form::label($attr, $columns[$attr], ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-7">
                                    {!! Form::text($attr, null, ['class' => 'form-control', 'placeholder' => $columns[$attr]]) !!}
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>
                                    保存
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="ibox animate">
                    <div class="ibox-title">
                        <h5>菜单目录</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="m-b-lg">
                                    可以通过拖拽来改变菜单的顺序,同时可以调节菜单层级关系
                                </p>
                                
                                <div class="dd drag-menu" id="nestable-personal">
                                    <ol class="dd-list">
                                        @if(is_array($menu->content))
                                            @foreach($menu->content as $item)
                                                <li class="dd-item" data-id="{{ @$item->id }}"
                                                    data-icon="{{ @$item->icon }}" data-name="{{ @$item->name }}"
                                                    data-link="{{ @$item->link }}">
                                                    <div class="dd-handle">
                                                        <span class="label label-primary">
                                                            <i class="fa fa-{{ @$item->icon }}"></i>
                                                        </span>
                                                        <span class="handle-name">{{ @$item->name }}</span>
                                                        <span class="handle-link">{{ @$item->link }}</span>
                                                        <span class="pull-right drop-down">
                                                            <i class="fa fa-chevron-down"></i>
                                                        </span>
                                                    </div>
                                                    @include('manage.menu.option', ['icon' => @$item->icon, 'name' => @$item->name, 'link' => @$item->link])
                                                    @if(@$item->children)
                                                        <ol class="dd-list">
                                                            @foreach($item->children as $child)
                                                                <li class="dd-item" data-id="{{ @$child->id }}"
                                                                    data-icon="{{ @$child->icon }}"
                                                                    data-name="{{ @$child->name }}"
                                                                    data-link="{{ @$child->link }}">
                                                                    <div class="dd-handle">
                                                                        <span class="label label-primary"><i
                                                                                    class="fa fa-{{ @$child->icon }}"></i></span>
                                                                        <span class="handle-name">{{ @$child->name }}</span>
                                                                        <span class="handle-link">{{ @$child->link }}</span>
                                                                        <span class="pull-right drop-down"><i
                                                                                    class="fa fa-chevron-down"></i></span>
                                                                    </div>
                                                                    @include('manage.menu.option', ['icon' => @$child->icon, 'name' => @$child->name, 'link' => @$child->link])
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ol>
                                </div>
                                <li class="dd-item hidden" data-id="" data-icon="" data-name="" data-link="" id="item-template">
                                    <div class="dd-handle">
                                        <span class="label label-primary"></span>
                                        <span class="handle-name"></span>
                                        <span class="handle-link"></span>
                                        <span class="pull-right drop-down"><i class="fa fa-chevron-down"></i></span>
                                    </div>
                                    <div class="option-panel none">
                                        <form role="form" class="form-inline">
                                            <input type="text" placeholder="请输入图标" class="form-control edit-icon" value="">
                                            <input type="text" placeholder="请输入名称" class="form-control edit-name" value="">
                                            <input type="text" placeholder="请输入链接" class="form-control edit-link" value="">
                                            <button class="btn btn-primary btn-xs change-dd-list" type="button">修改
                                            </button>
                                            <button class="btn btn-danger btn-xs del-dd-list" type="button">删除
                                            </button>
                                            <button class="btn btn-primary btn-xs up-dd-list" type="button">收起
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <form role="form" class="form-inline m-t-sm">
                                    <div class="form-group">
                                        <label class="sr-only">图标</label>
                                        <input type="text" placeholder="请输入图标" name="icon" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only">名称</label>
                                        <input type="text" placeholder="请输入名称" name="name" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only">链接</label>
                                        <input type="text" placeholder="请输入链接" name="link" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-xs add-dd-list" type="button">添加</button>
                                    </div>
                                </form>
                                {!! Form::open(['url' => url('/manage/menu/'.$menu->id), 'class' => 'form-horizontal', 'method' => 'PUT', 'id' => 'menu-menu-form']) !!}
                                {!! Form::hidden('content', null, ['id' => 'menu-output']) !!}
                                <div class="form-group m-t-md">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('support.editable')
    @include('support.nestable')
@endsection