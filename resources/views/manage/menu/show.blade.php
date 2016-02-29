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
                                <p>
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
                                @include('manage.menu.item')

                                {!! Form::open(['url' => url('/manage/menu/'.$menu->id), 'class' => 'form-horizontal', 'method' => 'PUT', 'id' => 'menu-form']) !!}
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