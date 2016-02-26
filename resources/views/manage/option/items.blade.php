@extends('manage.public.wrap')

@section('main')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>所有配置
                        </h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            @foreach($items as $index => $item)
                                <div class="col-md-6">
                                    {!! Form::open(['url' => url('/manage/option/items'), 'class' => 'form-horizontal item-form']) !!}
                                    {!! Form::hidden('id', $item->id) !!}
                                    @foreach($item->attrs() as $attr)
                                        <div class="form-group">
                                            {!! Form::label($attr, $columns[$attr], ['class' => 'col-sm-3 control-label']) !!}
                                            <div class="col-sm-8">
                                                <input type="text" value="{{ $item->$attr }}" name="{{ $attr }}"
                                                       class="form-control"
                                                       placeholder="{{ $columns[$attr] }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-3">
                                            {!! Form::submit('保存', ['class' => 'btn btn-primary btn-sm']) !!}
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加配置
                        </h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::open(['url' => url('/manage/option/items'), 'class' => 'form-horizontal item-form']) !!}
                                @foreach($item->attrs() as $attr)
                                    <div class="form-group">
                                        {!! Form::label($attr, $columns[$attr], ['class' => 'col-sm-3 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text($attr, null, ['class' => 'form-control', 'placeholder' => $columns[$attr]]) !!}
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        {!! Form::submit('保存', ['class' => 'btn btn-primary btn-sm']) !!}
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('support.swal')
@endsection