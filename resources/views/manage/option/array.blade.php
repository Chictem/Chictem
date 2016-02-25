@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>所有数组
                        </h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
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
                                    <input type="text" value="{{ $array->key }}" name="key" class="form-control"
                                           placeholder="数组键值">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('key', '数组名称', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-5">
                                    <input type="text" value="{{ $array->display_name }}" name="display_name"
                                           class="form-control" placeholder="数组名称">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('value', '数组内容', ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6 array-value">
                                    @foreach($array->value as $key => $value)
                                        <div class="row m-b-sm">
                                            <div class="col-sm-5">
                                                <input name="value[key][]" value="{{ $key }}" class="form-control">
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
                                            <a href="{{ url('/manage/option/delete-array/'.$array->id) }}"
                                               class="btn btn-sm btn-danger">
                                                <i class="fa fa-remove"></i> 删除
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            {!! Form::close() !!}
                        @endforeach
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
                        {!! Form::open(['url' => url('/manage/option/array'), 'class' => 'form-horizontal array-form']) !!}
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