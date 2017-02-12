@extends('layouts.app')

@section('content')

    @include("components.carousel")

<div id="app">
</div>

@endsection


@push('scripts')
    <script>
        $(function () {
            Window.App.Page.Index.init();
        })
    </script>
@endpush
