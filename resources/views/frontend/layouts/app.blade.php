<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $metaTitle ?? 'Default Title' }} | Promo Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Default description' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'Default keywords' }}">
    <meta content="Themesbrand" name="author" />
    @include('frontend.layouts.includes.head')
    @yield('head')
</head>

<body data-sidebar="dark">
    @include('frontend.layouts.includes.header')

    @yield('content')

    @include('frontend.layouts.includes.footer')

    @include('frontend.layouts.includes.foot')

    @yield('scripts')
</body>

</html>
