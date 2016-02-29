@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content" id="manage-user-menu">
        <div class="row animated fadeInRight">
            <div class="col-sm-12">
                <div class="ibox animate">
                    <div class="ibox-title">
                        <h5>添加菜单</h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-horizontal">
                                    <div class="form-group form-group-sm">
                                        <label for="name" class="col-sm-4 control-label">菜单名称</label>

                                        <div class="col-sm-7">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '菜单名称', 'form' => 'menu-form']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="display_name" class="col-sm-4 control-label">显示名称</label>

                                        <div class="col-sm-7">
                                            {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => '显示名称', 'form' => 'menu-form']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="description" class="col-sm-4 control-label">菜单描述</label>

                                        <div class="col-sm-7">
                                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => '菜单描述', 'form' => 'menu-form']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <p>
                                    点击按钮可以添加一个菜单,可以通过拖拽来改变菜单的顺序,同时可以调节菜单层级关系
                                </p>

                                <div class="dd drag-menu" id="nestable-personal">
                                    <ol class="dd-list">

                                    </ol>
                                </div>
                                @include('manage.menu.item')
                                {!! Form::open(['url' => url('/manage/menu/'), 'class' => 'form-horizontal', 'id' => 'menu-form']) !!}
                                {!! Form::hidden('content', null, ['id' => 'menu-output']) !!}
                                <div class="form-group m-t-md">
                                    <div class="col-md-12">
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