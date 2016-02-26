@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>所有表单元素
                            <small>包括自定义样式的复选和单选按钮</small>
                        </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['url' => url('/manage/option/update'), 'class' => 'form-horizontal']) !!}
                        @foreach($option_items as $option_item)
                            @define $option = Option::item($option_item)
                            <div class="form-group">
                                {!! Form::label($option->key, $option->display_name, ['class' => 'col-sm-2 control-label']) !!}
                                @switch($option->type)
                                @case('text')
                                <div class="col-sm-8">
                                    {!! Form::text($option->key, $option->value, ['class' => 'form-control']) !!}
                                    <span class="help-block m-b-none">{{ $option->description }}</span>
                                </div>
                                @endcase
                                @endswitch
                            </div>
                            <div class="hr-line-dashed"></div>
                        @endforeach
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加数组
                        </h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['url' => url('/manage/option/add-item'), 'class' => 'form-horizontal array-form']) !!}
                        {!! Form::hidden('id', null) !!}
                        {!! Form::hidden('type', 'array') !!}
                        <div class="form-group">
                            {!! Form::label('key', '数组键名', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                <input type="text" value="" name="key" class="form-control" placeholder="数组键值">
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('key', '数组名称', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                <input type="text" value="" name="display_name" class="form-control" placeholder="数组名称">
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('value', '数组内容', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-6 array-value">
                                <div class="row m-b-sm">
                                    <div class="col-sm-5">
                                        <input name="value[key][]" class="form-control">
                                    </div>
                                    <div class="col-sm-1 p-l-md p-t-sm">
                                        <i class="fa fa-angle-double-right">
                                        </i>
                                    </div>
                                    <div class="col-sm-5">
                                        <input name="value[value][]" class="form-control">
                                    </div>
                                    <div class="col-sm-1 p-t-xs">
                                        <div class="btn btn-danger btn-xs rm-row">删除</div>
                                    </div>
                                </div>
                                <div class="row m-b-sm">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-sm btn-white add-row"><i
                                                    class="fa fa-plus"></i> 添加
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-check"></i> 保存
                                        </button>
                                    </div>
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
@endsection