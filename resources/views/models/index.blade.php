@extends('layouts.app')

@section('content')
    <div class="content">
        @include('flash::message')
        <section class="content-header">
            <div class="container">
                <h2 class="text-left">{{ $dataType->display_name_plural }}</h2>
                <div class="hr-line-dashed"></div>
            </div>
        </section>
        <section class="content-wrapper">
            <div class="container">
                @if(count($dataTypeContent) > 0)
                    @php
                        $perPage = $dataTypeContent->first()->getPerPage();
                        list($perPageClass, $number) = per_page_class($perPage);
                    @endphp
                @endif
                @foreach($dataTypeContent as $item)
                    @if($loop->index % $number == 0)
                        <div class="row">
                            @endif
                            <div class="{{ $perPageClass }}">
                                <div class="item">
                                    @foreach($dataType->showRows()->get() as $row)
                                        @if($row->type=='image')
                                            <div class="thumbnail">
                                                <img src="{{ Voyager::image($item->{$row->field}) }}">
                                            </div>
                                        @elseif($row->type=='select_dropdown')
                                            @php $options = json_decode($row->details); @endphp
                                            @if(isset($options->relationship))
                                                @if(!method_exists( $dataType->model_name, camel_case(str_replace('_id', '', $row->field))) )
                                                    <p class="label label-warning"><i class="voyager-warning"></i> Make
                                                        sure
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
                                        @else
                                            @if(is_url($item->{$row->field}))
                                                <p>
                                                    <a href="{{ $item->{$row->field} }}">
                                                        {{ $item->{$row->field} }}
                                                    </a>
                                                </p>
                                            @elseif ($row->field== 'title' || $row->field== 'name')
                                                <p>
                                                    <a href="{{ route($dataType->slug.'.show', $item->id) }}">
                                                        {{ $item->{$row->field} }}
                                                    </a>
                                                </p>
                                            @else
                                                @if (contains_tags($item->{$row->field}))
                                                    {!! $item->{$row->field} !!}
                                                @else
                                                    {{ str_limit($item->{$row->field}, 30) }}
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @if($loop->index % $number == $number - 1)
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
        <div class="pagination">
            {!! $dataTypeContent->links() !!}
        </div>
    </div>
@endsection
