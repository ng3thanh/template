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

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('admin.partials.header')

    <div class="app-body">
        @include('admin.partials.sidebar')

        <main class="main">
            @include('admin.partials.notification')
            @include('admin.partials.breadcrumb')
            @yield('content')
        </main>

        @include('admin.partials.aside')
    </div>

    @include('admin.partials.footer')
@include('admin.assets.js')
@yield('script')
</body>
</html>