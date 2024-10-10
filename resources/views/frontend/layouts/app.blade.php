<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $metaTitle ?? 'Saving Fusion' }} | Promo Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? 'Default description' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'Default keywords' }}">
    <link rel="canonical" href="{{ URL::current() }}">
    <meta content="Themesbrand" name="author" />

    @include('frontend.layouts.includes.head')

    <style>
        :root {
            --primary-color: {{ $settings['primary_color'] ?? '#5f1899' }};
            --secondary-color: {{ $settings['secondary_color'] ?? '#7720db' }};
            --primary-button-color: {{ $settings['primary_button_color'] ?? '#009599' }};
            --secondary-button-color: {{ $settings['secondary_button_color'] ?? '#f0f0f0' }};
        }



        h1 { font-size: {{ $settings['h1_font_size'] ?? '32' }}px; !important; }
        h2 { font-size: {{ $settings['h2_font_size'] ?? '28' }}px; !important; }
        h3 { font-size: {{ $settings['h3_font_size'] ?? '24' }}px; !important; }
        h4 { font-size: {{ $settings['h4_font_size'] ?? '20' }}px; !important; }
        h5 { font-size: {{ $settings['h5_font_size'] ?? '18' }}px; !important; }
        h6 { font-size: {{ $settings['h6_font_size'] ?? '16' }}px; !important; }
        p { font-size: {{ $settings['p_font_size'] ?? '16' }}px; }
        span { font-size: {{ $settings['span_font_size'] ?? '14' }}px; }

        .section-link {
            color: var(--primary-button-color);
            border-color: var(--primary-button-color);
        }

        .prev, .next {
            background-color: var(--secondary-button-color);
            border-color: var(--secondary-button-color);
        }
    </style>

    @yield('head')
</head>

<body>
    {{-- <header>
        <img src="{{ $settings['header_logo'] ?? asset('default-header-logo.png') }}" alt="Header Logo">
    </header> --}}

    @include('frontend.layouts.includes.header')

    @yield('content')

    {{-- <footer>
        <img src="{{ $settings['footer_logo'] ?? asset('default-footer-logo.png') }}" alt="Footer Logo">
        <div class="social-links">
            @if(isset($settings['facebook_link']))
                <a href="{{ $settings['facebook_link'] }}" target="_blank">Facebook</a>
            @endif
            @if(isset($settings['twitter_link']))
                <a href="{{ $settings['twitter_link'] }}" target="_blank">Twitter</a>
            @endif
            @if(isset($settings['instagram_link']))
                <a href="{{ $settings['instagram_link'] }}" target="_blank">Instagram</a>
            @endif
            @if(isset($settings['linkedin_link']))
                <a href="{{ $settings['linkedin_link'] }}" target="_blank">LinkedIn</a>
            @endif
        </div>
    </footer> --}}

    @include('frontend.layouts.includes.footer')

    @include('frontend.layouts.includes.foot')

    @yield('scripts')
</body>

</html>
