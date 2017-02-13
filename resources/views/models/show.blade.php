@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ $dataType->display_name_plural }}</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        
        @include('flash::message')
        
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div>
                    @foreach($dataType->showRows()->get() as $row)
                        @if($row->type=='image')
                            <div class="thumbnail">
                                <img src="{{ Voyager::image($dataTypeContent->{$row->field}) }}">
                            </div>
                        @elseif($row->type=='select_dropdown')
                            @php $options = json_decode($row->details); @endphp
                            @if(isset($options->relationship))
                                @if(!method_exists( $dataType->model_name, camel_case(str_replace('_id', '', $row->field))) )
                                    <p class="label label-warning"><i class="voyager-warning"></i> Make sure
                                        to setup the appropriate relationship in
                                        the {{ camel_case(str_replace('_id', '', $row->field)) . '()' }}
                                        method
                                        of
                                        the {{ $dataType->model_name }} class.</p>
                                @else
                                    @php $relationship = $dataTypeContent->{camel_case(str_replace('_id', '', $row->field))} @endphp
                                    @if ($relationship)
                                        <p>{{ $relationship->{$options->relationship->label} }}</p>
                                    @endif
                                @endif
                            @endif
                        @else
                            @if(is_url($dataTypeContent->{$row->field}))
                                <p>
                                    <a href="{{ $dataTypeContent->{$row->field} }}">
                                        {{ $dataTypeContent->{$row->field} }}
                                    </a>
                                </p>
                            @else
                                <p>{{ $dataTypeContent->{$row->field} }}</p>
                            @endif
                        @endif
                    @endforeach
                </div>
            
            </div>
        </div>
    </div>
@endsection
