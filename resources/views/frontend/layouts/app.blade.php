<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $metaTitle ?? 'Default Title' }} | Promo Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Default description' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'Default keywords' }}">
    <meta content="Themesbrand" name="author" />
    <style>
        :root {
            --primary-color: {{ $settings['primary_color'] ?? '' }};
            --secondary-color: {{ $settings['secondary_color'] ?? '' }};
            --button-color: {{ $settings['button_color'] ?? '' }};
            --hover-color: {{ $settings['hover_color'] ?? '' }};
            --link-color: {{ $settings['link_color'] ?? '' }};
            --header-color: {{ $settings['header_color'] ?? '' }};
            --footer-color: {{ $settings['footer_color'] ?? '' }};
            /* Add footer color */
            --heading-size: {{ $settings['heading_size'] ?? '2rem' }};
            /* Add heading size */
        }

        body {
            background-color: var(--primary-color);
            color: var(--secondary-color);
        }

        .btn {
            background-color: var(--button-color);
        }

        .btn:hover {
            background-color: var(--hover-color);
        }

        a {
            color: var(--link-color);
        }

        header {
            background-color: var(--header-color);
        }

        footer {
            background-color: var(--footer-color);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: var(--heading-size);
        }
    </style>

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
