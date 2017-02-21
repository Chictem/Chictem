<div class="search">
    @if(searchable($dataType->model_name))
        {!! Form::open(['url' => route('voyager.'.$dataType->slug.'.index'), 'method' => 'GET']) !!}
        <div class="input-group input-group-sm">
            <input type="text" name="search" class="form-control" placeholder="{{ trans('common.button.search') }}" value="{{ request()->query('search') }}">
        <span class="input-group-btn">
        <input type="submit" class="btn btn-success m-t-none" value="{{ trans('common.button.search') }}">
        </span>
        </div>
        {!! Form::close() !!}
    @endif
</div>