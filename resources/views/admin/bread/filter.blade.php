<div class="filters">
    @php
        $model = app($dataType->model_name);
    @endphp
    @if(($firstModel = $dataTypeContent->first()) && method_exists($dataType->model_name, 'getFilters') && $firstModel->getFilters())
        @foreach($firstModel->getFilters() as $filter)
            <div>
                @if($row = $dataType->row($filter))
                    {{ $row->display_name }}
                    @php $items = $model->distinct($filter)->pluck($filter); @endphp
                    @foreach($items as $item)
                        @php
                            $instance = $model->where($filter, $item)->first()
                        @endphp
                        @if($row->type=='select_dropdown')
                            @php $options = json_decode($row->details); @endphp
                            @if(isset($options->relationship))
                                @if(method_exists( $dataType->model_name, camel_case(str_replace('_id', '', $row->field))) )
                                    @php $relationship = $instance->{camel_case(str_replace('_id', '', $row->field))} @endphp
                                    @if ($relationship)
                                        <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, $item)) }}">
                                            {{ $relationship->{$options->relationship->label} }}
                                        </a>
                                    @endif
                                @endif
                            @elseif(isset($options->options))
                                <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, $item)) }}">
                                    {{ $options->options->{$item} }}
                                </a>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>