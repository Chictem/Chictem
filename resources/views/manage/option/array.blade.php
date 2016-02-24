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
                        {!! Form::open(['url' => url('/manage/option/array'), 'class' => 'form-horizontal']) !!}
                        @foreach($arrays as $array)
                            <div class="form-group">
                                {!! Form::label($array->key, $array->display_name, ['class' => 'col-sm-2 control-label']) !!}
                                <div class="col-sm-6">
                                    @foreach($array->value as $key => $value)
                                        <div class="row m-b-sm">
                                            <div class="col-sm-5">
                                                {!! Form::text($array->key.'[key][]', $key, ['class' => 'form-control']) !!}
                                            </div>
                                            {!! Form::label('arrow', '=>', ['class' => 'col-sm-1 control-label']) !!}
                                            <div class="col-sm-6">
                                                {!! Form::text($array->key.'[value][]', $value, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
            </div>
        </div>
    </div>
@endsection