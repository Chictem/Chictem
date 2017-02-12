@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>{{ $course->name }} <small>{{ $course->description }}</small></h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="embed-responsive embed-responsive-4by3">
                      <iframe class="embed-responsive-item" src="{{ $course->url }}"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
