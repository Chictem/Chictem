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
                        @foreach($arrays as $array)
                            {!! Form::open(['url' => url('/manage/option/array'), 'class' => 'form-horizontal array-form']) !!}
                            {!! Form::hidden('id', $array->id) !!}
                            {!! Form::hidden('type', $array->type) !!}
                            <div class="form-group">
                                {!! Form::label('key', '数组键名', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('key', $array->key, ['class' => 'form-control', 'placeholder' => '数组键值']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('key', '数组名称', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('display_name', $array->display_name, ['class' => 'form-control', 'placeholder' => '数组名称']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('value', '数组内容', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6 array-value">
                                    @foreach($array->value as $key => $value)
                                        <div class="row m-b-sm">
                                            <div class="col-sm-5">
                                                <input name="value[key][]" value="{{ $key }}" class="form-control">
{{--                                                {!! Form::text('value[key][]', $key, ['class' => 'form-control']) !!}--}}
                                            </div>
                                            <div class="col-sm-1 p-l-md p-t-sm">
                                                <i class="fa fa-angle-double-right">
                                                </i>
                                            </div>
                                            <div class="col-sm-5">
                                                <input name="value[value][]" value="{{ $value }}" class="form-control">
                                            </div>
                                            <div class="col-sm-1 p-t-xs">
                                                <div class="btn btn-danger btn-xs rm-row">删除</div>
                                            </div>
                                        </div>
                                    @endforeach
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection