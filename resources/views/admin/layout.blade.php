<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">
    <link rel="icon" href='{{ asset("$logo->favicon") }}' type="image/x-icon">
    @include('admin.assets.css')
    @yield('css')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')

    <div class="content-wrapper">
        @include('admin.partials.notification')
        @include('admin.partials.breadcrumb')
        @yield('content')
    </div>

    @include('admin.partials.footer')
    @include('admin.partials.control_sidebar')
</div>

@include('admin.assets.js')
@yield('script')
</body>
</html>