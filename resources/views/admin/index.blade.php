@extends('voyager::master')

@section('content')
    <div class="page-content">
        <div class="widgets">
            @if (Schema::hasTable(with(new User())->getTable()))
                <div class="panel widget center bgimage"
                     style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/02.png);">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class="voyager-group"></i>
                        @php $user_count = User::count(); @endphp
                        <h4>{{ $user_count }} {{ trans('admin.dashboard.user.display') }}</h4>
                        <p>{{ trans('admin.dashboard.user.message', ['number'=>$user_count]) }}</p>
                        <a href="{{ route('voyager.users.index') }}"
                           class="btn btn-primary">{{ trans('admin.dashboard.user.button') }}</a>
                    </div>
                </div>
            @endif
            @if (Schema::hasTable(with(new Page())->getTable()))
                <div class="panel widget center bgimage"
                     style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class="voyager-news"></i>
                        @php $page_count = Page::count(); @endphp
                        <h4>{{ $page_count }} {{ trans('admin.dashboard.page.display') }}</h4>
                        <p>{{ trans('admin.dashboard.page.message', ['number'=>$page_count]) }}</p>
                        <a href="{{ route('voyager.pages.index') }}"
                           class="btn btn-primary">{{ trans('admin.dashboard.page.button') }}</a>
                    </div>
                </div>
            @endif
            @if (Schema::hasTable(with(new Post())->getTable()))
                <div class="panel widget center bgimage"
                     style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                    <div class="dimmer"></div>
                    <div class="panel-content">
                        <i class="voyager-file-text"></i>
                        @php $post_count = Post::count(); @endphp
                        <h4>{{ $post_count }} {{ trans('admin.dashboard.post.display') }}</h4>
                        <p>{{ trans('admin.dashboard.post.message', ['number'=>$post_count]) }}</p>
                        <a href="{{ route('voyager.posts.index') }}"
                           class="btn btn-primary">{{ trans('admin.dashboard.post.button') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop
