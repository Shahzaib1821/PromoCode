<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('backend.layouts.includes.head')
    @yield('head')
</head>

<body data-sidebar="dark">
    @include('backend.layouts.includes.header')

    @include('backend.layouts.includes.sidebar')

    @yield('content')

    @include('backend.layouts.includes.footer')

    @include('backend.layouts.includes.foot')

    @yield('scripts')
</body>

</html>
