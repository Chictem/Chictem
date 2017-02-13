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

                @if(count($dataTypeContent) > 0)
                    <?php
                    $perPage = $dataTypeContent->first()->getPerPage();
                    list($perPageClass, $number) = per_page_class($perPage);
                    ?>
                @endif

                @foreach($dataTypeContent as $item)
                    @if($loop->index % $number == 0)
                        <div class="row">
                    @endif
                    <div class="{{ $perPageClass }}">
                        @foreach($dataType->showRows()->get() as $row)
                            @if($row->type=='image')
                                <div class="thumbnail">
                                    <img src="{{ Voyager::image($item->{$row->field}) }}">
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
                                        @php $relationship = $item->{camel_case(str_replace('_id', '', $row->field))} @endphp
                                        @if ($relationship)
                                            <p>{{ $relationship->{$options->relationship->label} }}</p>
                                        @endif
                                    @endif
                                @endif
                            @elseif($row->type=='PRI')
                                <p>
                                    <a href="{{ route($dataType->slug.'.show', $item->id) }}">
                                        Detail
                                    </a>
                                </p>
                            @else
                                @if(is_url($item->{$row->field}))
                                    <p>
                                        <a href="{{ $item->{$row->field} }}">
                                            {{ $item->{$row->field} }}
                                        </a>
                                    </p>
                                @else
                                    <p>{{ $item->{$row->field} }}</p>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if($loop->index % $number == $number - 1)
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="pagination">
            {!! $dataTypeContent->links() !!}
        </div>
    </div>
@endsection
