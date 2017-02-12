@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">课程</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="{{ $course->image }}" alt="crouse thumb">
                                <div class="caption">
                                    <h3>{!! $course->name !!}</h3>
                                    <p>{!! $course->description !!}</p>
                                    <p><a href="{{ route('courses.show', ['id' => $course->id]) }}" class="btn btn-primary" role="button">learn</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $courses->links() }}
    </div>
@endsection
