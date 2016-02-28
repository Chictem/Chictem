@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content" id="manage-user-menu">
        <div class="row animated fadeInRight">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-fire"></i>菜单详情</h5>
                    </div>
                    <div class="ibox-content">
                        <h5>菜单默认图</h5>
                        <img src="{{ $menu->banner }}" class="img-responsive">
                        <h5>菜单标识</h5>
                        
                        <p>{{ $menu->type }}</p>
                        <h5>菜单名称</h5>
                        
                        <p>{{ $menu->title }}</p>
                        <h5>菜单简介</h5>
                        
                        <p>{{ $menu->describe }}</p>
                    
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="ibox animate">
                    <div class="ibox-title">
                        <h5><i class="fa fa-map-o"></i>菜单目录</h5>
                        {!! Form::submit('保存', ['class' => 'btn btn-primary btn-xs pull-right', 'form' => 'menu-menu-form']) !!}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="m-b-lg">
                                    每个列表可以自定义标准的CSS样式。每个单元响应所以你可以给它添加其他元素来改善功能列表。
                                </p>
                                
                                <div class="dd drag-menu" id="nestable-personal">
                                    <ol class="dd-list">
                                        @if (is_array($menu->content))
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
                                <form role="form" class="form-inline m-t-sm">
                                    <div class="form-menu">
                                        <label class="sr-only">图标</label>
                                        <input type="text" placeholder="请输入图标" name="icon" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-menu">
                                        <label class="sr-only">名称</label>
                                        <input type="text" placeholder="请输入名称" name="name" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-menu">
                                        <label class="sr-only">链接</label>
                                        <input type="text" placeholder="请输入链接" name="link" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-menu">
                                        <button class="btn btn-primary btn-xs add-dd-list" type="button">添加</button>
                                    </div>
                                </form>
                                {!! Form::open(['url' => url('/manage/menu/'.$menu->id), 'method' => 'PUT', 'id' => 'menu-menu-form']) !!}
                                {!! Form::hidden('content', null, ['id' => 'menu-output']) !!}
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