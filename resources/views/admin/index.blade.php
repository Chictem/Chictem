@extends('voyager::master')

@section('content')
    <div class="page-content">
        <div class="widgets">
            <?php if (Schema::hasTable(with(new User())->getTable())) { ?>
            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/02.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-group"></i>
                    <?php $user_count = User::count(); ?>
                    <h4>{{ $user_count }} {{ trans('admin.dashboard.user.display') }}</h4>
                    <p>{{ trans('admin.dashboard.user.message', ['number'=>$user_count]) }}</p>
                    <a href="{{ route('voyager.users.index') }}"
                       class="btn btn-primary">{{ trans('admin.dashboard.user.button') }}</a>
                </div>
            </div>
            <?php } ?>
            <?php if (Schema::hasTable(with(new Course())->getTable())) { ?>
            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-news"></i>
                    <?php $course_count = Course::count(); ?>
                    <h4>{{ $course_count }} {{ trans('admin.dashboard.course.display') }}</h4>
                    <p>{{ trans('admin.dashboard.course.message', ['number'=>$course_count]) }}</p>
                    <a href="{{ route('voyager.courses.index') }}"
                       class="btn btn-primary">{{ trans('admin.dashboard.course.button') }}</a>
                </div>
            </div>
            <?php } ?>
            <?php if (Schema::hasTable(with(new Teacher())->getTable())) { ?>
            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-file-text"></i>
                    <?php $teacher_count = Teacher::count(); ?>
                    <h4>{{ $teacher_count }} {{ trans('admin.dashboard.teacher.display') }}</h4>
                    <p>{{ trans('admin.dashboard.teacher.message', ['number'=>$teacher_count]) }}</p>
                    <a href="{{ route('voyager.teachers.index') }}"
                       class="btn btn-primary">{{ trans('admin.dashboard.teacher.button') }}</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
@stop
