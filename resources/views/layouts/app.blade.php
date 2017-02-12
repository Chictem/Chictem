@extends('layouts.layout')

@section('wrapper')
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            @include("components.navbar")
        </header>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        @include("components.footer")
    </div>
@endsection
