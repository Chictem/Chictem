@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ $page->title}}</h1>
    </section>
    <div class="content">
        {!! $page->body !!}
    </div>
@endsection
