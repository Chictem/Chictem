<div class="filters">
    @php
        $model = app($dataType->model_name);
    @endphp
    @if(method_exists($dataType->model_name, 'getFilters') && $model->getFilters())
        @foreach($model->getFilters() as $filter)
            <div class="filter">
                @if($row = $dataType->row($filter))
                    {{ $row->display_name }}:
                    <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, null)) }}"
                       class="{{ !request()->query($filter)?'active':'' }}"
                    >
                        {{ trans('common.filter.any') }}
                    </a>
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
                                        <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, $item)) }}"
                                           class="{{ request()->query($filter) == $item?'active':'' }}">
                                            {{ $relationship->{$options->relationship->label} }}
                                        </a>
                                    @endif
                                @endif
                            @elseif(isset($options->options))
                                <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, $item)) }}"
                                   class="{{ request()->query($filter) == $item?'active':'' }}">
                                    {{ $options->options->{$item} }}
                                </a>
                            @endif
                        @else
                            <a href="{{ route('voyager.'.$dataType->slug.'.index',array_add(array_except(request()->query(), [$filter]), $filter, $item)) }}"
                               class="{{ request()->query($filter) == $item?'active':'' }}">
                                {{ $item }}
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    @endif
</div>